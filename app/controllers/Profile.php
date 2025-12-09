<?php

class Profile extends Controller
{
    private $userModel;

    public function __construct()
    {
        // pastikan user sudah login
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        // load model
        $this->userModel = $this->model('User_model');
    }

    public function index()
    {
        // asumsi session user: $_SESSION['user']['id']
        $userId = $_SESSION['user']['id'];

        $data['title'] = 'Profil Saya';
        $data['user']  = $this->userModel->getUserById($userId);

        $this->view('templates/header', $data);
        $this->view('profile', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASEURL . '/profile');
            exit;
        }

        $userId = $_SESSION['user']['id'];

        $payload = [
            'nama'   => $_POST['nama']   ?? '',
            'email'  => $_POST['email']  ?? '',
            'alamat' => $_POST['alamat'] ?? '',
            'no_hp'  => $_POST['no_hp']  ?? '',
        ];

        if ($this->userModel->updateProfile($userId, $payload)) {
            $_SESSION['flash_success'] = 'Profil berhasil diperbarui.';
        } else {
            $_SESSION['flash_error'] = 'Profil gagal diperbarui atau tidak ada perubahan.';
        }

        // update juga session user biar langsung kelihatan
        $_SESSION['user']['nama']   = $payload['nama'];
        $_SESSION['user']['email']  = $payload['email'];
        $_SESSION['user']['alamat'] = $payload['alamat'];
        $_SESSION['user']['no_hp']  = $payload['no_hp'];

        header('Location: ' . BASEURL . '/profile');
        exit;
    }
}
