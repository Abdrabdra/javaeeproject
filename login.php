<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include "views/head.php";
	?>
	
	<title>Login</title>

</head>
<body>
	


		<header class="header">
			<div class="header-item">
				<a href="main.php"><img class="header-logo" src="image/Logonetflix.png"></a>			
			</div>
		</header>


<div class="login-back-img">
	<img src="image/KZ-ru-20221017-popsignuptwoweeks-perspective_alpha_website_large.jpg" alt="">
</div>
	<div class="login-div">
		<form method="POST" action="api/user/signin.php">
		<h2>Войти</h2>
		<fieldset class="form-books">
			<input type="text" name="email" placeholder="Адрес электронной почты или номер телефона">
		</fieldset>
		<fieldset class="form-books">
			<input type="text" name="password" placeholder="Пароль">
		</fieldset>
		
		<fieldset  class="form-books">
			<button class="book-btn" type="submit">Войти</button>
		</fieldset>
		<p class="p_first">Впервые на Netflix?<a href="register.php"> Зарегистрируйтесь сейчас.</a></p>
		<p class="p_docs">Эта страница защищена Google reCAPTCHA, чтобы мы знали, что вы не бот. Подробнее.</p>
	</form>
	</div>

</body>
</html>