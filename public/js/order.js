(function () {

    $('#addOrder').click( async function (  ){

        let cart = $.cookie('cart');
        
        console.log("cart", cart);

        if(!cart){

            $('#successMessage').fadeOut(1000);
            $('#errorMessage').text("Корзина пустая");
            $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

        }//if
        else{

            let orderData = new FormData();

            orderData.append('cart' , JSON.stringify(cart) );

            try{

                let response = await $.ajax({
                    url: `${window.paths.AjaxServerUrl}${window.paths.AddOrder}`,
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    data: orderData
                });

                if( +response.code === 200 ){

                    $('#successMessage').text("Ваш заказ принят в обработку");
                    $('#successMessage').fadeIn(200).delay(5000).fadeOut(1500);

                }//if
                else if(+response.code === 401){
                    $('#errorMessage').text(response.message);
                    $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

                }//else
                else{
                    $('#errorMessage').text("Произошла ошибка при оформлении заказа");
                    $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

                }//else

            }//try
            catch( ex ){

                $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );

                console.log(ex);

            }//catch
        }//else

        // let nameAuthor = $('#nameAuthor').val();
        // let lastNameAuthor = $('#lastNameAuthor').val();
        //
        //
        // if(!/^[a-zа-я]{2,50}$/i.test(nameAuthor) || !/^[a-zа-я]{2,50}$/i.test(lastNameAuthor)){
        //
        //     $('#successMessage').fadeOut(1000);
        //     $('#errorMessage').fadeOut(500);
        //     $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );
        //
        // }//if
        // else{
        //     $.post(
        //         `${window.paths.AjaxServerUrl}${window.paths.AddAuthor}`,
        //         {
        //             'authorLastname': lastNameAuthor,
        //             'authorFirstname': nameAuthor
        //         },
        //         function ( response ){
        //
        //             $('#successMessage').fadeIn(1000);
        //             $('#errorMessage').fadeOut(500);
        //             $('#errorInput').fadeOut(500);
        //
        //             console.log('response:' , response);
        //
        //             $('#authorTable').append(`
        //             <tr data-author-id = "${response.authorID}">
        //                 <td>${response.authorID}</td>
        //                 <td>${nameAuthor}</td>
        //                 <td>${lastNameAuthor}</td>
        //                 <td>
        //                     <button data-author-id="${response.authorID}" class="btn btn-danger" >Удалить</button>
        //                 </td>
        //                 <td>
        //                     <a href="${window.paths.AjaxServerUrl}author/${response.authorID}" class="btn btn-primary" >Обновить</a>
        //                 </td>
        //             </tr>`
        //             );
        //
        //
        //
        //         }//fn
        //     );
        //
        // }//else



    }  );


})();


