<?php

class Finance extends Controller {

    public function index() {

        $financeModel = $this->model('Finance_model');

        $data['judul'] = 'Finance';

        $data['monthlyIncome'] = $financeModel->getMonthlyIncome();
        $data['totalIncome']   = $financeModel->getTotalIncome();
        $data['dailyIncome']   = $financeModel->getDailyIncome();
        $data['targetBulanan'] = $financeModel->getTargetBulanan();

        $this->view('templates/header', $data);
        $this->view('admin/finance', $data);
        $this->view('templates/footer');
    }

    // ================================
    // METHOD UNTUK SIMPAN TARGET
    // ================================
    public function simpanTarget() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'bulan'  => $_POST['bulan'],
                'tahun'  => date('Y'),
                'target' => $_POST['target']
            ];

            $financeModel = $this->model('Finance_model');
            $financeModel->insertTarget($data);

            // balik ke halaman finance
            header('Location: ' . BASEURL . '/finance');
            exit;
        }
    }

    public function hapusTarget($id) {
        $financeModel = $this->model('Finance_model');

        $financeModel->deleteTarget($id);

        header('Location: ' . BASEURL . '/finance');
        exit;
    }
}
