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

        public function viewBook($search = '', $genre = '')
    {
        $sql = "SELECT * FROM books WHERE 1"; 
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (title LIKE :search OR author LIKE :search)";
            $params[':search'] = "%$search%";
        }

        if (!empty($genre)) {
            $sql .= " AND genre = :genre";
            $params[':genre'] = $genre;
        }

        $sql .= " ORDER BY id ASC";
        $query = $this->db->connect()->prepare($sql);
        $query->execute($params);

        return $query->fetchAll();
        
            return null;
    }
}