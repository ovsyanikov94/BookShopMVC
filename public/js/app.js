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

} );

function removeAuthors(){
    let removeButtons = document.querySelectorAll('.btn-danger');

    [].forEach.call( removeButtons , ( button )=>{

        button.addEventListener('click' , async function (){

            let authorId = +button.dataset.authorId;
            console.log("authorId", authorId);
            let request = new XMLHttpRequest();
            request.open('DELETE', `/BookShopMVC/public/author/${authorId}`);
            request.send();

            request.onreadystatechange = function () {

                console.log("request", request);

                if (request.status === 200 && request.readyState === XMLHttpRequest.DONE) {

                    let authorTable = document.querySelector('#authorTable');
                    let row = document.querySelector(`#authorTable tr[data-author-id='${authorId}']`);

                    authorTable.removeChild( row );

                }//if
            };//onreadystatechange

        });

    } );
}

(function () {

    //ADD_AUTHOR
    let addAuthor = document.querySelector('#addAuthor');

    if (addAuthor) {

        addAuthor.addEventListener('click', function () {

            let data = new FormData();

            let nameAuthor = document.querySelector('#nameAuthor').value;
            let lastNameAuthor = document.querySelector('#lastNameAuthor').value;
            let authorTable = document.querySelector('#authorTable');

            console.log("nameAuthor", nameAuthor);
            console.log("authorLastname", lastNameAuthor);

            data.append('authorFirstname', nameAuthor);
            data.append('authorLastname', lastNameAuthor);

            let request = new XMLHttpRequest();
            request.open('POST', '/BookShopMVC/public/author');
            request.send(data);

            request.onreadystatechange = function () {

                if (request.status === 200 && request.readyState === XMLHttpRequest.DONE) {

                    let id = JSON.parse(request.response);

                    authorTable.innerHTML += `
                <tr data-author-id="${+id.authorID}">
                    <td>${id.authorID}</td>
                    <td>${nameAuthor}</td>
                    <td>${lastNameAuthor}</td>
                     <td>
                    <button id="removeAuthor" data-author-id="${+id.authorID}" class="btn btn-danger" >Удалить</button>
                </td>
                <td>
                    <a href=/BookShopMVC/public/author/${+id.authorID} class="btn btn-primary" >Обновить</a>
                </td>
                </tr>
                `;

                    removeAuthors();

                }//if
            };//onreadystatechange

        });//addEventListener

    }//if

    //DELETE_AUTHOR
    let removeButtons = document.querySelectorAll('.btn-danger');

    [].forEach.call( removeButtons , ( button )=>{

        button.addEventListener('click' , async function (){

            let authorId = +button.dataset.authorId;
            console.log("authorId", authorId);
            let request = new XMLHttpRequest();
            request.open('DELETE', `/BookShopMVC/public/author/${authorId}`);
            request.send();

            request.onreadystatechange = function () {

                console.log("request", request);

                if (request.status === 200 && request.readyState === XMLHttpRequest.DONE) {

                    let authorTable = document.querySelector('#authorTable');
                    let row = document.querySelector(`#authorTable tr[data-author-id='${authorId}']`);

                    authorTable.removeChild( row );


                }//if
            };//onreadystatechange

        });

    } );

    //UPDATE_AUTHOR

    let updateAuthor = document.querySelector('#updateAuthor');

    if(updateAuthor){

        updateAuthor.addEventListener('click', function () {

            let data = new FormData();

            let nameAuthor = document.querySelector('#nameAuthor').value;
            let lastNameAuthor = document.querySelector('#lastNameAuthor').value;

            let authorID = updateAuthor.dataset.authorId;

            console.log("authorID", authorID);
            console.log("nameAuthor", nameAuthor);
            console.log("authorLastname", lastNameAuthor);

            data.append('authorFirstname', nameAuthor);
            data.append('authorLastname', lastNameAuthor);

            let request = new XMLHttpRequest();
            request.open('POST', `/BookShopMVC/public/author/${authorID}`);
            request.send(data);

            request.onreadystatechange = function () {

                if (request.status === 200 && request.readyState === XMLHttpRequest.DONE) {

                    console.log('request', request.response);


                }//if
            };//onreadystatechange

        });//addEventListener

    }//if

})();