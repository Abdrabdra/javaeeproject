<?php
    include "../../config/base_url.php";
    include "../../config/db.php";
    session_start();
    
    if (isset($_POST["title"], $_POST["description"], $_POST["price"], $_POST["year"], $_POST["category_id"], $_GET["id"]) &&
    strlen($_POST["title"]) > 0 &&
    strlen($_POST["description"]) > 0 &&
    strlen($_POST["price"]) > 0 &&
    strlen($_POST["year"]) > 0 &&
    intval($_POST["category_id"]) &&
    intval($_GET["id"]) 
    ){
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $year = $_POST["year"];
        // $author_id = $_POST["author_id"];
        $cat_id = $_POST["category_id"];
        $id = $_GET["id"];
        //это проверка на фотографий если они пришли
        if(isset($_FILES["image"], $_FILES["image"]["name"])
         && strlen($_FILES["image"]["name"]) > 0){
            //запрос в базу
            $query = mysqli_query($con, "SELECT img FROM blogs WHERE id=$id");
        //проверка заполненли все
            if(mysqli_num_rows($query) > 0){
                //все данные перекидываем на новую переменную
                $row = mysqli_fetch_assoc($query);
                //это нужно для того что бы стереть старый путь
                $old_path = __DIR__."/../..".$row["img"];//ДИР проверять есть ли там фото
                //если токой фаил есть то  удаляем его
                if(file_exists($old_path)){
                    unlink($old_path);//это удаляет
                }
            }
            //здесь продолжаем путь после query

            //здесь проверка на расширение
            $ext = end(explode(".", $_FILES["image"]["name"]));
            //его уникальный имя
            $image_name = time().".".$ext;
            //здесь мы созроняем на ноут c путем
            move_uploaded_file($_FILES["image"]["tmp_name"],"../../image/blogs/$image_name");
            //после обновляем данные на БД
            $prep = mysqli_prepare($con, "UPDATE blogs SET title=?, description=?, img=?, year=?, price=?, category_id=? WHERE id=? AND author_id=".$_SESSION["user-id"]);
            //здесь мы пропысиваем новую путь в переменную
            $path = "/image/blogs/".$image_name;
            mysqli_stmt_bind_param($prep, "sssssii", $title, $description, $path,$year, $price, $cat_id, $id);
            mysqli_stmt_execute($prep);
        }else{//здесь уже когда картинка нам не пришло здесь уже сохроняем без картинки
            $prep = mysqli_prepare($con, "UPDATE blogs SET title=?, description=?, year=?, price=?, category_id=? WHERE id=? AND author_id=".$_SESSION["user-id"]);
            mysqli_stmt_bind_param($prep, "ssssii", $title, $description,$year, $price, $cat_id, $id);
            mysqli_stmt_execute($prep);
        }
        header("Location: $BASE_URL/profile.php?nickname=".$_SESSION["nickname"]);//если все хорошо
    }else{
        header("Location: $BASE_URL/edit-cinema.php?id=".$_GET["id"]."&error=3&nickname=".$_SESSION["nickname"]);//если из базы ничего не пришло
    }
?>