
$( document ).ready( ()=>{

    $('#removeAuthor').click( function (  ){

       let authorID = $( this ).data('author-id'); 

       console.log('authorID: ' , authorID);

       $.ajax({
           'url': `/BookShopMVC/public/author/${authorID}`,
           'type': 'DELETE',
           'success': ( a , b)=>{
               console.log(a,b);
           }
       });
       
    }  );

    //кнопка "Войти" на странице авторизации
    $('#Login').click( function() {

        let loginOrEmail = $('#loginOrEmailInput').val();
        let password = $('#passwordInput').val();

        //console.log("login: " , loginOrEmail, "password: ", password);

        $.ajax({
           'url': "/BookShopMVC/public/login",
           'type': 'POST',
           'data': {
               login: loginOrEmail,
               password: password
           }

        });

    });

} );