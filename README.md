# 🚀 SPK Naive Bayes Prediksi Pemilihan Ekstrakurikuler

## 📄 Deskripsi Proyek

Proyek ini adalah Sistem Pendukung Keputusan (SPK) berbasis _web_ yang dirancang untuk memprediksi kecenderungan keberhasilan atau kegagalan siswa dalam memilih ekstrakurikuler tertentu menggunakan algoritma **Naive Bayes Categorical**.

Sistem ini dibangun dengan arsitektur hibrida: **PHP Native/MVC** (untuk antarmuka pengguna dan _controller_) dan **Python (Flask API)** (untuk mesin prediksi _machine learning_). Data latih diambil dari database MySQL, diolah oleh Python, dan hasil prediksinya disimpan kembali ke database oleh PHP.

### Teknologi Utama yang Digunakan

- **Backend:** PHP (Native/Sederhana MVC)
- **Database:** MySQL
- **Frontend:** AdminLTE v3
- **Machine Learning:** Python (Flask, Pandas, Scikit-learn)

---

## 🏗️ Struktur Proyek

Proyek ini dipisahkan menjadi dua lingkungan utama: **PHP (Logika Kontrol)** dan **Python (Mesin Prediksi)**.

spkbayes/ ├── app/ # Logika MVC (Controller, Model, Service) ├── config/ # Konfigurasi aplikasi & database ├── database/ # File skema database (.sql) ├── python/ # Lingkungan Python API (Model Naive Bayes) │ ├── app.py # Flask Endpoint untuk Prediksi │ └── requirements.txt # Daftar dependensi Python └── public/ # Root Web Server (admin.php, index.php, assets, views) ├── admin.php # Router utama AdminLTE ├── layouts/ # Header, Footer, Sidebar └── pages/ # Views (.php) untuk berbagai peran pengguna

---

## 🛠️ Instalasi dan Persiapan Awal

Ikuti langkah-langkah di bawah ini untuk menyiapkan lingkungan proyek di mesin lokal Anda.

### 1. Kloning Repositori

````bash
git clone [https://www.youtube.com/watch?v=aT5XQwZ_De8](https://www.youtube.com/watch?v=aT5XQwZ_De8)
cd spkbayes
2. Konfigurasi Database (MySQL)
1. Buat database baru di MySQL/phpMyAdmin dengan nama: db_spk_ekskul.

2. Import skema dari file database/db_spk_ekskul.sql. (Pastikan tabel users, historical_data, dan evaluation_results terbuat).

3. Sesuaikan kredensial koneksi database pada file config/database.php dan config/db_config.php.

3. Instalasi PHP Dependencies (Composer)


Proyek ini menggunakan Composer untuk mengelola namespace dan autoloading PHP.

```bash

composer install


4. Instalasi Python Dependencies
Anda harus menyiapkan virtual environment Python untuk isolasi dependensi:

1. Masuk ke direktori python/:

```bash

cd python
2. Buat dan aktifkan virtual environment:

```bash

python -m venv venv
# Windows:
.\venv\Scripts\activate
# Linux/macOS:
source venv/bin/activate
3. Instal dependensi dari requirements.txt:

```bash

pip install -r requirements.txt
4. Kembali ke direktori utama spkbayes/:

```bash

cd ..

---

🏃 Cara Menjalankan Proyek
Proyek ini memerlukan dua server terpisah untuk berjalan: Web Server (PHP) dan API Server (Python).

1. Jalankan API Server (Python)
Di terminal pertama (pastikan virtual environment Python Anda aktif), jalankan server Flask:

```bash

cd python
python app.py

> Server harus berjalan di http://localhost:5000. Pastikan di output terminal muncul pesan "Model Naive Bayes berhasil dilatih."

2. Jalankan Web Server (PHP)
Pastikan XAMPP/Web Server Anda berjalan. Akses proyek melalui browser Anda:

> Halaman Administrator: http://localhost/spkbayes/public/admin.php

> Halaman Utama: http://localhost/spkbayes/public/index.php

---

🤝 Kontribusi dan Pengembangan Bersama
Kami sangat terbuka terhadap kontribusi! Jika Anda memiliki ide untuk perbaikan atau penambahan fitur (misalnya, implementasi Confusion Matrix atau algoritma lain):

1. Fork repositori ini.

2. Buat branch baru (git checkout -b fitur/nama-fitur-baru).

3. Lakukan perubahan dan commit perubahan Anda (git commit -m 'feat: Menambahkan fitur X').

4. Push ke branch Anda (git push origin fitur/nama-fitur-baru).

5. Buka Pull Request (PR) di GitHub.

Selamat ngoding!
````
