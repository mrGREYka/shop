$( ".dadata" ).suggestions( {
    token: "02ed6dc01cfd80c882445b50b95918ec3d4826ec",
    type: "ADDRESS",
    onSelect: function( suggestion ) {
        console.log( suggestion );
    }
} );