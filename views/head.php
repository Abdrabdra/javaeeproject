	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style/all.css">
    <link rel="stylesheet" type="text/css" href="style/all.css">
	<link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <link rel="shortcut icon" href="../image/netflix_logo_icon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


    <script>
        <?php
        include "config/base_url.php";
        session_start();
        if(isset($_SESSION["user-id"])) {
        ?>

        localStorage.setItem("user-id", <?=$_SESSION["user-id"]?>)

        <?php
        }else{ ?>

        if(localStorage.getItem("user-id")) localStorage.removeItem("user-id");

            <?php
        }
            ?>

</script>