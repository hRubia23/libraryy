<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Documents</title>
</head>
<body>
    <h1>List of Books</h1>
    <button><a href="addbook.php">Add Book</a></button>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication_year</th>
            <th>Copies</th>
        </tr>
        <?php
        $counter = 1;
        foreach ($productObj->viewBook() as $product)
        {
        ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td><?= $product["id"] ?></td>
                <td><?= $product["author"] ?></td>
                <td><?= $product["genre"] ?></td>
                <td><?= $product["publication_year"] ?></td>
                <td><?= number_format($product["copies"], 2) ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>