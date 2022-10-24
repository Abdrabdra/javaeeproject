<?php
    include "../../config/base_url.php";
    include "../../config/db.php";

    $user = $_GET["userId"];
    $blog = $_GET["blogId"];
    if(isset($blog, $user)){
        mysqli_query($con, "DELETE FROM basket WHERE userId = $user AND blogId = $blog");
        header("Location: $BASE_URL/basket.php?id=$blog");
    }
?>
