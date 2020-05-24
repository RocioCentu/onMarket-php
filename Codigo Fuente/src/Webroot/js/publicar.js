const regexLetrasYNumeros = /^[0-9a-zA-Z]+$/;
const regexNumeros = /^[0-9]+/;
const regexLetras = /[A-Za-z]+/;
const regexCorreo = /^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
const regexletrasYNumerosYespacios = /[A-Za-zñÑ0-9#&\-\s]/;
function validar() {
    var error=0;
    var validacion = false;
    var name=$("#nombre").val();
    if(name === null || name.length === 0 || name === "") {
        $("#errorName").removeClass("d-none").addClass("d-flex").find("small").text("nombre vacio");
        $("#errorName").fadeIn("slow");
        error= +1;
    }else
    if(regexNumeros.test(name)) {
        $("#errorName").removeClass("d-none").addClass("d-flex").find("small").text("La descripcion no pueden ser solo números");
        $("#errorName").fadeIn("slow");
        error= +1;
    }else
    if(!regexLetras.test(name)) {
        $("#errorName").removeClass("d-none").addClass("d-flex").find("small").text("nombre invalido");
        $("#errorName").fadeIn("slow");
        error= +1;

    }
    else {

        error= -1;

    }



    var categoria = $("#categoria");

    var year = categoria.val();


    if (year === '0') {

        $("#errorCategoria").removeClass("d-none").addClass("d-flex").find("small").text("Seleccione una categoria");
        $("#errorCategoria").fadeIn("slow");


    } else {
        error= -1;
    }




    var descripcion=$("#descripcion").val();
    if(descripcion === null || descripcion.length === 0 || descripcion === "") {
        $("#errordescripcion").removeClass("d-none").addClass("d-flex").find("small").text("descripcion no puede quedar  vacia");
        $("#errordescripcion").fadeIn("slow");
        error= +1;

    }else
    if(regexNumeros.test(descripcion)) {
        $("#errordescripcion").removeClass("d-none").addClass("d-flex").find("small").text("La descripcion no pueden ser solo números");
        $("#errordescripcion").fadeIn("slow");
        error= +1;
    }else {

        error= -1;

    }




    var titulo=$("#titulo").val();
    if(titulo === null || titulo.length === 0 || titulo === "") {
        $("#errorTitulo").removeClass("d-none").addClass("d-flex").find("small").text("Titulo vacio");
        $("#errorTitulo").fadeIn("slow");
        error= +1;

    }else
    if(regexNumeros.test(titulo)) {
        $("#errorTitulo").removeClass("d-none").addClass("d-flex").find("small").text("El Titulo no pueden ser solo números");
        $("#errorTitulo").fadeIn("slow");
        error= +1;
    }else
    if(!regexLetras.test(titulo)) {
        $("#errorTitulo").removeClass("d-none").addClass("d-flex").find("small").text("Titulo invalido");
        $("#errorTitulo").fadeIn("slow");
        error= +1;

    }
    else {

        error= -1;

    }



    var precio=$("#precio").val();
    if(precio === null || precio.length === 0 || precio === "") {
        $("#errorprecio").removeClass("d-none").addClass("d-flex").find("small").text("el precio no puede estar vacio");
        $("#errorprecio").fadeIn("slow");
        error= +1;

    } else if(!regexNumeros.test(precio)) {

        $("#errorprecio").removeClass("d-none").addClass("d-flex").find("small").text("el precio es  numerico");
        $("#errorprecio").fadeIn("slow");
        error= +1;
    } else {
        error= -1;


    }



    var cantidad=$("#cantidad").val();
    if(cantidad === null || cantidad.length === 0 || cantidad === "") {
        $("#errorcantidad").removeClass("d-none").addClass("d-flex").find("small").text("la cantidad no puede quedar vacia");
        $("#errorcantidad").fadeIn("slow");
        error= +1;
    } else if(!regexNumeros.test(cantidad)) {

        $("#errorcantidad").removeClass("d-none").addClass("d-flex").find("small").text("la cantidad es numerica");
        $("#errorprecio").fadeIn("slow");
        error= +1;

    } else {


        error= -1;
    }






    if(!$('#entrega').prop('checked') && !$('#envio').prop('checked')){
        $("#errorEnvio").removeClass("d-none").addClass("d-flex").find("small").text("seleccione un metodo de entrega");
        $("#errorEnvio").fadeIn("slow");

        error= +1;

    } else {
        error= -1;

    }

    if(error<=0){
        validacion=true;
    }
return validacion;

}

$('#publicar').click(function () {
    array=[];
    array2=[];

    var envios =  new Array();
    if( $('#entrega').prop('checked') ) {
      envios.push($('#entrega').val());
    }
    if( $('#envio').prop('checked') ) {

        envios.push($('#envio').val());
    }


   var p= ($("#imagen")[0].files).length;

   var envio=$(".envio").val();

    var i = 0;
   for(i = 0;i < p;i++ ){
       var b= $("#imagen")[0].files[i]['name'];
       var a= $("#imagen")[0].files[i]['tmp_name'];
      array[i]=a;
      array2[i]=b;
   }





    var validacion = validar();

    if(validacion) {

        var obj = {};
        obj.nombre = $("#nombre").val();
        obj.categoria=$("#categoria").val();
        obj.titulo=$("#titulo").val();
        obj.cantidad=$("#cantidad").val();
        obj.precio=$("#precio").val();
        obj.descripcion=$("#descripcion").val();
        obj.envio=envios;
        obj.imagen=array;
        obj.imagen2=array2;
        obj.destino=$("#destino").val();




 llamadaAjax(pathPublicar, JSON.stringify(obj), true, "publicarExitoso", "publicarFallido");
    }
});

function publicarExitoso(rol) {

        window.location.href = pathPublicaciones;


}

function publicarFallido(err) {
    $("input").prop("disabled", false);

    alertify.alert("Error de publicacion", err);
}


