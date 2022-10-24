<?php
  include "../../config/base_url.php";
  include "../../config/db.php";
  
  if (isset($_POST["title"], $_POST["description"], $_POST["author_id"], $_POST["price"], $_POST["year"], $_POST["category_id"]) &&
  strlen($_POST["title"]) > 0 &&
  strlen($_POST["description"]) > 0 &&
  strlen($_POST["price"]) > 0 &&
  strlen($_POST["year"]) > 0 &&
  intval($_POST["category_id"]) > 0
) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $year = $_POST["year"];
    $author_id = $_POST["author_id"];
    $cat_id = $_POST["category_id"];

    session_start();
    if(isset($_FILES["image"], $_FILES["image"]["name"]) &&
      strlen($_FILES["image"]["name"]) > 0
    ) {
      $format = end(explode(".",$_FILES["image"]["name"]));
      $image_name = time().".".$format;

      move_uploaded_file($_FILES["image"]["tmp_name"], "../../image/blogs/$image_name");

      $prep = mysqli_prepare($con, "INSERT INTO blogs (title, description, img, price, year, author_id, category_id) VALUES(?, ?, ?, ?, ?, ?, ?)");
      $path = "/image/blogs/".$image_name;
      mysqli_stmt_bind_param($prep, "sssssii", $title, $description, $path, $price, $year, $author_id, $cat_id);
      mysqli_execute($prep);
    }
    else{
      $prep = mysqli_prepare($con, "INSERT INTO blogs (title, description, price, year, author_id, category_id) VALUES(?, ?, ?, ?, ?, ?)");
      $path = "/image/blogs/".$image_name;
      mysqli_stmt_bind_param($prep, "ssssii", $title, $description, $price, $year, $author_id, $cat_id);
      mysqli_execute($prep);
    }
    header("Location: $BASE_URL/profile.php?nickname=".$_SESSION["nickname"]);
  }
  else{
    header("Location: $BASE_URL/addbook.php?error=3&nickname=".$_SESSION["nickname"]);
  }
?>