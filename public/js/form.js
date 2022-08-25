$(function(){

    $('#select-pais').on('change', ChangeCity);
    
});

function ChangeCity() {
    var pais_id = $(this).val();


    //AJAX
    
    $.get('/api/proyecto/'+pais_id+'/ciudades', function (data) {
        var html_select;
            for (var i = 0; i< data.length; i++) {
                html_select += '<option value="'+data[i].id+'">'+data[i].nombre_ciudad+'</option>'
                $('#select-ciudad').html(html_select);
            }
        
    });

}