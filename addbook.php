<?php

require_once "database.php";
require_once "book.php";

$book = [];
$errors = [];

$book = ["id"=>"", "title"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "copies"=>""];
$errors = ["id"=>"", "title"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "copies"=>""];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    $book["id"] = isset($_POST["id"]) ? trim(htmlspecialchars($_POST["id"])) : "";
    $book["title"] = isset($_POST["title"]) ? trim(htmlspecialchars($_POST["title"])) : "";
    $book["author"] = isset($_POST["author"]) ? trim(htmlspecialchars($_POST["author"])) : "";
    $book["genre"] = isset($_POST["genre"]) ? trim(htmlspecialchars($_POST["genre"])) : "";
    $book["publication_year"] = isset($_POST["publication_year"]) ? trim(htmlspecialchars($_POST["publication_year"])) : "";
    $book["copies"] = isset($_POST["copies"]) ? trim(htmlspecialchars($_POST["copies"])) : "";

        if (empty($book["id"]) && $book["id"] != 0)
            $errors["id"] = "id is required";
        else if (!is_numeric($book["id"]) || $book["id"] <= 0)
            $errors["id"] = "ID must be a number greater than 0";

        if (empty($book["title"]))
            $errors["title"] = "title is required";

        if (empty($book["author"]))
        $errors["author"] = "Author is required";

        if (empty($book["genre"]))
            $errors["genre"] = "genre is required";
        
        if (empty($book["copies"]) && $book["copies"] != 0)
            $errors["copies"] = "copies required";
        else if (!is_numeric($book["copies"]) || $book["copies"] <= 0)
            $errors["copies"] = "Price must be a number and greater than zero";

        if (empty(array_filter($errors)))
        {
            $bookObj = new Book();
            $bookObj->id = $book["id"];
            $bookObj->title = $book["title"];
            $bookObj->author = $book["author"];
            $bookObj->genre = $book["genre"];
            $bookObj->publication_year = $book["publication_year"];
            $bookObj->copies = $book["copies"];

            if ($bookObj->addBook())
                header("Location: viewbook.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        label { display: block; }
        span, .error { color: red; margin: 0; }
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <form action="" method="post">
        <label for="">Field with <span>*</span> is required</label>

        <label for="id">ID<span>*</span></label>
        <input type="text" name="id" id="id" value="<?= $book["id"] ?>">
        <p class="error"><?= $errors["id"] ?></p>

        <label for="title">Book Title<span>*</span></label>
        <input type="text" name="title" id="title" value="<?= $book["title"] ?>">
        <p class="error"><?= $errors["title"] ?></p>

        <label for="author">Author<span>*</span></label>
        <input type="text" name="author" id="author" value="<?= $book["author"] ?>">
        <p class="error"><?= $errors["author"] ?></p>

        <label for="">Genre <span>*</span></label>
        <select name="genre" id="genre">
            <option value="">--Select--</option>
            <option value="history" <?= ($book["genre"] == "history") ? "selected" : ""; ?>>History</option>
            <option value="science" <?= ($book["genre"] == "science") ? "selected" : ""; ?>>Science</option>
            <option value="fiction" <?= ($book["genre"] == "fiction") ? "selected" : ""; ?>>Fiction</option>
        </select>
        <p class="error"><?= $errors["genre"] ?></p>

        <label for="publication_year">Publication Year</label>
        <input type="text" name="publication_year" id="publication_year" value="<?= $book["publication_year"] ?>">
        <p class="error"><?= $errors["publication_year"] ?></p>

        <label for="copies">Copies <span>*</span></label>
        <input type="text" name="copies" id="copies" value="<?= $book["copies"] ?>">
        <p class="error"><?= $errors["copies"] ?></p>

        <br>
        <input type="submit" value="Save Book">
    </form>
    <br>
        <button><a href="viewbook.php">Check Books</a></button>
</body>
</html>