var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   listar();

}

function init(){
    $("#FormularioRol").on("submit",function(e){
        guardaryeditar(e);
    })
}

function limpiar(){
    $("#Codigo_perfil").val("");
    $("#Descripcion_perfil").val("");
    $("#Observaciones").val("");
}

function guardaryeditar(e){
    e.preventDefault();//no se activara la accion predeterminada 
    $("#btnGuardarRol").prop("disabled",true);
    var formData=new FormData($("#FormularioRol")[0]);

    $.ajax({
        url: "../ajax/rol.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });

    limpiar();
}

function mostrarform(flag){
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}


init();