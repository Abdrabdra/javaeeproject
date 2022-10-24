<?php
    include "config/base_url.php";
    include "config/db.php";

    session_start();
    $userId = $_SESSION["user-id"];

    $query = mysqli_query($con, "SELECT b.*, k.*, u.id FROM blogs b LEFT OUTER JOIN basket k on b.id = k.blogId LEFT OUTER JOIN users u ON b.author_id = u.id WHERE k.userId = $userId");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Купить фильм</title>

    <?php
        include "views/head.php";
    ?>

</head>


<body>

        <?php
			include "views/header.php";
		?>

    <div class="cinema-main">

        <?php
			if(mysqli_num_rows($query) > 0){
			while($row = mysqli_fetch_assoc($query)){
		?>
        
        <div class="book-item">
			<a href="book-details.php?id=<?=$row["id"]?>"><img class="book-item-img" src="<?= $BASE_URL?><?=$row["img"];?>"></a>
			<div class="book-header">
				<h3><a href="book-details.php?id=<?=$row["id"]?>"><?= $row["title"];?></a></h3>
				<h2 class="book-price"><?= $row["price"];?></h2>
			</div>
            <div class="delete-basket">
                <a href="<?=$BASE_URL?>/api/basket/delete.php?userId=<?=$row["userId"]?>&blogId=<?=$row["blogId"]?>">Удалить из корзины</a>
            </div>
		</div>


        <?php
				}
			}else{
		?>


        <h4>Корзина пуста</h4>

        <?php
            }
        ?>

    </div>

    <footer class="footer">
        <div class="footer-left">
            <div class="footer-left-logo">
                <img src="image/Logonetflix.png" alt="logo" width="100px">
            </div>
            <p>Вы можете смотреть сколько угодно и <br> когда угодно без рекламы по фиксированной <br> низкой цене за месяц.</p>
            <div class="footer-left-social">
                <a href="#"><img src="https://cdn1.iconfinder.com/data/icons/feather-2/24/instagram-256.png" alt="insta"
                        width="34px"></a>
                <a href="#"><img src="https://cdn3.iconfinder.com/data/icons/peelicons-vol-1/50/Twitter-256.png"
                        alt="twitter" width="34px"></a>
                <a href="#"><img src="https://cdn3.iconfinder.com/data/icons/peelicons-vol-1/50/Facebook-256.png"
                        alt="facebook" width="34px"></a>
            </div>
            <p>©2022Netflix</p>
        </div>
        <div class="footer-right">
            <div class="footer-right-text">
                <div class="footer-right-item">
                    <a style="font-weight: 700; color: #d11c1c; font-size: 23px;" href="#">Продукт</a> <br>
                    <a href="#">Скачать приложение на IOS/Android</a> <br>
                    <a href="#">Аккаунт</a> <br>
                    <a href="#">Центр поддержки</a> <br>
                    <a href="#">Способы просмотра</a> <br>
                    <a href="#">Только на Netflix</a> <br>
                    <a href="#">Конфиденциальность</a>
                </div>
                <div class="footer-right-item">
                    <a style="font-weight: 700; color: #d11c1c; font-size: 23px;" href="#">Информация</a> <br>
                    <a href="#">Медиацентр</a> <br>
                    <a href="#">Проверка скорости</a> <br>
                    <a href="#">Вакансии</a> <br>
                    <a href="#">Свяжитесь с нами</a>
                </div>

            </div>
        </div>
	</footer>

    
</body>
</html>