<main>
    <div class="container-fluid mt-5">
        <h3 class="text-primary text-center mb-4">Tus publicaciones realizadas</h3>



        <?php
        $total = 0;
        if(! isset($ventas) || count($ventas)> 0){
            $tope = count($ventas);
            echo '<table class=" table table-hover text-center">
    <thead>
    <tr class="font-weight-bold">
        <td scope="col">#</td>
        <td scope="col">Fecha</td>
        <td scope="col">Producto</td>
        <td scope="col">Total de la venta</td>
       
    <tr>
    </thead>
    <tbody>';

            for ($i = 0; $i <$tope; $i++) {

                $fecha=$ventas[$i]['venta']['fecha'];
                $total=$ventas[$i]['venta']['total'];
                $id=$ventas[$i]['venta']['id'];
                $producto=$ventas[$i]['producto']['nombre'];

                echo '<tr class="text-center">
                <th class="align-middle" scope="row">' . $id . '</th>     
                <td class="align-middle">' . $fecha . '</td>
                <td class="align-middle"> ' . $producto . '  </td>
                  <td class="align-middle"> ' . $total . '  </td>
        
                
            ';



            }
        }else{

            echo  '
<div class="container">

                    <div class="alert d-flex alert-success p-1 align-items-center rounded text-center justify-content-center mb-5" role="alert" >
                        <i class="fa fa-comments-dollar fa-2x mr-3 "></i>
                        <h5 class="text-left mb-0">Aun no tiene ventas<br></h5>
                       </div>
                       </div>';


        }

        ?>




        </table>

        <h4 class="text-primary text-center ">Monto acumulado :$<?php echo $cuenta['monto'] ?></h4>
    </div>
</main>