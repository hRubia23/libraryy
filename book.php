<?php



class Book
{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";
    public $copies = "";

    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addBook()
    {
        $sql = "INSERT INTO books (id, title, author, genre, publication_year, copies) VALUES (:id, :title, :author, :genre, :publication_year, :copies)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":id", $this->id);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        $query->bindParam(":copies", $this->copies);

        return $query->execute();
    }

        public function viewBook()
    {
        $sql = "SELECT * from books ORDER BY id ASC";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute())
            return $query->fetchAll();
        else
            return null;
    }
}