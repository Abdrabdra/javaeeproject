 <?php
      include "../../config/base_url.php";
      include "../../config/db.php";


      //сюда у нас все пришли в формате JS а нам нужно формат JSON
      //все инфо который пришла , они у нас храниться в data
      $data = json_decode(file_get_contents('php://input'), true);
      // json_decode - делает формат в виде JSON 


      //проверка пришла ли инфо
      if(isset($data["text"], $data["blog_id"]) &&
      intval($data["blog_id"]) &&
      strlen($data["text"]) > 0

      // intval - пров*еряет id
      // strlen -  проверяет на текст
      ){
        //прировняем
          $text = $data["text"];
          $blog_id = $data["blog_id"];
      
            session_start();//открываем сессию что бы взять $_SESSION["user-id"]

            //отправляем данные в БД
            $prep = mysqli_prepare($con, "INSERT INTO comments (text, blog_id, user_id) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($prep, "sii", $text, $blog_id, $_SESSION["user-id"]);
            mysqli_execute($prep);

            $commentId = mysqli_stmt_insert_id($prep);//из всего он берет только id кометария


            //здесь все что мы отправили в БД  вытаскиваем 
            //c.user_id = u.id WHERE c.id = $commentId");-вытаскивает тот комент которую мы только что добавили в верху
            $query = mysqli_query($con, "SELECT c.*, u.full_name FROM comments c LEFT OUTER JOIN users u ON c.user_id = u.id WHERE c.id = $commentId");


            //проверка пришло ли что то
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                //то что написано сверху все это JSON
                // делаем формат под JS ИЗ формата json
                echo json_encode($row);
            }
            else{//ничего не пришло то ошибка
                echo "error";
            }

        }
?> 


