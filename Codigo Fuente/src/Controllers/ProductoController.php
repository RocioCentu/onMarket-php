<?php

/**

 * Created by PhpStorm.

 * User: Globons

 * Date: 11/5/2019

 * Time: 11:41

 */



class ProductoController extends Controller

{



    function publicar()

    {

        $d["title"] = "Publicar";
        $d["nombreUsuario"]= $_SESSION["name"];
        $this->set($d);

        $this->render(Constantes::PUBLICARVIEW);



    }






    function altaProducto($publicacion)

    {
        header("Content-type: application/json");
        $data = json_decode(utf8_decode($publicacion['data']));

        $producto = new Producto();
        $categoria = new Categoria();
        $error=0;
        //conceptos generales
        if (FuncionesComunes::validarCadena($data->titulo)) {
            $producto->setNombre($data->titulo);
        }else{
            throw new NombreOPassInvalidoException("Titulo Incorrecto", CodigoError::NombreOPassInvalidoException);

        }
        if (FuncionesComunes::validarCadena($data->nombre)) {
            $producto->setNombre($data->nombre);
        }else{
            throw new NombreOPassInvalidoException("Nombre Incorrecto ", CodigoError::NombreOPassInvalidoException);

        }
        if (FuncionesComunes::validarCadenaNumerosYEspacios($data->descripcion)) {
            $producto->setDescripcion($data->descripcion);
        }else{
            throw new NombreOPassInvalidoException("Descripcion Incorrecta ", CodigoError::NombreOPassInvalidoException);

        }

        if (FuncionesComunes::validarNumeros($data->cantidad)) {
            $producto->setCantidad($data->cantidad);
        }else{
            throw new NombreOPassInvalidoException("Cantidad Incorrecta ", CodigoError::NombreOPassInvalidoException);

        }

        if (FuncionesComunes::validarNumeros($data->precio)) {
            $producto->setPrecio($data->precio);
        }else{
            throw new NombreOPassInvalidoException("Precio Incorrecto ", CodigoError::NombreOPassInvalidoException);

        }

        if ($data->categoria !== 0) {
            //categoria obtener id y setearlo
            $idCategoria = $categoria->obtenerIdCategoria($data->categoria);
            if ($idCategoria != false) {
                $producto->setIdCategoria($idCategoria);
            }
        }else{
            throw new NombreOPassInvalidoException("Seleccione categoria ", CodigoError::NombreOPassInvalidoException);

        }

        $error2 = 0;
        //imagenes




        $countfiles = count($data->imagen);

        if ($countfiles >= 2 || $countfiles < 10) {

            for ($i = 0; $countfiles > $i; $i++) {
                $arrayImagenes[$i] =  $data->imagen[$i];;

            }

        }else{

            throw new NombreOPassInvalidoException("Ingrese cantidad de imagenes correspondiente ", CodigoError::NombreOPassInvalidoException);

        }



        if($error2>0){

            throw new NombreOPassInvalidoException("Ingrese cantidad de imagenes correspondiente ", CodigoError::NombreOPassInvalidoException);





        }
        if($error>0) {

            throw new NombreOPassInvalidoException("Ingrese cantidad de imagenes correspondiente ", CodigoError::NombreOPassInvalidoException);



        }


                $idProducto = $producto->insertarProducto();

                $this->insertarImagenes($arrayImagenes, $idProducto);

                $this->guardarImagenes($data, $countfiles);

                $this->altaPublicacion($data, $idProducto);

                 echo json_encode(true);

    }



    function insertarImagenes($arrayImagenes, $idProducto)

    {

        foreach ($arrayImagenes as $imagen) {

            $imagenNueva = new Imagen();

            $imagenNueva->setNombre($imagen);

            $imagenNueva->setIdProducto($idProducto);

            $imagenNueva->insertarImagen();

        }

    }



    function guardarImagenes($data, $countfiles)

    {

        for ($i = 0; $countfiles > $i; $i++) {

            $archivo = $data->imagen[$i];

            $tmpName = $data->imagen2[$i];



            // $prefijo = substr(md5(uniqid(rand())),0,6);



            if ($archivo != "") {

                // guardamos el archivo a la carpeta files

                $destino = $data->destino . "/" . $archivo;

                copy($tmpName, $destino);

            }

        }

    }



    function altaPublicacion($data, $idProducto)

    {

        $publicar = new Publicacion();



        $validacion = true;

        if (FuncionesComunes::validarCadena($data->titulo)) {

            $publicar->setTitulo($data->titulo);



        } else {

            $validacion = false;

        }
        if (!empty($data->envio)) {

            $entrega = $data->envio;

            $entregaPubli = new formaentrega();

            $idEntrega = $entregaPubli->obtenerIdMetodoEntrega($entrega);

        } else {

            $validacion = false;

        }

        if ($validacion) {

            $fecha_actual = date("y-m-d");

            $publicar->setFecha($fecha_actual);

            $publicar->setId_user($_SESSION["logueado"]);

            $publicar->setId_Producto($idProducto);

            $publicacion_Entrega = new Publicacion_Entrega();

            $idPublicacion = $publicar->insertarPublicacion();


            $publicacion_Entrega->setIdPublicacion($idPublicacion);



          for ($i = 0; $i < (count($idEntrega)); $i++) {

               $publicacion_Entrega->setIdEntrega((int)$idEntrega[$i]);

                $publicacion_Entrega->insertarEntrega();

            }



        }

        return $validacion;



    }





}





