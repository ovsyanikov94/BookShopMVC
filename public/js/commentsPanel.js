$(document).ready( function (  ){

    $('body').on('click', '#ApproveButton', function () {
        let commentID = $(this).data('comment-id');
                $.ajax({
                    'url': `${window.paths.AjaxServerUrl}${window.paths.UpdateStatus}`,
                    'type': 'PUT',
                    'data': {
                        'commentStatus': 2,
                        'commentID': commentID,


                    },
                    'success': (data) =>{


                        let status = +data .code;


                        if( status === 200){

                            $(`div[data-comment-id=${commentID}]`).remove();
                            $('#errorMessage').fadeOut(1000);
                            $('#successMessage').text("Комментарий успешно обновлен!").fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//if
                        else{
                            $('#successMessage').fadeOut(1000);
                            $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//else


                        commentID = null;
                    }//success
                });


    }  );
    $('body').on('click', '#RejectButton', function () {
                let commentID = $(this).data('comment-id');
                $.ajax({
                    'url': `${window.paths.AjaxServerUrl}${window.paths.UpdateStatus}`,
                    'type': 'PUT',
                    'data': {
                        'commentStatus': 3,
                        'commentID': commentID,


                    },
                    'success': (data) =>{


                        let status = +data .code;


                        if( status === 200){

                            $(`div[data-comment-id=${commentID}]`).remove();
                            $('#errorMessage').fadeOut(1000);
                            $('#successMessage').text("Комментарий успешно обновлен!").fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//if
                        else{
                            $('#successMessage').fadeOut(1000);
                            $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//else


                        commentID = null;
                    }//success
                });


    });


});