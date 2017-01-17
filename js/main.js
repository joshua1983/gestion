var opcionFiltroEstudiante = 1;

function borrarExamen(correo){
    var ls_url = IP_SERVER + '/Informe/borrarExamen';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        data: {
            id: correo
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            cargarExamenes();
        }
    });
}

function cargarExamenes(){
    $("#btn_vendedor").removeClass('active');
    $("#btn_mes").removeClass('active');
    $("#btn_conectados").removeClass('active');
    $("#btn_examenes").addClass('active');
    $("#btn_examenes_int").removeClass('active');
    var ls_url = IP_SERVER + '/Informe/getExamenesPresentados';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_examenes").html());
            $('#lista').html(plantilla_datos(  { examenes: data }));
            $("#tabla_examenes").DataTable();
        }
    });
}


function cargarExamenesInt(){
    $("#btn_vendedor").removeClass('active');
    $("#btn_mes").removeClass('active');
    $("#btn_conectados").removeClass('active');
    $("#btn_examenes").removeClass('active');
    $("#btn_examenes_int").addClass('active');
    var ls_url = IP_SERVER + '/Informe/getExamenesPresentadosInternos';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_examenes_int").html());
            $('#lista').html(plantilla_datos(  { examenes: data }));
            $("#tabla_examenes_int").DataTable();
        }
    });
}
function getListadoInactivos(){
    var ls_url = IP_SERVER + '/Admin/getUsuariosInactivos';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
            $("#lista_estudiantes").DataTable();
        }
    });
}

function getListadoUsuarios(){
    var ls_url = IP_SERVER + '/Admin/getUsuarios';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
            $("#lista_estudiantes").DataTable();
        }
    });
}
function getSeguimientoEstudiante(id){
    var ls_url = IP_SERVER + '/Admin/getSeguimiento';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        data: {
            id: id
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#detalle_seguimiento").html());
            $('#lista').html(plantilla_datos(  { usuarios: data.resultado, examenes: data.examenes, usuario:id }));
            $('#txt_fecha').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: 'linked'
            });
        }
    });
}

function enviarCorreoExamen(id){
    var ls_url = IP_SERVER + '/Admin/enviarCorreoExamen/'+id;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        data: {
            id: id
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            alert('Correo enviado');
        }
    });
}

function enviarCorreoBienvenida(id){
    
}

function getSeguimientoDocente(id){
    var ls_url = IP_SERVER + '/Docente/getSeguimiento';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        data: {
            id: id
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#detalle_seguimiento").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}



function getListadoVendedores(){
    var ls_url = IP_SERVER + '/Vendedor/getVendedores';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function cargarDetalleVendedor(idVendedor){
    var ls_url = IP_SERVER + '/Informe/getDetalleVendedor';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        data:{
            vendedor: idVendedor
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_detalle_vendedor").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function getListadoDocentes(){
    var ls_url = IP_SERVER + '/Docente/getDocentes';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
            $("#lista_docentes").DataTable();
        }
    });
}

function getListaVendedorCedula(){
    var cedula = $("#txt_cedula").val();
    var ls_url = IP_SERVER + '/Vendedor/getVendedorCedula/'+cedula;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function getListaUsuarioCedula(){
    var cedula = $("#txt_cedula").val();
    var ls_url = IP_SERVER + '/Admin/getUsuariosCedula/'+cedula;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function getListaDocenteCedula(){
    var cedula = $("#txt_cedula").val();
    var ls_url = IP_SERVER + '/Docente/getDocenteCedula/'+cedula;
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_usuarios").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function cambiarEstado(idUsuario, newEstado){

    var ls_url = IP_SERVER + '/Admin/cambiaEstado';
    $.ajax({
        type: "POST",
        dataType: "text",
        url: ls_url,
        data: {
            id: idUsuario,
            nuevo: newEstado
        },
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            location.reload();
        }
    });
}

function cargarVentasMes(){
    $("#btn_mes").addClass('active');
    $("#btn_vendedor").removeClass('active');
    $("#btn_conectados").removeClass('active');
    $("#btn_config_vendedor").removeClass('active');
    $("#btn_examenes").removeClass('active');
    $("#btn_examenes_int").removeClass('active');

    var mes = $("#txt_mes").val();
    var year = $("#txt_year").val();

    if (mes == undefined){
        mes = new Date().getMonth()+1;
    }
    if (year == undefined){
        year = new Date().getFullYear();
    }
    

    var fechaBusq = new Date(year, mes-1, 1, 0, 0, 0, 0);
    
    var momento = moment(fechaBusq);

    var etiqueta = "Ventas realizadas en " + momento.format(' MMMM  YYYY') ;

    

    var ls_url = IP_SERVER + '/Informe/getResumenMes';
    $.ajax({
        type: "POST",
        dataType: "json",
        data:{
            p_mes: mes,
            p_year: year
        },
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_ventas").html());
            $('#lista').html(plantilla_datos(  { usuarios: data, etiq: etiqueta}));
            $("#txt_mes").val(mes);
            $("#txt_year").val(year);
        }
    });
}

function cargarVentasVendedor(){
    $("#btn_vendedor").addClass('active');
    $("#btn_mes").removeClass('active');
    $("#btn_conectados").removeClass('active');
    $("#btn_config_vendedor").removeClass('active');
    $("#btn_examenes").removeClass('active');
    $("#btn_examenes_int").removeClass('active');
    var ls_url = IP_SERVER + '/Informe/getResumenVendedor';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_vendedor").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function exportar(fuente){    
    $("#"+fuente).tableExport({type:'excel',escape:'false'});
}


function cargarConectados(){
    $("#btn_vendedor").removeClass('active');
    $("#btn_mes").removeClass('active');
    $("#btn_conectados").addClass('active');
    $("#btn_config_vendedor").removeClass('active');
    $("#btn_examenes").removeClass('active');
    $("#btn_examenes_int").removeClass('active');
    var ls_url = IP_SERVER + '/Informe/getConectados';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#lista_conectados").html());
            $('#lista').html(plantilla_datos(  { usuarios: data }));
        }
    });
}

function cargarConfiguracionVendedor(){
    $("#btn_vendedor").removeClass('active');
    $("#btn_mes").removeClass('active');
    $("#btn_conectados").removeClass('active');
    $("#btn_config_vendedor").addClass('active');
    $("#btn_examenes").removeClass('active');
    $("#btn_examenes_int").removeClass('active');

    var ls_url = IP_SERVER + '/Informe/getConfiguracionVendedor';
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            $('#lista').html('');
            var plantilla_datos = _.template($("#templ_configuracion").html());
            $('#lista').html(plantilla_datos(  { configuracion: data }));
        }
    });

}

 
function guardarConfiguracionVendedor(){

    var vend_princ = $("#val_vend_princ").val();
    var vend_princ_rec = $("#val_vend_princ_rec").val();
    var val_junior = $("#val_jun").val();
    var val_junior_rec = $("#val_jun_rec").val();

    var ls_url = IP_SERVER + '/Vendedor/setConfiguracionVendedor';
    $.ajax({
        method: "POST",
        data: {
            val_vend_princ: vend_princ,
            val_vend_princ_rec: vend_princ_rec,
            val_jun: val_junior,
            val_jun_rec: val_junior_rec
        },
        url: ls_url,
        error: function(xhr, settings, exception){
            console.log('No se puede contactar con el servidor.'+xhr.responseText);
            console.log(exception);
        },
        success: function(data){
            alert("Datos guardados");
            cargarConfiguracionVendedor();
        }
    });
}

function filtrarEstudiantes(elemento){
    var opcion = $(elemento).val();
    opcionFiltroEstudiante = opcion;
    if (opcion ==0){
        getListadoInactivos();
    }else{
        getListadoUsuarios();
    }
}