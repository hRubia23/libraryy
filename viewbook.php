<?php
require_once "database.php";
require_once "book.php";

$bookObj = new Book();

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$genreFilter = isset($_GET['genre']) ? trim($_GET['genre']) : '';

$books = $bookObj->viewBook($search, $genreFilter);

if (!$books) {
    $books = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Books</title>
</head>
<body>
    <h1>List of Books</h1>
    <button><a href="addbook.php">Add Book</a></button>
    <form method="get">
        <label for=:>Search:</label>
        <input type="text" name="search" placeholder="" value="<?= htmlspecialchars($search) ?>">
        <select name="genre">
            <option value="">All Genres</option>
            <option value="fiction" <?= $genreFilter=="fiction"?"selected":"" ?>>Fiction</option>
            <option value="history" <?= $genreFilter=="history"?"selected":"" ?>>History</option>
            <option value="science" <?= $genreFilter=="science"?"selected":"" ?>>Science</option>
        </select>
        <button type="submit">Search</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Copies</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <?php $message = "Are you sure you want to delete the book '" . $book["title"] . "'?"; ?>
            <tr>
                <td><?= htmlspecialchars($book["id"]) ?></td>
                <td><?= htmlspecialchars($book["title"]) ?></td>
                <td><?= htmlspecialchars($book["author"]) ?></td>
                <td><?= htmlspecialchars($book["genre"]) ?></td>
                <td><?= htmlspecialchars($book["publication_year"]) ?></td>
                <td><?= htmlspecialchars($book["copies"]) ?></td>
                <td>
                    <a href="editbook.php?id=<?= $book["id"] ?>">Edit</a>
                    <a href="delete.php?id=<?= $book['id'] ?>&confirm=yes" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
