$(document).ready(function () {

    display_edite_delivery();

    $('#order-edit_sum_delivery').click( function(){
        display_edite_delivery();
    });


});


function display_edite_delivery() {
    if ($('#order-edit_sum_delivery').is(':checked')) {
        $('.div_excpress_delivery_procent').show();
    } else {
        $('.div_excpress_delivery_procent').hide();
    }
}