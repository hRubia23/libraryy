<?php


$product = ["id"=>"", "tile"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "copies"=>""];
$errors = ["id"=>"", "tile"=>"", "author"=>"", "genre"=>"", "publication_year"=>"", "copies"=>""];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $product["id"] = trim(htmlspecialchars($_POST["id"]));
        $product["title"] = trim(htmlspecialchars($_POST["title"]));
        $product["author"] = trim(htmlspecialchars($_POST["author"]));
        $product["genre"] = trim(htmlspecialchars($_POST["genre"]));
        $product["publication_year"] = trim(htmlspecialchars($_POST["publication_year"]));
        $product["copies"] = trim(htmlspecialchars($_POST["copies"]));

        if (empty($product["id"]))
            $errors["id"] = "Product name is required";

        if (empty($product["title"]))
            $errors["title"] = "title is required";

        if (empty($product["genre"]))
            $errors["genre"] = "genre is required";
        
        if (empty($product["copies"]) && $product["copies"] != 0)
            $errors["copies"] = "copies required";
        else if (!is_numeric($product["copies"]) || $product["copies"] <= 0)
            $errors["copies"] = "Price must be a number and greater than zero";

        if (empty(array_filter($errors)))
        {
            $productObj->id = $product["id"];
            $productObj->title = $product["title"];
            $productObj->author = $product["author"];
            $productObj->genre = $product["genre"];
            $productObj->publication_year = $product["publication_year"];
            $productObj->copies = $product["copies"];

            if ($productObj->addProduct())
                header("Location: viewproduct.php");
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
        <label for="name">Book Title<span>*</span></label>
        <input type="text" name="name" name="name" value="<?= $product["name"] ?>">
        <label for="name">Author<span>*</span></label>
        <input type="text" name="name" name="name" value="<?= $product["name"] ?>">
        <p class="error"><?= $errors["name"] ?></p>
        <label for="">Genre <span>*</span></label>
        <select name="Genre" id="Genre">
            <option value="">--Select--</option>
            <option value="history" <?= ($product["genre"] == "He's into Her") ? "selected" : ""; ?>>history</option>
            <option value="science" <?= ($product["genre"] == "Love yourself") ? "selected" : "" ?>>science</option>
            <option value="fiction" <?= ($product["genre"] == "He's into Her") ? "selected" : ""; ?>>fiction</option>
        </select>
        <p class="error"><?= $errors["Genre"] ?></p>
        <label for="copies">Copies <span>*</span></label>
        <input type="text" name="copies" id="copies" value="<?= $product["copies"] ?>">
        <p class="error"><?= $errors["copies"] ?></p>
        <br>
        <input type="submit" value="Save Product">
    </form>
        <button><a href="viewproduct.php">Check Product</a></button>
</body>
</html>