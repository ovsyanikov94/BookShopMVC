$(document).ready( function (  ){

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
});


