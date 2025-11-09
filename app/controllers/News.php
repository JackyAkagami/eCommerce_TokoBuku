<?php

class News extends Controller {
    public function index() {
        $data['judul'] = 'News - Nadi';
        $this->view('templates/header', $data);
        $this->view('news', $data);
        $this->view('templates/footer');
    }
}
