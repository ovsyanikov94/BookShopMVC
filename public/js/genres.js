$(document).ready( function (  ){


    $('#UpdateGenreButton').click( function (  ){

        let name = $('#UpdateGenreInput').val();

        if (/^[a-zа-я\s]{4,50}$/i.test(name) === false) {
            $('#errorInput').css("display", "block");

        }//if
        else{

            $('#errorInput').css("display", "none");
            let genreID = $( this ).data('genre-id');



            $.ajax({
                'url': `${window.paths.AjaxServerUrl}${window.paths.UpdateGenre}`,
                'type': 'POST',
                'data': {
                    'id': genreID,
                    'name': name,
                },
                'success': (data) => {

                    let genreId = +data.genreID;
                    let status = +data.status;

                    if (status === 200 && genreId !== 0) {

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000);

                    }//if
                    else {
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000);
                    }//else
                }

            });
        }

    }  );

    $('body').on('click', '#AddGenreButton', function () {

        let name = $('#AddGenreInput').val();

        if (/^[a-zа-я\s]{4,50}$/i.test(name) === false) {
            $('#errorInput').css("display", "block");

        }//if
        else{
            $('#errorInput').css("display", "none");

            $.ajax({
                'url': `${window.paths.AjaxServerUrl}${window.paths.AddGenre}`,
                'type': 'POST',
                'data': {
                    'name': name,
                },
                'success': (data) =>{

                    let genreId = +data.genreID;
                    let status = +data .status;
                    let amount = +data .amount;

                    if( status === 200 &&genreId!==0){

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000);

                        $('#GenresTable').append(`
                             <tr data-genre-id = "${genreId}">
                                <td>${genreId}</td>
                                <td>${name}</td>
                                <td>${amount}</td>
                                <td>
                                    <button data-genre-id="${genreId}" data-genre-name="${name}" class="btn btn-danger" >Удалить</button>
                                </td>
                                <td>
                                    <a href="${window.paths.AjaxServerUrl}${window.paths.UpdateGenre}/${genreId}" class="btn btn-primary" >Обновить</a>
                                </td>
                            </tr>`
                        );
                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000);
                    }//else



                }
            });
        }//else


    }  );


    $('body').on('click', '#noDeleteGenre', function () {
        $('#fon').css("display","none");
    });

    $('body').on('click', '#okDeleteGenre', function () {

        let genreID = +$('#genreIDLabel').text();
        $('#fon').css("display","none");

        let deleteURL = `${window.paths.AjaxServerUrl}${window.paths.RemoveGenre}`;
        deleteURL = deleteURL.replace(':genreID', genreID);

        let self = $(this);
        console.log('genreID: ', genreID);

        $.ajax({
            'url': deleteURL,
            'type': 'DELETE',
            'success': (data) => {

                if (+data.code === 200) {

                    $(`tr[data-genre-id=${genreID}]`).remove();

                }//if

            }//success
        });

    });

    $('body').on('click','.btn-danger' , function (  ){
        let name = $(this).data('genre-name');
        let genreID = $(this).data('genre-id');

        $('#genreIDLabel').text(genreID);
        $('#genreName').text(name);
        $('#fon').show();

    });
});
