
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

    $('.removeOD').click(function () {

        let odID = $(this).data('od-id');

        $.ajax({
            'url': `/BookShopMVC/public/delete-order-details/${odID}`,
            'type': 'DELETE',
            'success': ( a , b) => {
                location.reload();
            }
        }); // Ajax

    });

} );