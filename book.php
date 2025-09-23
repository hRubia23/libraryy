<?php

require_once "databases.php";

class Product
{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";
    public $copies = "";

    protected $db;

    public function _construct()
    {
        $this->db = new Database();
    }

    public function addProduct()
    {
        $sql = "INSERT INTO book (id, title, author, genre, publication_year, copies) VALUE (:id, :title, :author, :genre, :publication_year, :copies)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        $query->bindParam(":copies", $this->copies);

        return $query->excute();
    }

        public function viewProduct()
    {
        $sql = "SELECT * from book ORDER BY id ASC";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute())
            return $query->fetchAll();
        else
            return null;
    }
}