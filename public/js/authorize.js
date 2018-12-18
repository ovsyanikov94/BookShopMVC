"use strict";

(function () {

    //кнопка "Войти" на странице авторизации
    $('#Login').click( function() {

        let loginOrEmail = $('#loginOrEmailInput').val();
        let password = $('#passwordInput').val();

        let url = `${window.paths.AjaxServerUrl}${window.paths.Login}`;

        //console.log("login: " , loginOrEmail, "password: ", password);

        $.ajax({
            'url': url,
            'type': 'POST',
            'data': {
                login: loginOrEmail,
                password: password
            }

        });

    });

})();