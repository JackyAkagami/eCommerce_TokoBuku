<?php
// Controller Auth untuk menangani autentikasi user
class Auth extends Controller {
    public function __construct() {
        // Pastikan session sudah dimulai
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ================= DEFAULT ==================
    // Jika buka /auth langsung, arahkan ke login
    public function index() {
        $this->login();
    }

    // ================= LOGIN ==================
    public function login() {
        // Jika form login dikirim via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil inputan user (email & password)
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Panggil User_model untuk cari user berdasarkan email
            $userModel = $this->model('User_model');
            $user = $userModel->getUserByEmail($email);

            // Cek apakah user ada dan password cocok
            if ($user && (password_verify($password, $user['password']) || md5($password) === $user['password'])) {
                // Simpan data user ke session
                $_SESSION['user'] = $user;

                // Redirect ke halaman Home
                header("Location: " . BASEURL . "/home");
                exit;
            } else {
                // Jika gagal, tampilkan error di halaman login
                $this->view('auth/login', ['error' => 'Email atau password salah']);
                return;
            }
        }
        // Jika bukan POST, tampilkan form login biasa
        $this->view('auth/login');
    }

    // ================= REGISTER ==================
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil semua data dari form register
            $nama     = $_POST['nama'];
            $gender   = $_POST['gender'];
            $email    = $_POST['email'];
            $no_hp    = $_POST['no_hp'];
            $alamat   = $_POST['alamat'];
            // Password langsung di-hash
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Insert ke tabel users
            $db = new Database();
            $db->query("INSERT INTO users (nama, gender, email, password, role, alamat, no_hp) 
                        VALUES (:nama, :gender, :email, :password, 'user', :alamat, :no_hp)");
            $db->bind(':nama', $nama);
            $db->bind(':gender', $gender);
            $db->bind(':email', $email);
            $db->bind(':password', $password);
            $db->bind(':alamat', $alamat);
            $db->bind(':no_hp', $no_hp);

            // Eksekusi query
            if ($db->execute()) {
                // Jika sukses → redirect ke login
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            } else {
                // Jika gagal → tampilkan error
                $data['error'] = "Failed to register. Try again.";
                $this->view('auth/register', $data);
            }
        } else {
            // Jika bukan POST, tampilkan form register
            $this->view('auth/register');
        }
    }

    // ================= LOGOUT ==================
    public function logout() {
        // Hapus semua session
        session_start();
        session_destroy();

        // Redirect ke Home
        header("Location: " . BASEURL . "/home");
        exit;
    }

    // ================= FORGOT PASSWORD ==================
    // Menampilkan form "lupa password"
    public function forgot() {
        $this->view('auth/forget_pw');
    }

    // Proses form "lupa password"
    public function forgot_process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $userModel = $this->model('User_model');
            $user = $userModel->getUserByEmail($email);

            if ($user) {
                // Jika email terdaftar → tampilkan form reset password
                $this->view('auth/reset_pw', ['email' => $email]);
            } else {
                // Jika tidak ada → tampilkan error
                $this->view('auth/forget_pw', ['error' => 'Email tidak terdaftar']);
            }
        }
    }

    // ================= RESET PASSWORD ==================
    public function reset() {
        // Menangani jika user langsung akses /auth/reset?email=...
        $email = $_GET['email'] ?? '';
        $this->view('auth/reset_pw', ['email' => $email]);
    }

    // Proses reset password
    public function reset_process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm  = $_POST['confirm'] ?? '';

            // Cek apakah password dan confirm sama
            if ($password !== $confirm) {
                $this->view('auth/reset_pw', [
                    'error' => 'Password dan konfirmasi tidak cocok',
                    'email' => $email
                ]);
                return;
            }

            // Cek apakah email ada di database
            $userModel = $this->model('User_model');
            $user = $userModel->getUserByEmail($email);

            if ($user) {
                // Jika ada, update password baru (hashing)
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $userModel->updatePasswordByEmail($email, $newHash);

                // Tampilkan pesan sukses di halaman login
                $this->view('auth/login', ['success' => 'Password berhasil direset. Silakan login.']);
            } else {
                // Jika email tidak ditemukan
                $this->view('auth/reset_pw', [
                    'error' => 'Email tidak valid',
                    'email' => $email
                ]);
            }
        }
    }
}
