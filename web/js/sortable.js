$(document).ready(function () {

    sortable('.sortable')[0].addEventListener('sortupdate', function (e) {

        $id_product = new URLSearchParams(location.search).get('id');
        $id_file    = e.detail.origin.index;
        $id_fil2    = e.detail.destination.index;

        $.get( '/product/sortfile', { id_product: $id_product, id_file: $id_file, id_file2: $id_fil2  } )
            .done(function( data ) {
                console.log( "Сортировка сохранена в базе" );

            });


    });

});