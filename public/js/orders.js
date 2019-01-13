"use strict";

$(document).ready(()=>{

    let limit = 10;
    let offset =0;

    $('#deal-yet').click(async function(){

        try{
            let response = await $.ajax({
                url: `${window.paths.AjaxServerUserUrl}/ordersByUser`,
                method: 'GET',
                data:{
                    offset:offset,
                    limit:limit
                }//ajax
            });


            $.each(response.orders, function (index , order) {


                 let stringAuthors='';

                 $.each(order.bookInfo.authors, function (index, author) {

                     stringAuthors += author

                     if(order.bookInfo.authors.length<index-1){
                         stringAuthors+=','
                     }
                 } )

                $('.table').append(`
                     <tr>

                        <th scope="row">
                            <img src="${ order.bookInfo.bookImagePath }" style="float: left; width: 50px"  alt="Cinque Terre">
                        </th>
                        <td>${ order.bookInfo.bookTitle }</td>
                        <td>${ stringAuthors  }</td>
                        <td>${ order.detail.bookPrice } руб.</td>
                        <td>${ order.detail.bookAmount }</td>
                        <td>${ order.date }</td>


                     </tr>

                `);

            });

        }
        catch (e) {
            console.log('error');
        }

        offset+=limit;


    })

})