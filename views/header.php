<header class="header">
			<div class="header-item">
				<a href="main.php"><img class="header-logo" src="image/Logonetflix.png"></a>			
			</div>


			<div class="header-item">
				<div style="display: flex; justify-content: space-between; align-items: center;">            
					<?php
						if(isset($_SESSION["user-id"])){
					?>
					<!-- <a href="" class="header-icon"><img src="image/favorites.svg" alt=""></a> -->
					<a href="<?=$BASE_URL?>/basket.php?id=<?=$_SESSION["user-id"]?>" class="header-icon"><img src="image/basket.svg" alt=""></a>
					<a href="profile.php?nickname=<?= $_SESSION["nickname"];?>">					
						<img class="avatar" style="width: 30px; margin-right: 20px" src="image/avatar.svg" alt="Avatar">
					</a>
					<a href="api/user/signout.php" class="signout"> Выход</a>

					<?php
						}else{
					?>

					<div class="header-item">
						<div class="button-group">
							<a class="signin" href="login.php">Войти</a>
							<a class="signup" href="register.php">Регистрация</a>
						</div>
					</div>

					<?php
						}
					?>
				</div>
			</div>
</header>