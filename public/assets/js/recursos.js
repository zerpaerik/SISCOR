//permite la recarga de paginación ajax no modificar
	$("#paginacion a").bind("click",function(e)
	{
		e.preventDefault();
		var urlPagination = $(this).attr('href');
		$.ajax({
			url: urlPagination,
			type: "get",
			success: function(data)
			{
				$("#paginacion").html(data);
				$(".edit").empty();
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});


//permite la recarga de actualización ajax no modificar

	$(".verPorAprobar").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});

	$(".verRechazadas").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});


	$(".verRecibidas").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});


	$(".verEnviadas").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});


	$(".verBorrador").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});

		$(".verArchivadas").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$("#contenidoppal").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});
	


	// permite mostrar el contenido de las correspondencias

$(".actualizar").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$(".edit").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});






//permite ejecutar boton eliminar con ajax no modificar
	$(".eliminar").on("click",function(e)
	{
		e.preventDefault();
		var urlEdit= $(this).attr('href');
		$.ajax({
			url: urlEdit,
			type: "get",
			success: function(data)
			{
				$(".edit").empty().html(data);
			},
			error: function()
			{
				alert('Error obteniendo respuesta del servidor, prueba más tarde.');
			}
		});
	});

     //Envio por ajax de formulario por id fijarse atributo id de form
     $('#destroy').submit(function (event) {

            // process the form
            $.ajax({
                type        : 'put',                           //metodo
                url         : $(this).attr("action"),             //controlador
                dataType    : 'json',                             //tipo de salida
                encode      : true                                //decodificacion
            }).done(function(data) {
                    //ejecuta el y despliega el mensaje json obtenido
                    //si respuesta del json es fail
                    if (data.respuesta=="fail") {
                      //mensaje rojo , dura 3 segs
                      toastr.danger(data.mensaje, {timeOut: 300});  
                    }else{
                      //mensaje azul , dura 3 segs
                      toastr.info(data.mensaje, {timeOut: 300}); 
                      //limpia todos los campos del form 
                      $('.edit').empty();
                      recargar();                 
                    }
                });
              
                // previene que se ejecute submit dando enter
                event.preventDefault();
      });
      
      //Para cancelar una eliminaci
      $('.cancelar').on('click',function (event) {
            $('.edit').empty();
            recargar();                 
      });


	  //Permite la busqueda
      $('#Buscar').submit(function (event) {
            var formData = {
               //campo para controlador    //tipo de campo[name=namecampo]
               'searchText'  : $('input[name=searchText]').val(),
            };
            // process the form
            $.ajax({
               type        : 'get',                             //metodo
               url         : $(this).attr("action"),             //controlador
               data        : formData,                           //array con nombres de campos
            }).done(function(a) {
                $('#contenidoppal').html(a);
            });
                // previene que se ejecute submit dando enter
              event.preventDefault();
      });