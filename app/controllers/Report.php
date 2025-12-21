<?php

class Report extends Controller {
    public function index() 
    {
        // Nama di sini HARUS sama: 'Report_model'
        $reportModel = $this->model('Report_model');

        $periode = isset($_GET['periode']) ? $_GET['periode'] : 'bulan_ini';
        $status  = isset($_GET['status'])  ? $_GET['status']  : 'semua';

        $data['judul']   = 'Report Penjualan';
        $data['periode'] = $periode;
        $data['status']  = $status;
        $data['orders']  = $reportModel->getOrdersByFilter($periode, $status);

        $this->view('templates/header', $data);
        $this->view('admin/report', $data);
        $this->view('templates/footer');
    }
}
