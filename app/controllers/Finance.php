<?php

class finance extends Controller {
    public function index() {
        $data['judul'] = 'Finance';
        $this->view('templates/header', $data);
        $this->view('admin/finance', $data); // kamu memakai folder admin
        $this->view('templates/footer');
    }
}
