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
        // if(/^[а-яА-Я\w]{3,50}$/.test(bookTitle) === false ){
        //
        //     $('#errorInput').css("display", "block").text('Название некорректно!');
        //     return;
        //
        // }//if
        //
        // if(/^\d{9}[\d|X]$/.test(bookISBN) === false ){
        //
        //     $('#errorInput').css("display", "block");
        //     return;
        // }//if
        //
        // if(/\d{1,10}$/.test(bookPages) === false ){
        //
        //     $('#errorInput').css("display", "block");
        //     return;
        // }//if
        //
        // if(/^\d{1,7}/.test(bookPrice) === false ){
        //
        //     $('#errorInput').css("display", "block");
        //     return;
        // }//if
        //
        // if(/^\d{1,5}/.test(bookAmount) === false ){
        //
        //     $('#errorInput').css("display", "block");
        //     return;
        // }//if

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

        try{

            let response = await $.ajax({
                url: `${window.paths.AjaxServerUrl}${window.paths.AddBook}`,
                method: 'POST',
                contentType: false,
                processData: false,
                data: bookData
            });

            console.log('Response: ' , response );

        }//try
        catch( ex ){

            console.log('Exception: ' , ex);

        }//catch

    });



});
