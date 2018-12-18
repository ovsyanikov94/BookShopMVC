(function () {

    //ADD_AUTHOR

    $('#addAuthor').click( function (  ){

        let nameAuthor = $('#nameAuthor').val();
        let lastNameAuthor = $('#lastNameAuthor').val();

        if(!nameAuthor.match( /^[а-яa-z]{2,50}$/i) || !lastNameAuthor.match( /^[а-яa-z]{2,50}$/i ) ){
            return;
        }

        $.post(
            `${window.paths.AjaxServerUrl}${window.paths.AddAuthor}`,
            {
                'authorLastname': lastNameAuthor,
                'authorFirstname': nameAuthor
            },

        )
            .fail(function (data) {

                if( +data.status === 200 ){

                    let response = JSON.parse(data.responseText.replace('Index', ''));

                    $('#authorTable').append(`
                    <tr data-author-id = "${response.authorID}">
                        <td>${response.authorID}</td>
                        <td>${nameAuthor}</td>
                        <td>${lastNameAuthor}</td>
                        <td>
                            <button data-author-id="${response.authorID}" class="btn btn-danger" >Удалить</button>
                        </td>
                        <td>
                            <a href="${window.paths.AjaxServerUrl}author/${response.authorID}" class="btn btn-primary" >Обновить</a>
                        </td>
                    </tr>`
                    );
                }//if

            });//fail

    }  );

    $('body').on('click','#removeAuthor,.btn-danger' , function (  ){

        let authorID = +$( this ).data('author-id');

        let deleteURL = `${window.paths.AjaxServerUrl}${window.paths.RemoveAuthor}`;
        deleteURL = deleteURL.replace(':authorID' , authorID);

        let self = $(this);

        let deleteA = $.ajax({
            'url': deleteURL,
            'type': 'DELETE',

        })
            .fail(function (data) {
                console.log("data", data);

                if( +data.status === 200 ){

                            if( self.attr('id') === 'removeAuthor' ){
                                location.href = `${window.paths.AjaxServerUrl}authors`;
                            }//if
                            else{
                                $(`tr[data-author-id=${authorID}]`).remove();
                            }//else

                        }//if

            });//fail
    }  );

    //UPDATE_AUTHOR

    $('#updateAuthor').click(function (  ){

        let authorID = +$(this).data('author-id');
        let nameAuthor = $('#nameAuthor').val();
        let lastNameAuthor = $('#lastNameAuthor').val();

        let url = window.paths.UpdateAuthor.replace(':authorID' , authorID);
        url = `${window.paths.AjaxServerUrl}${url}`;

        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                'authorFirstname': nameAuthor,
                'authorLastname': lastNameAuthor,
            },
            done: ( response )=>{
                console.log( response );
            }
        });

    } );

})();


