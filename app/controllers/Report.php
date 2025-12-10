<?php

class report extends Controller {
    public function index() {
        $data['judul'] = 'Report';
        $this->view('templates/header', $data);
        $this->view('admin/report', $data); // kamu memakai folder admin
        $this->view('templates/footer');
    }
}
