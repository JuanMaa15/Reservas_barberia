"use strict";
const url = $('#url').data('url');
var acciones = {

    listo : function () {
        
        $("#barbero").click(acciones.abrirModalBarbero);
        $("#btn-salir").click(acciones.salirModal);

        $("#cerrar-modal").click(acciones.salirModal);

        $(".bloque-barbero").click(acciones.seleccionarBarbero);
        
        $("#btn_buscar_hora").click(acciones.mostrarHorasDisponibles);

        $("#btn_buscar_reserva").click(acciones.consultarReserva);

        $(".btn-reserva-lista").click(acciones.reservaLista);

        $(".btn-modal-eliminar").click(acciones.pasarId);
        $(".btn-modal-eliminar-usuario").click(acciones.pasarIdUsuario);
        
        $("#reservas #fecha").unbind('on').on('change', acciones.buscarReservasFecha);
        $("#reservas #busqueda").keyup(acciones.buscarReservas);
       

        $(".boton-cont-navegacion").click(acciones.abrirNavegacion);
    
    },

    //Abrir el contenedor de navegacion (en responsive)
    abrirNavegacion : function() {
        $('.cont-enlaces-menu').toggleClass('abrir-navegacion');
        $('.navegacion-admin').toggleClass('abrir-navegacion');
    },
    
    //Buscar reservas por barra de buuqueda

    buscarReservas : function () {
        let busqueda = $(this).val();

           $.ajax({
               'method' : 'GET',
               'url' : url+'/reservas/listado',
               'data' : {
                   'busqueda': busqueda,
                   'type' : 'busqueda',
                   _token: $('input[name="_token"]').val()
               }
           }).done(function (data){
               $("#contenedor_reservas").html(data);

                //Volver a llamar los elementos para las opciones de confirmar y cancelar
                $(".btn-reserva-lista").click(acciones.reservaLista);
                $(".btn-modal-eliminar").click(acciones.pasarId);

           });
            
        
       
    },

    //Buscar reservas por filtro de fecha
    
    buscarReservasFecha : function() {
        
        var fecha = $(this).val();
           
        $.ajax({
            'method' : 'GET',
            'url' : url+'/reservas/listado',
            'data' : {
                'fecha' : fecha,
                'type': 'fecha',
                _token: $('input[name="_token"]').val()
            }
        }).done(function (data){
            $("#contenedor_reservas").html(data);

            //Limpiar mensajes de error
            $("#form-traer-horas .is-invalid").next().remove();
            $("#form-traer-horas .is-invalid").removeClass('is-invalid');

            //Volver a llamar los elementos para las opciones de confirmar y cancelar
            $(".btn-reserva-lista").click(acciones.reservaLista);
            $(".btn-modal-eliminar").click(acciones.pasarId);

        }).fail(function (data){
            let errores = data.responseJSON.errors;

            //Recoger el array errores
            $.each(errores, (index, value) => {

                let html = `<span class="invalid-feedback" role="alert">
                                <strong> ${value} </strong>
                            </span>`

                let elemento = $('#'+index);
                
                elemento.addClass('is-invalid');

                //Me agrega un HTML despues del elemento
                elemento.after(html);
            
            });
        });
        
    },

    pasarId : function() {
        let id = $(this).val();

        $(".btn-eliminar-reserva").val(id);
    },

    pasarIdUsuario : function () {
        let id = $(this).val();

        $(".btn-eliminar-usuario").val(id);
        console.log(id);
    },

    
    reservaLista : function () {
      
        var id = $(this).val();
        
        $.ajax({
           'method' : 'POST',
           'url': url+'/reservas/update-status',
           'data' : {
               'id' : id,
               _token: $('input[name="_token"]').val()
           }
        }).done(function(data) {
            //$("#cont_campos_reserva_hoy_" + id).html(data);

            //Eliminar contenedor de los botones eliminar y confirmar
            $("#cont_campos_reserva_hoy_" + id +" .datos-reserva").next().remove();
            //Agregar una clase al contenedor padre del elemento que estamos invocando
            $("#cont_campos_reserva_hoy_" + id).parent().addClass('trama-bloque-reserva');
            //Agregar un HTML al contenedor padre del elemento que estamos invocando
            $("#cont_campos_reserva_hoy_" + id).parent().append('<i class="fa-solid fa-circle-check icon-reserva-lista"></i>');
        });
        
    },
    

    consultarReserva : function () {
        
        let codigo = $("#codigo").val();
        
        $.ajax({
            'method' : 'POST',
            'url' : url+'/reservas/show',
            'data' : {
                'codigo' : codigo,
                _token: $('input[name="_token"]').val()
            }
        }).done(function (data){
            
            $("#consulta-reserva").html(data);

            //Limpiar mensajes de error
            $("#form-traer-horas .is-invalid").next().remove();
            $("#form-traer-horas .is-invalid").removeClass('is-invalid');
            
            $(".cont-consulta-reserva").removeClass("d-none");
        }).fail(function (data){
            let errores = data.responseJSON.errors;

            //Recoger el array errores
            $.each(errores, (index, value) => {

                let html = `<span class="invalid-feedback" role="alert">
                                <strong> ${value} </strong>
                            </span>`

                let elemento = $('#'+index);
                
                elemento.addClass('is-invalid');

                //Me agrega un HTML despues del elemento
                elemento.after(html);
            
            });
        });
        
       
        
        
    },

    //Traer las horas disponible para la fecha y barberos seleccionados
    
    mostrarHorasDisponibles : function() {
        //Recoger datos
        var fecha = $("#fecha").val();
        var barbero = $("#barbero").val();
  
            $.ajax({
                'method' : 'POST',
                'url' : url+'/hora/disponible',
                'data': {
                    'fecha' : fecha,
                    'barbero' : barbero,
                    _token: $('input[name="_token"]').val()
                },

            }).done(function(data){
                //Si el envio de datos se realiza correctamente

                $("#reservas-disponibles").html(data);

                //Limpiar mensajes de error
                $("#form-traer-horas .is-invalid").next().remove();
                $("#form-traer-horas .is-invalid").removeClass('is-invalid');

            }).fail(function(data) {
                // Si los datos tienen errores 

                let errores = data.responseJSON.errors;

                //Recoger el array errores
                $.each(errores, (index, value) => {

                    let html = `<span class="invalid-feedback" role="alert">
                                    <strong> ${value} </strong>
                                </span>`

                    let elemento = $('#'+index);
                    
                    elemento.addClass('is-invalid');

                    //Me agrega un HTML despues del elemento
                    elemento.after(html);
                
                });
                
            });
                
        
        
    },

    seleccionarBarbero : function () {

        var id = $(this).attr("id"); 

        $("#barbero").val(id);

        $(".cont-modal").fadeOut("fast", () => {
            $(".trama").fadeOut("fast");
        });

        $("body").removeClass("overflow-hidden");

    },

    abrirModalBarbero : function () {
        
        $(".trama").fadeIn("fast", () => {
            $(".cont-modal").fadeIn("fast");
        });

        $("body").addClass("overflow-hidden");
    },

    salirModal : function (){
        
        $(".cont-modal").fadeOut("fast", () => {
            $(".trama").fadeOut("fast");
        });

        $("body").removeClass("overflow-hidden");

    },

    precarga : function () {

        $("body").removeClass("overflow-hidden");
        $("#overlay").fadeOut("slow");
    }

}

$(document).ready(acciones.listo);
$(window).load("on", acciones.precarga);