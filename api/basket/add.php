<?php
    include "../../config/base_url.php";
    include "../../config/db.php";

    $user = $_GET["userId"];
    $blog = $_GET["blogId"];
    $blogCheck = mysqli_query($con, "SELECT * FROM basket WHERE userId = $user AND blogId = $blog");
    if(mysqli_num_rows($blogCheck) > 0){
        header("Location: $BASE_URL/book-details.php?id=$blog&error=11");
    }else{
        mysqli_query($con, "INSERT INTO basket (userId, blogId) VALUES($user, $blog)");
        header("Location: $BASE_URL/book-details.php?id=$blog");
    }
?>