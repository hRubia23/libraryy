<?php

require_once "database.php";
require_once "book.php";
$bookObj = new Book();

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $pid = trim(htmlspecialchars($_GET["id"]));
        $book = $bookObj->fetchBook($pid);
        if(!$book){
            echo "<a href='viewbook.php'>View Book<a/>";
            exit("Product not found");
        }else{
            $bookObj->deleteBook($pid);
            header("Location: viewbook.php");
        }
    }else{
        echo "<a href= 'viewbook.php'>View Book</a>";
        exit("Product not found");
    }
}