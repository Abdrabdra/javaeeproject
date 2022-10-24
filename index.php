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
	<title>Netflix</title>
	<?php
		include "views/head.php";
	?>
</head>
<body>

		<?php
			include "views/header.php";
		?>



	<div class="netflix_content">
		<img src="image/KZ-ru-20221017-popsignuptwoweeks-perspective_alpha_website_large.jpg" alt="">
		<div class="netflix_content_items">
			<h2>Фильмы, сериалы и <br> многое.</h2>
		</div>
	</div>

	<h2 class="xit_weaks">Хит этой недели</h2>
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
				<center><a href="book-details.php?id=<?=$row["id"]?>">Смотреть</a></center>
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
				<p>Элитному наемному убийце Джону Уику в третий раз не удается уйти на пенсию. Он нарушил законы отеля для киллеров «Континенталь», совершив убийство на его территории, и сам стал мишенью для полчищ наемников.</p>
				<span>Боевик</span>
				<center><a href="#">Смотреть</a></center>
			</div>
		</div>
	</div>

	<form class="header-item" method="GET" style="margin-left: 330px;">
				<span class="span-header"><input type="text" name="q" placeholder="Поиск по фильмам..."></span>
				<button type="submit" class="button-search">
					<img src="<?=$BASE_URL?>/image/search.svg"alt="">
					Найти
				</button>
			</form>
	<div class="categories">
		<div class="categories-item-25">
	
			<?php
				include "views/categories.php";
			?>
			
		</div>

		<div class="cat-books">
					<?php
						if(mysqli_num_rows($query) > 0){
						while($row = mysqli_fetch_assoc($query)){
					?>
					

					<div class="book-item">
						<a href="book-details.php?id=<?=$row["id"]?>"><img class="book-item-img" src="<?= $BASE_URL;?><?=$row["img"];?>"></a>
						<div class="book-header">
							<h3 style="margin-top: 50px"><a href="book-details.php?id=<?=$row["id"]?>"><?= $row["title"];?></a></h3>
							<!-- <h2 class="book-price"><?= $row["price"];?></h2> -->
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

	<div class="watch_in_tv">
		<div class="watch-item">
			<h2>Смотрите на <br> телевизоре.</h2>
			<h3>Смотрите на Smart TV, PlayStation, Xbox, <br> Chromecast, Apple TV, плеерах Blu-ray и <br> других устройствах.</h3>
		</div>
		<div class="watch-item">
			<video class="watch-item-video" autoplay playsinline muted loop>
				<source src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/video-tv-0819.m4v" type="video/mp4">
			</video>
		</div>
	</div>
	<div class="watch_in_tv-2">
		<div class="watch-item-img">
			<img src="image/mobile-0819.jpg">
			<div class="gifs">
                <img src="image/boxshot.png" alt="" width="60px">
                <div class="gifs-text">
                	<h2>Очень странные дела</h2>
                	<h4>Идет загрузка...</h4>
                </div>
                <div class="gifs-gif"></div>
            </div>
		</div>
		<div class="watch-item">
			<h2>Загружайте сериалы <br> для просмотра <br> офлайн.</h2>
			<h3>Сохраняйте видео в избранном, и у вас <br> всегда будет, что посмотреть.</h3>
		</div>
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




    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
	<script src="js/script.js"></script>
</body>
</html>