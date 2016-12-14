function buscar(elemento,direccion,evento,mostrar,atributo)
{
      $(elemento).on(evento,function()
       {
          data=atributo+"="+$(elemento).val();
          console.log(data);
      		request = $.ajax({
      			url:direccion,
      			type:"POST",
      			data:data,
               beforeSend: function() {
               $(mostrar).html("Cargando...");
            },
            error: function(xhr) { // if error occured
              $(mostrar).html("No se encontro el registro");
            },
      		});
      		request.done( function (response){
      			$(mostrar).html(response);
      		});

       });
}