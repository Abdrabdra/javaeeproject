<?php
	include "config/db.php";
	include "config/base_url.php";

	$id = $_GET["id"];

	if(!isset($_GET["id"]) || !intval($_GET["id"])) {//это если ничего не пришло
		header("Location: $BASE_URL");
		exit();
	}

	$query_b = mysqli_query($con, "SELECT b.*, u.nickname, c.name FROM blogs b LEFT OUTER JOIN users u ON b.author_id = u.id LEFT OUTER JOIN categories c ON b.category_id = c.id WHERE b.id=$id");// пишем прямо как в индексе 

	if (mysqli_num_rows($query_b) == 0) { // если ничего не пришло
		header("Location: $BASE_URL");
		exit();
	}else{
		$blog = mysqli_fetch_assoc($query_b);//здесь уже что то пришел
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cinema details</title>
	<?php
		include "views/head.php";
	?>

</head>
<body data-baseurl="<?=$BASE_URL?>"  data-authorid="<?=$blog["author_id"]?>">

		<?php
			include "views/header.php";
		?>

        <div class="details">
			<div class="details-content">
				<div class="details-image">
					<img class="details-image-img" src="<?=$BASE_URL?>/<?=$blog["img"]?>" alt="">
				</div>
				
				<div class="details-text">
					<h2>Название: <?=$blog["title"]?></h2>
					<h4>Описание: <?=$blog["description"]?></h4>
					<h5>Цена: <?=$blog["price"]?></h5>
					<h6>Год: <?=$blog["year"]?></h6>
				</div>


                <?php
                	if (isset($_SESSION["user-id"])){
                ?>

				<div class="details-button">
					<a href="<?=$BASE_URL?>/api/basket/add.php?userId=<?=$_SESSION["user-id"]?>&blogId=<?=$blog["id"]?>" class="basket-button">Добавить в корзину</a>
				</div>

				<?php
					}
				?>

			</div>


            <div class="comments" id="comments"></div>

                <?php
                if (isset($_SESSION["user-id"])) { //если зареган то может писатb комменты а если не может
                ?>

                <div class="comment-add">
                    <textarea class="comment-textarea" name="" id="comment-text" cols="100" rows="10" placeholder="Напишите отзыв о фильме..."></textarea>
                    <button id="add-comment" class="comment-button">Отправить</button>
                </div>

                <?php
                    }else{ // здесь уже предупреждение что пользлватель зарегался
                ?>
                
                <span class="comment-warning">
                    Чтобы оставить комментарий <a href="">зарегистрируйтесь</a> , или <a href="">войдите</a>  в аккаунт.
                </span>

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script> 
    <script src="js/comment.js"></script>
</body>
</html>