<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<?php
		include "views/head.php";
	?>
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
		<form method="POST" action="api/user/signup.php">
		<h2>Регистрация</h2>
		<fieldset class="form-books">
			<input type="text" name="email" placeholder="Адрес электронной почты">
		</fieldset>
		<fieldset class="form-books">
			<input type="text" name="full_name" placeholder="Имя">
		</fieldset>
		<fieldset  class="form-books">
			<input type="text" name="nickname" placeholder="Никнэйм">
		</fieldset>

		<fieldset class="form-books">
			<input type="text" name="password" placeholder="Пароль">
		</fieldset>
		<fieldset class="form-books">
			<input type="text" name="password2" placeholder="Подверждение пароля">
		</fieldset>
		<fieldset  class="form-books">
			<button class="book-btn-register" type="submit">Зарегистрироваться</button>
		</fieldset>
		<p class="p_first2">У вас уже есть аккаунт?<a href="login.php">Войти</a></p>
	</form>
	</div>
</body>
</html>