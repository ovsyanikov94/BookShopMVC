$(document).ready( function (  ){

    $('#UpdateGenreButton').click( function (  ){

        let genreID = $( this ).data('genre-id');

        console.log('genreID: ' , genreID);

        $.ajax({
            'url': `${window.paths.AjaxServerUrl}${window.paths.UpdateGenre}`,
            'type': 'PUT',
            'data': {
                'id': genreID,
                'name': $('#UpdateGenreInput').val(),
            },
            'success': ( )=>{

                $('#ResultUpdateGenreLabel').text("Запрос прошел успешно!");
            },
            'error':()=>{
                $('#ResultUpdateGenreLabel').text("Запрос не прошел!");
            },
        });

    }  );

    $('#AddGenreButton').click( function (  ){
       let name = $('#AddGenreInput').val();
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

                if( status === 200 ){

                    $('#errorMessage').fadeOut(1000);
                    $('#successMessage').fadeIn(1000);

                }//if
                else{
                    $('#successMessage').fadeOut(1000);
                    $('#errorMessage').fadeIn(1000);
                }//else

                $('#GenresTable').append(`
                    <tr data-genre-id = "${genreId}">
                        <td>${genreId}</td>
                        <td>${name}</td>
                        <td>${amount}</td>
                        <td>
                            <button data-genre-id="${genreId}" class="btn btn-danger" >Удалить</button>
                        </td>
                        <td>
                            <a href="${window.paths.AjaxServerUrl}genre" class="btn btn-primary" >Обновить</a>
                        </td>
                    </tr>`
                );

            }
        });

    }  );
    $('#btnTest').click( function (  ) {
        $('#myModal').modal("show");
    });

    //$('#myModal').modal("show");
    $('body').on('click','.btn-danger' , function (){



        let genreID = +$( this ).data('genre-id');

        let deleteURL = `${window.paths.AjaxServerUrl}${window.paths.RemoveGenre}`;
        deleteURL = deleteURL.replace(':genreID' , genreID);

        let self = $(this);
        console.log('genreID: ' , genreID);

        $.ajax({
            'url': deleteURL,
            'type': 'DELETE',
            'success': ( data )=>{

                if( +data.code === 200 ){

                    $(`tr[data-genre-id=${genreID}]`).remove();

                }//if

            }//success
        });

    }  );

});
