<?php

class Finance_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Total semua pendapatan (orders selesai / paid)
    public function getTotalIncome() {
        $this->db->query("
            SELECT SUM(total_harga) AS total
            FROM orders
            WHERE status IN ('paid','completed')
        ");
        return $this->db->single()['total'] ?? 0;
    }

    // Pendapatan bulan ini
    public function getMonthlyIncome() {
        $this->db->query("
            SELECT SUM(total_harga) AS total
            FROM orders
            WHERE status IN ('paid','completed')
            AND MONTH(tanggal_order) = MONTH(CURRENT_DATE())
            AND YEAR(tanggal_order) = YEAR(CURRENT_DATE())
        ");
        return $this->db->single()['total'] ?? 0;
    }

    // Pendapatan hari ini
    public function getDailyIncome() {
        $this->db->query("
            SELECT SUM(total_harga) AS total
            FROM orders
            WHERE status IN ('paid','completed')
            AND DATE(tanggal_order) = CURRENT_DATE()
        ");
        return $this->db->single()['total'] ?? 0;
    }

    public function getTargetBulanan() {
        $this->db->query("
            SELECT 
                t.bulan,
                t.tahun,
                t.target,
                COALESCE(SUM(o.total_harga), 0) AS pendapatan
            FROM target_pendapatan t
            LEFT JOIN orders o 
            ON MONTH(o.tanggal_order) = t.bulan
            AND YEAR(o.tanggal_order) = t.tahun
            AND o.status IN ('paid','completed')
            GROUP BY t.bulan, t.tahun, t.target
            ORDER BY t.tahun DESC, t.bulan DESC
        ");
        return $this->db->resultSet();
    }

    public function simpanTargetBulanan($data)
    {
        $this->db->query("
            INSERT INTO target_pendapatan (bulan, tahun, target)
            VALUES (:bulan, :tahun, :target)
            ON DUPLICATE KEY UPDATE target = :target
        ");

        $this->db->bind('bulan', $data['bulan']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('target', $data['target']);

        return $this->db->execute();
    }

    public function insertTarget($data)
    {
        $this->db->query("
            INSERT INTO target_pendapatan (bulan, tahun, target)
            VALUES (:bulan, :tahun, :target)
        ");

        $this->db->bind('bulan', $data['bulan']);
        $this->db->bind('tahun', $data['tahun']);
        $this->db->bind('target', $data['target']);

        return $this->db->execute();
    }
}
