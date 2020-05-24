<?php


class MisVentasController extends Controller
{
    function ventas()
    {

        $d["title"] = "Index";
        $d["nombreUsuario"]= $_SESSION["name"];

        $cobranza=new cobranza();
        //traer cobranzas con el id del usuario
        $ventas=$cobranza->traerCobranzasPorUsuario($_SESSION["logueado"]);


        //traer publicaciones de la cobranza

        $prod= new Producto();


        $arrayVentas=[];
        for($i = 0; $i < count($ventas); $i++) {
            $prod= new Producto();

            $id=$ventas[$i]["idProducto"];
            $p=$prod->buscarPorPk($id);

            $arrayProducto = [
                "venta" => $ventas[$i],
                "producto" => $p,
            ];

            array_push( $arrayVentas, $arrayProducto);

        }

        $cuenta=new Cuenta();
        $c=$cuenta->consultarCuenta($_SESSION["logueado"]);

        $d["ventas"] = $arrayVentas;
        $d["cuenta"] = $c;
        $this->set($d);


        $this->render(Constantes::MISVENTASVIEW);

    }






}