"use strict";

window.paths = {
    AjaxServerUrl: '/BookShopMVC/public/',

    //AUTHOR
    RemoveAuthor: 'author/:authorID',
    UpdateAuthor: 'author/:authorID',
    AddAuthor: 'author',

    //GENRE
    RemoveGenre: 'genre/:genreID',
    UpdateGenre: 'genre',
    AddGenre: 'add_genre',
};

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

    }); // RemoveAuthor

    $('.removeBook').click(function () {

        let bookID = $(this).data('book-id');

        $.ajax({
            'url': `/BookShopMVC/public/delete-book/${bookID}`,
            'type': 'DELETE',
            'success': ( a , b) => {
                location.reload();
            }
        }); // Ajax

    });

} );