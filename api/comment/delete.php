<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_GET["id"]) && intval($_GET["id"])) {

        mysqli_query($con , "DELETE FROM comments WHERE id=".$_GET["id"]);
    }
?>