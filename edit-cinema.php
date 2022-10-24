<?php
  include "config/base_url.php";
  include "config/db.php";

  $id = $_GET["id"];

  if(isset($_GET["id"])){
      $query = mysqli_query($con, "SELECT * FROM blogs WHERE id = $id");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Book</title>
    <?php
		include "views/head.php";
	?>
</head>
<body>

        <?php
			include "views/header.php";
		?>

    <div class="add-section">
		<div class="add-content">

			<h2>Изменить</h2>

			<form class="form-content" action="<?=$BASE_URL?>/api/blog/update.php?id=<?=$id?>" method="POST" enctype="multipart/form-data">
                
                <fieldset class="form-books">
                    <input type="text" name="title" placeholder="Заголовок">
                </fieldset>

				<fieldset class="form-books" style="margin-left:40px">
					<select name="category_id" class="select-book" style="border-radius: 8px;">
                    <?php
                        $query_cat = mysqli_query($con, "SELECT * FROM categories");
                        while($category = mysqli_fetch_assoc($query_cat)){
                        echo "<option value='".$category["id"]."'>".$category["name"]."</option>";
                        }
                    ?>
					</select>
				</fieldset>
			
                <fieldset class="fieldset" style="margin-left:40px">
                    <button class="red-button">
                    <input type="file" name="image">
                    Выберите картинку
                    </button>
                </fieldset>
			
                <fieldset class="form-books" style="margin-left:40px">
                    <textarea class="input-textarea" name="description" id="" cols="40" rows="10" placeholder="Описание"></textarea>
				</fieldset>

                <fieldset class="form-books">
                    <input type="text" name="price" id="" placeholder="Цена">
                </fieldset>

                <fieldset class="form-books">
                    <input type="text" name="year" id="" placeholder="Год">
                </fieldset>

                <input type="hidden" name="author_id" value="<?=$_SESSION["user-id"]?>">

                <fieldset class="form-books">
					<button  class="red-button" type="submit">Сохранить</button>
				</fieldset>
			
            </form>
		</div>
	</div>
    
</body>
</html>


<?php
    }else{
        header("Location: $BASE_URL/profile.php");
    }
    }else{
        header("Location: $BASE_URL/profile.php");
    }
?>