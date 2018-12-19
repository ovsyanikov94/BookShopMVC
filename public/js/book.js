$(document).ready( function (  ){

    $('#addBook').click( function ( ){

        let bookTitle = $('#bookTitle').val();
        let bookISBN = $('#bookISBN').val();
        let bookPages = $('#bookPages').val();
        let bookPrice = $('#bookPrice').val();
        let bookAmount = $('#bookAmount').val();

        if(/^[а-яА-Я\w]{3,50}$/.test(bookTitle) === false ){

            $('#errorInput').css("display", "block");

        }//if

        else if(/^\d{9}[\d|X]$/.test(bookISBN) === false ){

            $('#errorInput').css("display", "block");

        }//if

        else if(/\d{1,10}$/.test(bookPages) === false ){

            $('#errorInput').css("display", "block");

        }//if

        else if(/^\d{1,7}/.test(bookPrice) === false ){

            $('#errorInput').css("display", "block");

        }//if

        else if(/^\d{1,5}/.test(bookAmount) === false ){

            $('#errorInput').css("display", "block");

        }//if

        else{

            $.ajax({
                'url': `${window.paths.AjaxServerUrl}${window.paths.AddBook}`,
                'type': 'POST',
                'data': {
                    'bookTitle': bookTitle,
                    'bookISBN': bookISBN,
                    'bookPages': bookPages,
                    'bookPrice': bookPrice,
                    'bookAmount': bookAmount
                },
                'success': (data) => {

                    let status = +data.status;

                    if (status === 200) {

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000);

                    }//if
                    else {
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000);
                    }//else

                }//success

            });

        }//else

    });



});
