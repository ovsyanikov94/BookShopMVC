$.noConflict();
jQuery( function (  ){

    jQuery('#profile').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    jQuery('#home').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    jQuery('#messages').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
    jQuery('#settings').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });



    jQuery('a[data-toggle="list"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab
    })
});