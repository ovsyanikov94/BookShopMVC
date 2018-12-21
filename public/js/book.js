$(document).ready( function (  ){

    $('#AddBookButton').click( async function ( ){

        const extentions = [
            '.jpg',
            '.jpeg',
            '.png',
            '.bmp',
        ];

        let bookTitle = $('#bookTitle').val();
        let bookISBN = $('#bookISBN').val();
        let bookPages = $('#bookPages').val();
        let bookPrice = $('#bookPrice').val();
        let bookAmount = $('#bookAmount').val();
        //
        if(/^[а-яa-z0-9\s]{3,50}$/i.test(bookTitle) === false ){

            $('#errorInput').css("display", "block").text('Название некорректно!');
            return;

        }//if

        if(/^\d{9}[\d|X]$/.test(bookISBN) === false ){

            $('#errorInput').css("display", "block").text('ISBN некорректен!');
            return;
        }//if

        if(/\d{1,10}$/.test(bookPages) === false ){

            $('#errorInput').css("display", "block").text('Страницы некорректны');;
            return;
        }//if

        if(/^\d{1,7}/.test(bookPrice) === false ){

            $('#errorInput').css("display", "block").text('Цена некорректна');;
            return;
        }//if

        if(/^\d{1,5}/.test(bookAmount) === false ){

            $('#errorInput').css("display", "block").text('Кол-во некорректно');
            return;
        }//if

        let bookData = new FormData();
        bookData.append('bookTitle' , bookTitle);
        bookData.append('bookISBN' , bookISBN);
        bookData.append('bookPages' , bookPages);
        bookData.append('bookPrice' , bookPrice);
        bookData.append('bookAmount' , bookAmount);

        let files =  $('#bookFile').prop('files');

        if(files.length !== 0){

            let file = files[0];

            let ext = file.name.substring(file.name.lastIndexOf('.'));

            if( extentions.indexOf( ext ) === -1 ){

                $('#errorInput').text('Тип файла некорректен').css("display", "block");
                return;

            }//if

            bookData.append('bookImage' , file);

        }//if

        let authors = [].map.call( $('#authorsList option:selected') , ( opt )=>{ return $(opt).data('author-id') } );
        let genres = [].map.call( $('#genresList option:selected') , ( opt )=>{ return $(opt).data('genre-id') } );

        if(  authors.length === 0 ){

            $('#errorInput').css("display", "block").text('Авторы не выбраны!');
            return;

        }//if

        if(  genres.length === 0 ){

            $('#errorInput').css("display", "block").text('Жанры не выбраны!');
            return;

        }//if

        bookData.append('authors' , JSON.stringify(authors) );
        bookData.append('genres' , JSON.stringify(genres) );

        try{

            let response = await $.ajax({
                url: `${window.paths.AjaxServerUrl}${window.paths.AddBook}`,
                method: 'POST',
                contentType: false,
                processData: false,
                data: bookData
            });

            console.log('Response: ' , response );

            if( +response.code === 200 ){

                $('#successMessage').fadeIn(200).delay(5000).fadeOut(1500);

            }//if

        }//try
        catch( ex ){

            console.log('Exception: ' , ex);

        }//catch

    });



});
