<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ArticuloController extends Controller{

    public function estaDisponible($id_articulo){ 
        $disponible = false; 
        $articulo = DB::select(
            'SELECT cantidad FROM articulo WHERE id_articulo = :id_articulo', 
            ['id_articulo' => $id_articulo]
        );
        if($articulo[0]->cantidad > 0){
            $disponible = true;
        }
        return $disponible;
    }

    public function reducirInventario($id_articulo){
        $articulo = DB::select(
            'SELECT cantidad FROM articulo WHERE id_articulo = :id_articulo',
            ['id_articulo' => $id_articulo]
        );
        $nuevo_articulo = DB::update(
            'UPDATE articulo SET cantidad = :cantidad WHERE id_articulo = :id_articulo', 
            [
                'cantidad' => $articulo[0]->cantidad - 1,
                'id_articulo' => $id_articulo
            ]);
        return $nuevo_articulo;
    }

    public function obtenerArticulos(){
        $articulos = DB::select(
            'SELECT id_articulo, nombre, cantidad, costo, precio, categoria FROM articulo'
        );
        return $articulos;
    }

    public function calcularSubtotal($id_articulo, $cantidad){
        $subtotal = 0;
        $articulo = DB::select(
            'SELECT precio FROM articulo WHERE id_articulo = :id_articulo',
            ['id_articulo' => $id_articulo]
        );
        $subtotal = $articulo[0]->precio * $cantidad;
        return $subtotal;
    }

    public function calcularTotal($articulos){
        $total = 0;
        for($i=0; $i<count($articulos); $i++){
            $subtotal = $this->calcularSubtotal($articulos[$i]["id_articulo"], $articulos[$i]["cantidad"]);
            $total += $subtotal;
        }
        return $total;
    }

    public function calcularUtilidad($id_articulo){
        $utilidad = 0;
        $articulo = DB::select(
            'SELECT costo, precio FROM articulo WHERE id_articulo = : id_articulo',
            ['id_articulo' => $id_articulo]
        );
        $utilidad = $articulo[0]->precio - $articulo[0]->costo;
        return $utilidad;
    }
}