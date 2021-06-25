<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php 
        function estaDisponible($id_articulo){ 
            $disponible = false; 
            $articulo = DB::select(
                'SELECT cantidad FROM articulo WHERE id_articulo = :id_articulo', 
                ['id_articulo' => $id_articulo]
            );
            if($producto->get(0)->cantidad > 0){
                $disponible = true;
            }
            return $disponible;
        }

        function reducirInventario($id_articulo){
            $articulo = DB::select(
                'SELECT cantidad FROM articulo WHERE id_articulo = :id_articulo',
                ['id_articulo' => $id_articulo]
            );
            $nuevo_articulo = DB::update(
                'UPDATE articulo SET cantidad = :cantidad WHERE id_articulo = :id_articulo', 
                [
                    'cantidad' => $articulo->get(0)->cantidad - 1;
                    'id_articulo' => $id_articulo
                ]);
        }

        function obtenerArticulos(){
            $articulos = DB::select(
                'SELECT id_articulo, nombre, cantidad, costo, precio, categoria FROM articulo'
            );
            return $articulos;
        }

        function calcularSubtotal($id_articulo, $cantidad){
            $subtotal = 0;
            $articulo = DB::select(
                'SELECT precio FROM articulo WHERE id_articulo = :id_articulo',
                ['id_articulo' => $id_articulo]
            );
            $subtotal = $articulo->get(0)->precio * $cantidad;
            return $subtotal;
        }

        function calcularTotal($articulos){
            $total = 0;
            for($i=0; $i<count($articulos); $i++){
                $subtotal = calcularSubtotal($articulos[$i]["id_articulo"], $articulos[$i]["cantidad"]);
                $total += $subtotal;
            }
            return $total;
        }

        function calcularUtilidad($id_articulo){
            $utilidad = 0;
            $articulo = DB::select(
                'SELECT costo, precio FROM articulo WHERE id_articulo = : id_articulo',
                ['id_articulo' => $id_articulo]
            );
            $utilidad = $articulo->get(0)->precio - $articulo->get(0)->costo;
            return $utilidad;
        }

    ?>
</body>
</html>