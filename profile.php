<?php
	include "config/base_url.php";
	include "config/db.php";

	session_start();

	$q = "";
	$sql = "SELECT b.*, u.nickname, c.name FROM blogs b LEFT OUTER JOIN users u ON b.author_id = u.id LEFT OUTER JOIN categories c ON b.category_id = c.id";


	if(isset($_GET["category_id"]) && intval($_GET["category_id"])){
		$sql.= " WHERE b.category_id = ".$_GET["category_id"];
	}

	
	if(isset($_GET["q"])){
		$q = strtolower($_GET["q"]);
		$sql.= " WHERE LOWER(b.title) LIKE ? OR LOWER (b.description) LIKE ? OR LOWER (u.nickname) LIKE ?";
	}


	if($q){
		$param = "%$q%";

		$prep_books = mysqli_prepare($con, $sql);
		mysqli_stmt_bind_param($prep_books, "sss", $param, $param, $param);
		mysqli_execute($prep_books);
		$query = mysqli_stmt_get_result($prep_books);
	}
	else{
		$query = mysqli_query($con, $sql);
	}
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Profile</title>
	<?php
		include "views/head.php";
	?>
	</head>
<body>

		<?php
			include "views/header.php";
		?>


	<section class="profile">
		<div class="profile-main">

			<div class="main">
				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="first-img" src="image/бэтмен.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Бэтмен</h1>
						<p>После двух лет поисков правосудия на улицах Готэма для своих сограждан Бэтмен становится олицетворением беспощадного возмездия.</p>
						<span>Детектив</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>

				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="second-img" src="image/интерстеллар.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Интерстеллар</h1>
						<p>Наше время на Земле подошло к концу, команда исследователей берет на себя самую важную миссию в истории человечества; путешествуя за пределами нашей галактики, чтобы узнать есть ли у человечества будущее среди звезд.</p>
						<span>Драма</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>

				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="third-img" src="image/главынй.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Главный Герой</h1>
						<p>У сотрудника крупного банка всё идёт по накатанной, пока он однажды не выясняет, что окружающий его мир — часть огромной видеоигры, где игроки могут делать всё, что захотят.</p>
						<span>Комедия</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>

				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="first-img" src="image/мстители.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Мстители: Финал</h1>
						<p>Оставшиеся в живых члены команды Мстителей и их союзники должны разработать новый план, который поможет противостоять разрушительным действиям могущественного титана Таноса.</p>
						<span>Фантастика</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>


				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="second-img" src="image/тихоеместо.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Тихое место 2</h1>
						<p>Семья Эбботт продолжает бороться за жизнь в полной тишине. Вслед за смертельной угрозой, с которой они столкнулись в собственном доме, им предстоит познать ужасы внешнего мира.</p>
						<span>Ужасы</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>

				<div class="main-item">
					<div class="main-item-image">
						<div class="main-item-cont">
							<img class="third-img" src="image/джон.jpg">
						</div>
					</div>

					<div class="main-item-text">
						<h1>Джон Уик 3</h1>
						<p>Элитному наемному убийце Джону Уику в третий раз не удается уйти на пенсию. Он нарушил законы отеля для киллеров«Континенталь», совершив убийство на его территории, и сам стал мишенью для полчищ наемников.</p>
						<span>Боевик</span>
						<center><a href="#">Смотреть</a></center>
					</div>
				</div>
			</div>

			<div class="profile-my-books">
				<div class="profile-config">
					<h2>Мои фильмы</h2>
					<?php
						if($_SESSION["nickname"] == $_GET["nickname"]){
					?>
					
					<a href="addbook.php">Добавить фильм</a>

					<?php
						}
					?>
					
				</div>
				
				<div class="books">
					<?php
						$nickname = $_GET["nickname"];

						if(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_assoc($query)){
					?>
					
					<div class="book-item">
						<a href="book-details.php?id=<?=$row["id"]?>"><img class="book-item-img" src="<?= $BASE_URL;?><?=$row["img"];?>"></a>
						<div class="book-header">
							<h3><a href="book-details.php?id=<?=$row["id"]?>"><?= $row["title"];?></a></h3>
							<h2 class="book-price"><?= $row["price"];?></h2>

							<a class="book-item-a" href="<?=$BASE_URL?>/edit-cinema.php?id=<?=$row["id"]?>">Изменить</a>
							<a class="book-item-a" href="<?=$BASE_URL?>/api/blog/delete.php?nickname=<?=$nickname?>&id=<?=$row["id"]?>">Удалить</a>
						</div>
					</div>


					<?php
							}
						}else{
					?>


					<h4>0 фильмов</h4>

					<?php
						}
					?>

				</div>

			</div>

		</div>
	</section>

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

	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js">
	</script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script src="js/script.js"></script>
</body>

</html>