$(document).ready( function (  ){

    let errorMessage = $('#errorMessage');
    let successMessage = $('#successMessage');

    $('#UpdateGenreButton').click( function (  ){

        let genreID = $( this ).data('genre-id');

        console.log('genreID: ' , genreID);

        $.ajax({
            'url': `/BookShopMVC/public/genre`,
            'type': 'POST',
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

        $.ajax({
            'url': `/BookShopMVC/public/add_genre`,
            'type': 'POST',
            'data': {
                'name': $('#AddGenreInput').val(),
            },
            'success': ( response )=>{

                debugger;

                if( +response.code === 200 ){

                    $('#errorMessage').fadeOut(1000);
                    $('#successMessage').fadeIn(1000);

                }//if
                else{
                    $('#successMessage').fadeOut(1000);
                    $('#errorMessage').fadeIn(1000);
                }//else

            }
        });

    }  );

    $('#removeGenreButton').each(function(i){

        $(this).html(i).click(function(){
            let genreID = $( this ).data('genre-id');

            console.log('genreID: ' , genreID);

            $.ajax({
                'url': `/BookShopMVC/public/genre/${genreID}`,
                'type': 'DELETE',

                'success': ( )=>{

                    $('#ResultDeleteGenreLabel').text("Удаление прошдо успешно!");
                    location.reload();

                    //$("tr").eq(${genreID}).remove();
                },
                'error':()=>{
                    $('#ResultDeleteGenreLabel').text("Запрос не прошел!");
                },
            });

        });
    });

    $(".remove-genre").click( function (){

        let genreID = $( this ).data('genre-id');

        console.log('genreID: ' , genreID);

        $.ajax({
            'url': `/BookShopMVC/public/genre/${genreID}`,
            'type': 'DELETE',

            'success': ( )=>{

                $('#ResultDeleteGenreLabel').text("Удаление прошдо успешно!");
                location.reload();

                //$("tr").eq(${genreID}).remove();
            },
            'error':()=>{
                $('#ResultDeleteGenreLabel').text("Запрос не прошел!");
            },
        });

    }  );

});
