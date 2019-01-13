"use strict";



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

    }  );

    $('#moreUser').click(function () {



    });

    $('#checkIn').click(function () {

        let login = $('#login').val();

        let isTrueLogin = /^[a-zA-ZА-Яа-я\d]{4,16}$/i.test(login);


        if(!isTrueLogin){
            $('#loginError').addClass("red ");
        }//if

        let email =$('#email').val();
        let isTrueEmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i.test(email);

        if(!isTrueEmail){
            $('#emailError').addClass("red ");
        }//if

        let password = $('#password').val();
        let confirmPassword = $('#confirmPassword').val();
        let isTruePassword = /^[a-z0-9_?!^%()\d]{6,30}$/i.test(password);

        if(!isTruePassword || password!==confirmPassword) {
           let test = $('#confirmPasswordError');

            test.removeClass("none");
            test.addClass("red block");
        }//if


        if(isTrueLogin&&
            isTrueEmail&&
            isTruePassword&&
            (password===confirmPassword)
        ){
            console.log('start ajax');

            // $.ajax({
            //     'url': `/BookShopMVC/public/addUser`,
            //     'type': 'POST',
            //     'data': {
            //         'userLogin':login,
            //         'userEmail':email,
            //         'userPassword':password
            //     },
            //     'success': (data) => {
            //         console.log(data);
            //         console.log('наверное тут редирект на авторизацию');
            //     },//success
            // })//ajax

            let respone =   $.ajax({
                'url': `/BookShopMVC/public/addUser`,
                'type': 'POST',
                'data': {
                    'userLogin':login,
                    'userEmail':email,
                    'userPassword':password
                }
            }).done((data)=>{

               // let test = JSON.parse(dara);
                console.log(data);

                if(data!==null){
                    console.log(data);
                }//if
                else {
                    console.log('такой пользователь уже есть ');
                }//else

            }).fail((data)=>{
                console.log(data);
            });//ajax

        }//if

    });

    //Кнопка "Выйти" для LogOut
    $('#signOut').click(function () {

        let url = `${window.paths.AjaxServerUrl}${window.paths.Logout}`;

        $.ajax({
            'url': url,
            'type': 'POST',
            'success': () =>{

                location.href = `${window.paths.AjaxServerUrl}authorize`;

            }//success
        });

    });

    //Добавление в корзину
    $('.add-to-cart').click( async function (){

        let bookID = +$(this).data('book-id');
        let cart = $.cookie('cart');

        if( !cart ){

            $.cookie('cart' , [
                {
                    bookID: bookID,
                    amount: 1
                }
            ] , {expires: 7 , path: '/'});

        }//if
        else{

            let book = cart.find( b => b.bookID === bookID )  ;

            if(!book){

                cart.push( {
                    bookID: bookID,
                    amount: 1
                });

                $.cookie('cart' , cart , {expires: 7 , path: '/'});

            }//if

        }//else
        
        console.log('CART:' , cart);

        $(this).fadeOut(500);

        
    } );

} );

window.paths = {

    AjaxServerUrl: '/BookShopMVC/public/admin/',
    AjaxServerUserUrl: '/BookShopMVC/public/',

    //AUTHORIZE
    Login: 'login',
    Logout: 'logout',

    //PERSONAL PAGE
    SaveNewAvatar: 'save-avatar',
    SaveNewPersonalData: 'save-new-personal-data',
    ChangePassword: 'update-user-password',

    //AUTHOR
    RemoveAuthor: 'author/:authorID',
    UpdateAuthor: 'author/:authorID',
    AddAuthor: 'author',

    //GENRE
    RemoveGenre: 'genre/:genreID',
    UpdateGenre: 'genre',
    AddGenre: 'add_genre',

    //COMMENTS
    RemoveComment: 'comment/:commentID',
    UpdateComment: 'comment',
    AddComment: 'add_comment',
    MoreComments: 'more-comments/:bookId',
    UpdateStatus: 'comment-status',
    ModerationComments: 'comments-mod/',
    ModerationMoreComments: 'comments-mod-more/',

    //BOOK

    AddBook: 'new-book',
    EditBook: 'edit-book/:bookID',
    DeleteBook: 'delete-book/:bookID',
    GetBooks: 'get-books'

};

window.StatusConsts = {
    StatusAll: 0,
    StatusNew: 1,
    StatusApprove: 2,
    StatusReject: 3,

};

$.cookie.json = true;

