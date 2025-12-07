<?php

namespace App\Models;

use App\Helpers\Database;
use PDO;

class EvaluationResult
{
    private static function db()
    {
        return Database::connect();
    }

    public static function create($data)
    {
        $sql = "INSERT INTO evaluation_results 
                (ekskul_name, semester, input_criteria, predicted_class, 
                p_sangat_efektif, p_efektif, p_perlu_evaluasi, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = self::db()->prepare($sql);
        return $stmt->execute([
            $data['ekskul_name'],
            $data['semester'],
            $data['input_criteria'],
            $data['predicted_class'],
            $data['p_sangat_efektif'],
            $data['p_efektif'],
            $data['p_perlu_evaluasi'],
        ]);
    }

    public static function all()
    {
        $stmt = self::db()->query("SELECT * FROM evaluation_results ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
