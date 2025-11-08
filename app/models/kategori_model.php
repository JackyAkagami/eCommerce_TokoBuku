<?php
class Kategori_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categories ORDER BY nama_kategori ASC";
        $this->db->query($query);
        return $this->db->resultSet();
    }


}
