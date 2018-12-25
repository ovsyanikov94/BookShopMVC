"use strict";

(function () {

    $('document').ready(function () {

        //кнопка "Войти" на странице авторизации
        $('#Login').click( function() {

            let loginOrEmail = $('#loginOrEmailInput').val();
            let password = $('#passwordInput').val();

           //проверяем установку "Запомнить меня"
           let isRememberMeChecked = $('#rememberMeCheckBox').is(':checked');

            //проверка на пустое в поле логина
            if(!loginOrEmail){

                $('#errorInput')
                    .text('Забыли ввести Логин или Email')
                    .fadeIn(500)
                    .delay(3000)
                    .fadeOut(2000);

                return;

            }//if

            //проверка на пустое в поле пароля
            if(!password){

                $('#errorInput')
                    .text('Забыли ввести свой пароль')
                    .fadeIn(500)
                    .delay(3000)
                    .fadeOut(2000);

                return;

            }//if

            //проверка поля логина на корректность ввода
            if( !/^[a-zA-ZА-Яа-я\d]{4,16}$/i.test(loginOrEmail) ){

                $('#errorInput')
                    .text('Логин содержит не корректные символы.')
                    .fadeOut(500)
                    .delay(3000)
                    .fadeIn(2000);

                return;

            }//if

            let url = `${window.paths.AjaxServerUrl}${window.paths.Login}`;

            $.ajax({
                'url': url,
                'type': 'GET',
                'data': {
                    login: loginOrEmail,
                    password: password,
                    rememberMeCheckbox: isRememberMeChecked
                },//data
                'success': (data) => {

                    //если пользователь не подтвердил свой Email
                    if(data.code === 405 && !data.emailVerify){

                        $('#errorInput')
                            .html("Ваш Email не подтверждён!<br> Проверьте свой Email.")
                            .fadeOut(750)
                            .delay(2500)
                            .fadeIn(1500);

                        return;

                    }//if

                    //если пользователь не найден в базе
                    if(!data.authorize){

                        $('#errorInput')
                            .html("Такой Логин/Email или Пароль не существуют!<br> Вы можете зарегестрироваться.")
                            .fadeOut(750)
                            .delay(2500)
                            .fadeIn(1500);

                    }//if
                    else{

                        //location.href = `${window.paths.AjaxServerUrl}authors`;

                    }//else

                },//seccess

            });

        });

    });

})();