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
        let bookDescription = $('#bookDescription').val()
        //
        if(/^[а-яА-Я\w]{3,50}$/.test(bookTitle) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('Название некорректно!');
            return;

        }//if

        if(/^\d{9}[\d|X]$/.test(bookISBN) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('ISBN некорректен!');
                return;

        }//if

        if(/\d{1,10}$/.test(bookPages) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('Кол-во страниц некорректно!');
                return;

        }//if

        if(/^\d+(,\d{1,2})?$/.test(bookPrice) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('Цена некорректна!');
                return;

        }//if

        if(/^\d{1,5}/.test(bookAmount) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('Кол-во книг некорректно!');
                return;

        }//if
        if(/^.{10,500}/.test(bookDescription) === false ){

            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 ).text('Описание некорректно!');
                return;

        }//if

        let bookData = new FormData();
        bookData.append('bookTitle' , bookTitle);
        bookData.append('bookISBN' , bookISBN);
        bookData.append('bookPages' , bookPages);
        bookData.append('bookPrice' , bookPrice);
        bookData.append('bookAmount' , bookAmount);
        bookData.append('bookDescription' , bookDescription);

        let files =  $('#bookFile').prop('files');

        if(files.length !== 0){

            let file = files[0];

            let ext = file.name.substring(file.name.lastIndexOf('.'));

            if( extentions.indexOf( ext ) === -1 ){

                $('#errorInput').text('Тип файла некорректен').fadeIn(500).delay( 5000 ).fadeOut( 500 )
                return;

            }//if

            bookData.append('bookImage' , file);

        }//if

        try{

            let response = await $.ajax({
                url: `${window.paths.AjaxServerUrl}${window.paths.AddBook}`,
                method: 'POST',
                contentType: false,
                processData: false,
                data: bookData
            });

        }//try
        catch( ex ){

            $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 )

            console.log(ex);

        }//catch

    });



});
