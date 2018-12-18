
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
            'success': ( )=>{

                $('#ResultAddGenreLabel').text("Запрос прошел успешно!");
            },
            'error':()=>{
                $('#ResultAddGenreLabel').text("Запрос не прошел!");
            },
        });

    }  );

    $(function (){
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


} );