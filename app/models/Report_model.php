<?php

class Report_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getOrdersByFilter($periode, $status) {
        $where = "1=1";

        // filter periode
        switch ($periode) {
            case 'bulan_lalu':
                $where .= " AND MONTH(o.tanggal_order) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                            AND YEAR(o.tanggal_order) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)";
                break;
            case '3_bulan':
                $where .= " AND o.tanggal_order >= DATE_SUB(CURRENT_DATE, INTERVAL 3 MONTH)";
                break;
            case '1_tahun':
                $where .= " AND o.tanggal_order >= DATE_SUB(CURRENT_DATE, INTERVAL 1 YEAR)";
                break;
            default: // bulan_ini
                $where .= " AND MONTH(o.tanggal_order) = MONTH(CURRENT_DATE)
                            AND YEAR(o.tanggal_order) = YEAR(CURRENT_DATE)";
        }

        // filter status
        if ($status === 'sukses') {
            $where .= " AND o.status IN ('paid','completed')";
        } elseif ($status === 'batal') {
            $where .= " AND o.status = 'canceled'";
        } elseif ($status === 'pending') {
            $where .= " AND o.status = 'pending'";
        }

        $sql = "
            SELECT 
                o.id,
                o.tanggal_order,
                o.total_harga,
                o.status       AS status_order,
                u.nama         AS nama_pelanggan
            FROM orders o
            JOIN users u ON o.id_user = u.id
            WHERE $where
            ORDER BY o.tanggal_order DESC
        ";

        $this->db->query($sql);
        return $this->db->resultSet();
    }
}
