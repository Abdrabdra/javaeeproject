<?php
	include "../../config/base_url.php";
	include "../../config/db.php";

	session_start();
	if(isset($_GET["nickname"]) && strlen($_GET["nickname"])){
		$prep = mysqli_prepare($con, "SELECT b.* , u.nickname, c.name FROM blogs b LEFT OUTER JOIN categories c ON b.category_id = c.id LEFT OUTER JOIN users u ON b.author_id = u.id WHERE u.nickname = ?");
		mysqli_stmt_bind_param($prep, "s", $_GET["nickname"]);
		mysqli_execute($prep);
		
		$query_bl = mysqli_stmt_get_result($prep);
		$blogs = array();

		if(mysqli_num_rows($query_bl) > 0){
			while($row = mysqli_fetch_assoc($query_bl)){
				$blogs[] = $row;
			}
		}
		echo json_encode($blogs);
	}
?>