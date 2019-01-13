$(document).ready( function (  ){


    let limit = 2;
    let offset = 2;
    let commentID = -1;
    let userId = -1;
    let deleteURL = null;

    $('body').on('click', '#AddCommentButton', function () {

        let text = $('#AddCommentInput').val();

        if (text.length <= 4) {
            $('#errorInput').css("display", "block");

        }//if
        else{
            $('#errorInput').css("display", "none");

            let bookId = $(this).data('book-id');

            let userId = $(this).data('user-id');



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
                    let time = data.date;

                    if( status === 200 && comment){

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                        //console.log('comment :', comment);
                        location.href = `${window.paths.AjaxServerUrl}comments/${comment.bookID}`;
                        // $('#CommentsList').prepend(`
                        //                            <div data-comment-id="${ comment.commentID }" class="card w-100">
                        //                                 <div class="card-body">
                        //                                     <h5 class="card-title">${ user.userLogin } Дата: ${ time }</h5>
                        //                                     <div data-comment-for-update-id="${ comment.commentID }" class="card-text">${ comment.commentText }</div>
                        //                                     <a href="#" >
                        //                                         <i id="EditButton" data-user-id="${ comment.userID }" data-comment-id="${ comment.commentID }" class="far fa-edit fa-2x"></i>
                        //                                     </a>
                        //                                     <a href="#" ><i id="DeleteButton" data-user-id="${ comment.userID }" data-comment-id="${ comment.commentID }" class="btn-danger far fa-trash-alt fa-2x"></i>
                        //                                     </a>
                        //
                        //                                 </div>
                        //                            </div>`
                        // );
                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);


                        $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//else



                }//success
            });
        }//else


    }  );

    $('body').on('click', '#ConfirmButton', function () {

        if(!deleteURL ||
            commentID === -1){
            return;
        }//if

        $.ajax({
            'url': deleteURL,
            'type': 'DELETE',
            'success': ( data )=>{

                if( +data.code === 200 ){

                    offset--;


                        $(`div[data-comment-id=${commentID}]`).remove();

                }//if
                deleteURL = null;
                commentID = -1;
            return;
            }//success
        });
    });

    $('body').on('click' , '#UpdateButton' ,function () {

        let newText = $('#UpdateCommentInput').val();
        if (newText.length <= 4) {
            $('#errorInput').css("display", "block");

        }//if
        else{

            $('#errorInput').css("display", "none");

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

                        $(`div[data-comment-for-update-id=${commentID}]`).text(data.text);
                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').text("Комментарий успешно обновлен!").fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//else

                    commentID = -1;
                }//success
            });
        }//else


    } );

    $('body').on('click', '#EditButton', function () {

        commentID = $(this).data('comment-id');
        let commentText = $(`div[data-comment-for-update-id=${commentID}]`).text();

        userId = +$(this).data('user-id');
        let currentUserId = +$('#CommentsList').data('current-user-id');

        if(currentUserId === userId){

            $('#UpdateCommentInput').val( commentText );

            $('#ModalUpdate').modal();

        }//if
        else{
            $('#Modal').modal();
            $('#ModalTitle').html('<h5> Редактирование комментария</h5>');
            $('#ModalBody').html('<h5> Вы можете редактировать только свои сообщения!</h5>');
            $('#ConfirmButton').hide();
        }



    }  );

    $('body').on('click','#DeleteButton' , function (  ){

        commentID = +$( this ).data('comment-id');
        let currentUserId = +$('#CommentsList').data('current-user-id');
        userId = +$( this ).data('user-id');

        if(currentUserId === userId){
            deleteURL = `${window.paths.AjaxServerUrl}${window.paths.RemoveComment}`;
            deleteURL = deleteURL.replace(':commentID' , commentID);
            let self = $(this);

            $('#Modal').modal();
            $('#ModalTitle').html('<h5> Удаление комментария</h5>');
            $('#ModalBody').html('<h5> Вы действительно хотите удалить комментарий :?</h5>');

        }//if
        else{
            $('#Modal').modal();
            $('#ModalTitle').html('<h5> Удаление комментария</h5>');
            $('#ModalBody').html('<h5> Вы можете удалять только свои сообщения!</h5>');
            $('#ConfirmButton').hide();
        }


    }  );

    $('#MoreButton').click(function () {

        let bookId = $(this).data('book-id');

        let URL = `${window.paths.AjaxServerUrl}${window.paths.MoreComments}`;
        URL = URL.replace(':bookId' , bookId);
        console.log('limit', limit);
        console.log('offset', offset);

        $.ajax({
            'url': URL,
            'type': 'GET',
            'data': {
                limit: limit,
                offset: offset,

            },
            'success': (data) =>{

                let status = +data .status;
                let comments = data .comments;

                if( status === 200){

                    comments.forEach(comment => {

                        $('#CommentsList').append(`
                                                   <div data-comment-id="${ comment.comment.commentID }" class="card w-100">
                                                        <div class="card-body">
                                                            <h5 class="card-title">${ comment.user.userLogin } Дата: ${ comment.date }</h5>
                                                            <div data-comment-for-update-id="${ comment.comment.commentID }" class="card-text">${ comment.comment.commentText }</div>
                                                            <a href="#" >
                                                                <i id="EditButton" data-user-id="${ comment.comment.userID }" data-comment-id="${ comment.comment.commentID }" class="far fa-edit fa-2x"></i>
                                                            </a>
                                                            <a href="#" ><i id="DeleteButton" data-user-id="${ comment.comment.userID }" data-comment-id="${ comment.comment.commentID }" class="btn-danger far fa-trash-alt fa-2x"></i>
                                                            </a>

                                                        </div>
                                                   </div>`
                        );

                    });//forEach

                    if(comments.length < limit ){
                        $('#More').css("display", "none");
                    }

                    offset += limit;
                }//if




            }//success
        });
    })

});


