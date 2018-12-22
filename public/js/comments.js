$(document).ready( function (  ){

    $('body').on('click', '#AddCommentButton', function () {

        let text = $('#AddCommentInput').val();

        if (/^[а-я\s\d\s\w]{4,1500}$/i.test(text) === false) {
            $('#errorInput').css("display", "block");

        }//if
        else{
            $('#errorInput').css("display", "none");

            let bookId = $(this).data('book-id');

            let userId = $(this).data('current-user-id');



            $.ajax({
                'url': `${window.paths.AjaxServerUrl}${window.paths.AddComment}`,
                'type': 'POST',
                'data': {
                    'text': text,
                    'bookId': bookId,
                    'userId': userId,
                },
                'success': (data) =>{

                    let user = data.user;
                    let status = +data .status;
                    let comment = data .comment;

                    if( status === 200 && comment){



                        $('#CommentsList').append( `
                                                   <div data-comment-id="{{ comment.commentID }}" class="card w-100">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ user.userLogin }} Дата: {{ comment.created }}</h5>
                                                            <p class="card-text">{{ comment.commentText }}</p>
                                                            <a href="#" >
                                                                <i id="EditButton" data-user-id="{{ comment.userID }}" data-comment-id="{{ comment.commentID }}" class="far fa-edit fa-2x"></i>
                                                            </a>
                                                            <a href="#" ><i id="DeleteButton" data-user-id="{{ comment.userID }}" data-comment-id="{{ comment.commentID }}" class="btn-danger far fa-trash-alt fa-2x"></i>
                                                            </a>
                                            
                                                        </div>
                                                   </div>`);

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//else



                }//success
            });
        }//else


    }  );

    $('body').on('click', '#EditButton', function () {
        let commentID = $(this).data('comment-id');
        let commenttext = $(`div[data-comment-for-update-id=${commentID}]`).text();

        $('#ModalUpdate').modal();
        $('#ModalUpdateBody').html(`<div class="form-group">
            <label for="formGroupExampleInput">Измените комментарий</label>
            <textarea type="text" class="form-control" id="UpdateCommentInput" >` + commenttext + ` </textarea>
            <div class="form-group">
                <div id="errorInput" style=" display: none;" class="message alert alert-danger">Текст комментария не может быть меньше 4-х символов!</div>
            </div>
        </div>`);

        $('#UpdeteButton').click(function () {
            let newText = $('#UpdateCommentInput').val();
            if (/^[а-я\s\d\s\w]{4,1500}$/i.test(newText) === false) {
                $('#errorInput').css("display", "block");

            }//if
            else{
                $('#errorInput').css("display", "none");



                let userId = $(this).data('current-user-id');



                $.ajax({
                    'url': `${window.paths.AjaxServerUrl}${window.paths.UpdateComment}`,
                    'type': 'PUT',
                    'data': {
                        'text': newText,
                        'commentID': commentID,
                        'userId': userId

                    },
                    'success': (data) =>{


                        let status = +data .code;


                        if( status === 200){
                            console.log('commentID: ', commentID);
                            $(`div[data-comment-for-update-id=${commentID}]`).text(data.text);
                            $('#errorMessage').fadeOut(1000);
                            $('#successMessage').text("Комментарий успешно обновлен!").fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//if
                        else{
                            $('#successMessage').fadeOut(1000);
                            $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        }//else



                    }//success
                });
            }//else


        });//UpdeteButton


    }  );

    $('body').on('click','#DeleteButton' , function (  ){

        let commentID = +$( this ).data('comment-id');
        let userID = $( this ).data('user-id');
        let bookID = $( this ).data('book-id');


        let deleteURL = `${window.paths.AjaxServerUrl}${window.paths.RemoveComment}`;
        deleteURL = deleteURL.replace(':commentID' , commentID);
        let self = $(this);

        $('#Modal').modal();
        $('#ModalTitle').html('<h3>Удаление комментария</h3>');
        $('#ModalBody').html('<h5> Вы действительно хотите удалить комментарий :?</h5>');

        $('#ConfirmButton').click(function () {

            $.ajax({
                'url': deleteURL,
                'type': 'DELETE',
                'success': ( data )=>{

                    if( +data.code === 200 ){

                        if( self.attr('id') === 'removeComment' ){
                            location.href = `${window.paths.AjaxServerUrl}comments/${bookID}`;
                        }//if
                        else{
                            $(`div[data-comment-id=${commentID}]`).remove();
                        }//else

                    }//if

                }//success
            });

        });


    }  );

});


