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

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );

                        $('#CommentsList').append(`
                                 <div class="card w-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ user.userLogin }} Дата: {{ comment.created }}</h5>
                                        <p class="card-text">{{ comment.commentText }}</p>
                                        <a href="#" >
                                            <i id="EditButton" data-user-id="{{ comment.userID }}" data-comment-id="{{ comment.commentID }}" class="far fa-edit fa-2x"></i>
                                        </a>
                                        <a href="#" ><i id="DeleteButton" data-user-id="{{ comment.userID }}" data-comment-id="{{ comment.commentID }}" class="btn-danger far fa-trash-alt fa-2x"></i></a>
                        
                                    </div>
                                 </div>`
                        );
                    }//if
                    else{
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000).delay( 5000 ).fadeOut( 500 );
                    }//else



                }
            });
        }//else


    }  );
});


