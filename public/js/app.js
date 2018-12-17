'use strict';


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

    $('#moreUser').click(function () {



    });

    $('#checkIn').click(function () {
        console.log('start button');
        let login = $('#login').val();

        console.log('login',login);
        let isTrueLogin = /^[a-z\d]{4,16}$/i.test(login);

        console.log('login:',isTrueLogin);
        setTimeout(()=>{
            console.log('login:',isTrueLogin);
        },3000);

        if(!isTrueLogin){
            $('#loginError').addClass("red ");
        }//if
        let email =$('#email').val();
        let idTrueEmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(email);
        setTimeout(()=>{
            console.log('login:',idTrueEmail);
        },3000);
        if(!idTrueEmail){
            $('#emailError').addClass("red ");
        }//if
        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();
        let isTruePaswword = /^[a-z_?!^%()\d]{6,30}$/i.test(password);

        if(!isTruePaswword || password!==confirmPassword) {
            $('#confirmPasswordError').addClass("red none");
        }

        setTimeout(()=>{},5000);
        if(isTrueLogin&&
            idTrueEmail&&
            isTruePaswword&&
            (password === confirmPassword)
        ){
            console.log('start ajax');

            let data = new FormData();
            data.set('userLogin', login);
            data.set('userEmail', email);
            data.set('userPassword',password);

            $.ajax({
                'url': `/BookShopMVC/public/addUser`,
                'type': 'POST',
                'data': data,
                'success': (a, b) => {
                    console.log(a, b);
                    console.log('наверное тут редирект на авторизацию');
                },//success
            })//ajax
        }//if

    });

} );

