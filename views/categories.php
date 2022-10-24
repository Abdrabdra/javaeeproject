<div  class="categories-item-25-cont">
			<label class="label"><img  src="image/search.svg"><input style="display: block;" class="cat-inp" type="text" name="" placeholder="Search categories and..."></label>
			<h1>Популярные категории</h1>
			<span class="span"></span>

			<?php
				$query_cat = mysqli_query($con, "SELECT * FROM categories");
				while($row = mysqli_fetch_assoc($query_cat)){
			?>
				<a class="list-a" href="?category_id=<?=$row["id"]?>"><?=$row["name"];?></a>
			<?php
				}
			?>	
</div>