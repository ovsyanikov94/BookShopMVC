"use strict";



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

        let login = $('#login').val();

        let isTrueLogin = /^[a-zA-ZА-Яа-я\d]{4,16}$/i.test(login);


        if(!isTrueLogin){
            $('#loginError').addClass("red ");
        }//if

        let email =$('#email').val();
        let isTrueEmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(email);

        if(!isTrueEmail){
            $('#emailError').addClass("red ");
        }//if

        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();
        let isTruePassword = /^[a-z0-9_?!^%()\d]{6,30}$/i.test(password);

        if(!isTruePassword || password!==confirmPassword) {
           let test = $('#confirmPasswordError');

            test.removeClass("none");
            test.addClass("red block");
        }//if


        if(isTrueLogin&&
            isTrueEmail&&
            isTruePassword&&
            (password===confirmPassword)
        ){
            console.log('start ajax');

            $.ajax({
                'url': `/BookShopMVC/public/addUser`,
                'type': 'POST',
                'data': {
                    'userLogin':login,
                    'userEmail':email,
                    'userPassword':password
                },
                'success': (data) => {
                    console.log(data);
                    console.log('наверное тут редирект на авторизацию');
                },//success
            })//ajax
        }//if

    });

} );


window.paths = {
    AjaxServerUrl: '/BookShopMVC/public/',
    RemoveAuthor: 'author/:authorID',
    UpdateAuthor: 'author/:authorID',
    AddAuthor: 'author',
};