/*

// ДЛЯ КОРРЕКТНОЙ РАБОТЫ СКРИПТА НЕОБХОДИМО ВО VIEW ВСТАВИТЬ СЛЕДУЮЩИЙ КОД


<script>
let api_price_ult   = "<?= Url::toRoute('/apiproduct')?>";

<?php if ($model->product) { ?>
    let product_id      = <?= $model->product->id ?>;
<?php } else { ?>
    let product_id      = undefined;
<?php } ?>

</script>

*/





let current_price = undefined;

if (product_id != undefined) {
    _get_product_price( product_id );
}

function _wms_count_price_sum( att_count, att_price, att_sum ){

    let count = att_count.val();
    let price = _wms_return_price( count );
    att_price.val( price );
    if ( price != undefined ) {
        _wms_count_sum( att_count, att_price, att_sum )
    }
}

function _wms_count_sum( att_count, att_price, att_sum ){

    let count = att_count.val();
    let price = att_price.val();
    att_sum.val( (count * price).toFixed(2) );

}

function _wms_count_price_from_sum( att_count, att_price, att_sum ){

    let count = att_count.val();
    let sum = att_sum.val();
    att_price.val( (sum / count).toFixed(2) );

}

function _wms_return_price(count) {

    if ( current_price == undefined ) { return undefined; }

    // если кол-во ниже минимального, тогда undefined
    if ( count < current_price[0].minCount ) { return undefined; }

    // если кол-во ,больше или равно максимальному, тогда самая привлекательная цена
    if ( count >= current_price[current_price.length - 1].minCount ) { return current_price[current_price.length - 1].price; }

    for (var i = 1; i < current_price.length; i++) {
        if ( count < current_price[i].minCount ) { return current_price[i-1].price; }
    }

    return current_price[current_price.length - 1].price;

}

function _get_product_price( product_id ){

    $.get( api_price_ult, { id: product_id } )
        .done(function( data ) {
            current_price = data[0].price;
        });

}
