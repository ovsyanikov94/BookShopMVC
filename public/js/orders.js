"use strict";

$(document).ready(()=>{

    let limit = 10;
    let offset = 10;

    let limitOrders = 10;
    let offsetOrders =0;

    let limitOrdersDetail = 10;
    let offsetOrdersDetail =0;

    $('#deal-yet').click(async function(){

        try{
            let response = await $.ajax({
                url: `${window.paths.AjaxServerUserUrl}/ordersByUser/${limitOrders}/${offsetOrders}`,
                method: 'GET'
            });


            $.each(response.orders, function (index , order) {


                $('.table').append(`
                     <tr>

                    <td>{{ order.orderId }}</td>
                    <td>{{ order.date }}</td>
                    <td>{{ order.AdressOrder }}</td>
                    <td>{{order.orderStatus}}</td>
                    <td>
                        <a href="orders.twig/${order.orderId}/10/0" class="btn btn-primary"> подробнее </a>
                    </td>

                </tr>

                `);

            });

        }
        catch (e) {
            console.log('error');
        }

        offsetOrders+=limitOrders;


    })
    $('#deal-yet-detail').click(async function(){


        let id = $(this).data('id');
        try{
            let response = await $.ajax({
                url: `${window.paths.AjaxServerUserUrl}/ordersUserDetailsOffset/${id}/${limitOrdersDetail}/${offsetOrdersDetail}`,
                method: 'GET'
            });


            $.each(response.orderDetail, function (index , order) {


                let stringAuthors='';

                $.each(orderDetail.authors, function (index, author) {

                    stringAuthors += author

                    if(orderDetail.authors.length<index-1){
                        stringAuthors+=','
                    }
                } )

                $('.table').append(`
                     <tr>

                        <th scope="row">
                            <img src="${ orderDetail.bookImagePath }" style="float: left; width: 50px"  alt="Cinque Terre">
                        </th>
                        <td>${ orderDetail.bookTitle }</td>
                        <td>${ stringAuthors  }</td>
                        <td>${ orderDetail.bookPrice } руб.</td>
                        <td>${ orderDetail.bookAmount }</td>
                        <td>${ orderDetail.date }</td>


                     </tr>

                `);

            });

        }
        catch (e) {
            console.log('error');
        }

        offsetOrdersDetail+=limitOrdersDetail;


    });

});