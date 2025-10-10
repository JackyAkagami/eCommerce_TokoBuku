<?php
// Kelas Database ini adalah wrapper (pembungkus) untuk PDO
// Tujuannya mempermudah koneksi & query ke database
class Database {
    // Properti koneksi database (diambil dari constant config)
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    // Properti untuk koneksi database dan statement SQL
    private $dbh;   // Database handler (objek koneksi PDO)
    private $stmt;  // Statement yang sudah disiapkan (prepared statement)

    // Constructor dijalankan otomatis saat objek Database dibuat
    public function __construct() {
        // DSN (Data Source Name) untuk koneksi PDO ke MySQL
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // Opsi tambahan untuk PDO
        $options = [
            PDO::ATTR_PERSISTENT => true,                   // Gunakan koneksi tetap (persistent connection)
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION     // Jika error, lempar exception
        ];

        try {
            // Buat koneksi ke database menggunakan PDO
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            // Jika koneksi gagal, hentikan program dan tampilkan pesan error
            die('Database gagal: ' . $e->getMessage());
        }
    }

    // Method untuk menyiapkan query SQL
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Method untuk binding parameter ke query agar lebih aman (menghindari SQL Injection)
    public function bind($param, $value, $type = null) {
        // Jika tipe data tidak ditentukan, cek otomatis berdasarkan isi variabel
        if (is_null($type)) {
            switch (true) {
                case is_int($value): $type = PDO::PARAM_INT; break;   // Jika integer
                case is_bool($value): $type = PDO::PARAM_BOOL; break; // Jika boolean
                case is_null($value): $type = PDO::PARAM_NULL; break; // Jika null
                default: $type = PDO::PARAM_STR;                      // Default: string
            }
        }
        // Lakukan binding nilai ke parameter
        $this->stmt->bindValue($param, $value, $type);
    }

    // Method untuk mengeksekusi query
    public function execute() {
        return $this->stmt->execute();
    }

    // Method untuk mengambil banyak data sekaligus (hasilnya array associative)
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil satu baris data (hasilnya array associative)
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
