const UrlParams = new URLSearchParams(window.location.search)
const id = UrlParams.get("id")
const base_url = document.body.dataset.baseurl 
const authorId = document.body.dataset.authorid
const comments_div = document.getElementById("comments")
const textArea = document.getElementById("comment-text")
const addComment = document.getElementById("add-comment")
const currentUserId = localStorage.getItem("user-id")



function getComments() {//этот функция выводит на html и подключаеться на БД
    //здесь аксиос делать запрос и если запрос одобрен то проходить на THEN 
    //и then вернеть res это результать
    axios.get(base_url + "/api/comment/list.php?id=" + id).then((res) => {//аксиоз это запрос из js на php
        
        //если все верно то через showComments мы выводим коммент в html
        showComments(res.data)
    })
}





function showComments(comments){//это функия вызывается из комментов из БД и выводид его в виде HTML
    let commentHTML = `<h2> ${comments.length} отзыва </h2>`//это равен сколько у нас есть комментариев
    
    //здесь проверка если автор_айди равен на юзер айди это значить то что он создатель блога 
    //и он может удалить коммент других юзеров 
        for(let i = 0; i < comments.length; i++){//выводим все с помющю цикла
          let deleteButton = ``;

          if(currentUserId == authorId || currentUserId == comments[i].user_id){
      //если прошел проверку то может удалить коммент
        deleteButton = `<span style="
        margin: 0 0 0 1400px;
        color: #fff;
        text-decoration: none;
        background-color: #d11c1c;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: 900;
        outline: none;
        border: none;"
        onclick="removeComment(${comments[i].id})"> Удалить отзыв </span>`
    }


      //если есть новые комментарий то довавляет каждого
      // здесь у каждого комментарий есть свой уникальный айди
        commentHTML += `
        <div class="comment-user" id="comment-${comments[i].id}>
            <div class="comment-header">
                <img class="comment-image" src="${base_url}/image/feedback.svg">

                <h5 style="    
                color: #ffffff;
                font-size: 20px;
                font-weight: 900;
                margin-top: 20px;
                margin-left: 25px;
                ">${comments[i].full_name}</h5>

                ${deleteButton}
            </div>

            <div class="comment-footer">
                <h1>${comments[i].text}</h1>
            </div>
            
        </div>
        `;
        //comments эта аргумент функций
        //по сути comments равен на все что есть в БД  
    }
    comments_div.innerHTML = commentHTML//это выводить комент в html 
}


getComments()



addComment.onclick = function(){//при клике переходить на add.php
    //с метожом ПОСТ отправляем все инфу в БД 
      axios.post(base_url + "/api/comment/add.php", {
        //здесь уже у нас все Json формате а не JS
          text: textArea.value,//это параметры значить в текстовом 
          //формате это у нас textarea и этоже textarea наша комментария и его значение
          blog_id: id, // здесь наша blog_d его значения id 
          //если все ок тогда переходим его THEN
      })
      .then((res) => {
          getComments()//после проверки add.php  мы снова вызываем функцую
          textArea.value = ""//после клика textarea и его значение будет пустыми
          //это для того что бы после написание коммента и после клика не осталься комент которую мы писали 
      })
  }
  
  
  function removeComment(commentId) {
    axios
      .delete(base_url + "/api/comment/delete.php?id=" + commentId)
      .then((res) => {
        getComments();
      });
  }
  