"use strict";

(function () {

    $('document').ready(function () {

        //кнопка "Сменить аватар"
        $('#changeAvatarButton').click( function() {

            console.log('Change Avatar');

            $('#hiddenAvatarBlock').show();

        });//#changeAvatarButton

        //сохранить новую фотографию
        $('#saveNewAvatar').click( async function () {

            console.log('Save Avatar');

            //получаем файл
            let avatarFile = $('#avatarFile').prop('files');

            //проверяем наличие файла
            if(avatarFile.length !== 0){

                let newAvatarFile = avatarFile[0];

                //берём расширениеи полученного файла
                let extsn = newAvatarFile.name.substring(newAvatarFile.name.lastIndexOf('.'));

                //допустимые расширения для загрузки
                const extentions = [
                    '.jpg',
                    '.jpeg',
                    '.png',
                    '.bmp',
                ];

                //проверяем расширение файла на допустимое
                if( extentions.indexOf( extsn ) ){

                    $('#errorInput').text('Тип файла некорректен').fadeIn(500).delay( 5000 ).fadeOut( 500 )
                    return;

                }//if

                let avatarData = new FormData();
                avatarData.append('avatarFile', newAvatarFile);

                try{

                    let url = `${window.paths.AjaxServerUrl}${window.paths.SaveNewAvatar}`;

                    let newAvatarResponse = await $.ajax({

                        url: url,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: avatarData

                    });

                    if( +newAvatarResponse.code === 200 ){

                        $('#successMessage').fadeIn(200).delay(5000).fadeOut(1500);

                    }//if
                    else{

                        $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

                    }//else

                }//try
                catch(ex){

                    $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

                    console.log(ex);

                }//catch

            }//if


            $('#hiddenAvatarBlock').hide();

        });//#savePhoto


    });//document.ready

})();



