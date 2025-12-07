import pandas as pd
from flask import Flask, request, jsonify
from sklearn.naive_bayes import CategoricalNB
from sklearn.preprocessing import LabelEncoder
from sqlalchemy import create_engine
from typing import Optional

# --- 1. KONFIGURASI DATABASE ---
DB_USER = 'root'
DB_PASS = ''
DB_HOST = '127.0.0.1'
DB_NAME = 'db_spk_ekskul'

# Buat engine SQLAlchemy
DB_URI = f"mysql+pymysql://{DB_USER}:{DB_PASS}@{DB_HOST}/{DB_NAME}"
engine = create_engine(DB_URI)

# Inisialisasi Flask
app = Flask(__name__)
model: Optional[CategoricalNB] = None
encoders: dict[str, LabelEncoder] = {}

# --- 2. FUNGSI UTILITY ---
def get_data_from_db():
    """Mengambil data latih dari tabel historical_data Laravel."""
    query = """
        SELECT id, x1_anggota, x2_absensi, x3_prestasi,
              x4_kepuasan, x5_pembina, class_label
        FROM historical_data
    """
    data = pd.read_sql(query, engine)

    if data.empty:
        print("!!! ERROR: Tabel historical_data kosong. Model akan dilatih dengan data dummy.")
        # Data dummy jika DB kosong
        data = pd.DataFrame({
            'x1_anggota': ['T', 'S', 'R', 'T'],
            'x2_absensi': ['T', 'S', 'R', 'T'],
            'x3_prestasi': ['AP', 'TAP', 'AP', 'TAP'],
            'x4_kepuasan': ['SP', 'P', 'TP', 'SP'],
            'x5_pembina': ['BS', 'GS', 'A', 'A'],
            'class_label': ['SE', 'E', 'PE', 'SE']
        })
    else:
        print("=== DATA BERHASIL DIBACA DARI DATABASE ===")
        print(data.head())
        print(f"Total baris: {len(data)}")

    return data


def train_model():
    """Melatih Model Naive Bayes dengan data historis."""
    global model, encoders

    # 1. Ambil Data
    data = get_data_from_db()

    # 2. Definisikan fitur dan label
    features = ['x1_anggota', 'x2_absensi', 'x3_prestasi', 'x4_kepuasan', 'x5_pembina']
    x = data[features]
    y = data['class_label']

    # 3. Label Encoding
    x_encoded = pd.DataFrame()
    for col in features:
        le = LabelEncoder()
        x_encoded[col] = le.fit_transform(x[col].astype(str).str.strip().str.upper())
        encoders[col] = le
        print(f"DEBUG: Kategori dipelajari untuk {col}: {le.classes_}")

    le_y = LabelEncoder()
    y_encoded = le_y.fit_transform(y.astype(str).str.strip().str.upper())
    encoders['class_label'] = le_y

    # 4. Latih Model
    model = CategoricalNB()
    model.fit(x_encoded, y_encoded)

    print("✅ Model Naive Bayes berhasil dilatih dengan data dari database.")


# --- 3. ENDPOINT API FLASK ---

@app.route('/api/predict', methods=['POST'])
def predict():
    """Endpoint untuk menerima data ekskul baru dan mengembalikan prediksi."""
    global model, encoders

    if model is None:
        return jsonify({'error': 'Model belum dilatih.'}), 500

    try:
        input_data = request.get_json()
        input_df = pd.DataFrame([input_data])
    except Exception as e:
        return jsonify({'error': f'Format data input tidak valid: {str(e)}'}), 400

    x_test_encoded = pd.DataFrame()
    features = list(input_df.columns)

    col = ''
    input_value = ''

    try:
        for col in features:
            le = encoders[col]
            input_value = input_df[col].iloc[0].strip().upper()
            print(f"DEBUG: Encode {col}: '{input_value}'")
            x_test_encoded[col] = le.transform([input_value])

    except Exception as e:
        return jsonify({
            'error': 'Gagal melakukan encoding',
            'input_failed': input_df.to_dict('records')[0],
            'detail': f"Kategori '{input_value}' pada fitur '{col}' TIDAK DITEMUKAN di data latih. "
                      f"Pastikan kategori input sesuai dengan data historis. Error Python: {str(e)}"
        }), 400

    # 4. Prediksi Probabilitas
    proba = model.predict_proba(x_test_encoded)[0]
    le_y = encoders['class_label']
    classes = le_y.classes_

    results = {class_label: round(proba[i] * 100, 2) for i, class_label in enumerate(classes)}

    predicted_label_index = model.predict(x_test_encoded)[0]
    predicted_class = le_y.inverse_transform([predicted_label_index])[0]

    return jsonify({
        'predicted_class': predicted_class,
        'p_sangat_efektif': results.get('SE', 0.0),
        'p_efektif': results.get('E', 0.0),
        'p_perlu_evaluasi': results.get('PE', 0.0)
    })


# --- 4. START SERVER ---
if __name__ == '__main__':
    train_model()
    app.run(host='0.0.0.0', port=5000, debug=True)
