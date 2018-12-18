"use strict";

window.paths = {
    AjaxServerUrl: '/BookShopMVC/public/',
    RemoveAuthor: 'author/:authorID',
    UpdateAuthor: 'author/:authorID',
    AddAuthor: 'author',
};

$( document ).ready( ()=>{

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