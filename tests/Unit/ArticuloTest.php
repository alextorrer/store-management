<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\ArticuloController;

class ArticuloTest extends TestCase
{

    
    public function test_estaDisponible()
    {
        $controller = new ArticuloController();
        $disponible = $controller->estaDisponible(1);
        $this->assertTrue($disponible);
    }

    public function test_reducirInventario()
    {
        $controller = new ArticuloController();
        $articulo = $controller->reducirInventario(1);
        $this->assertTrue($articulo[0]->cantidad == 4);
    }

    public function test_obtenerArticulos()
    {
        $controller = new ArticuloController();
        $articulos = $controller->obtenerArticulos();
        $this->assertTrue(count($articulos) == 3);
    }

    public function test_calcularSubtotal()
    {
        $controller = new ArticuloController();
        $subtotal = $controller->calcularSubtotal(1, 3);
        $this->assertTrue($subtotal == 56);
    }

    public function test_calcularTotal()
    {
        $controller = new ArticuloController();
        $total = $controller->calcularTotal(array(
            array(
                'id_articulo' => 1,
                'cantidad' => 3,
            ),
            array(
                'id_articulo' => 2,
                'cantidad' => 1
            )
        ));
        $this->assertTrue($total == 95);
    }

    public function test_calcularUtilidad(){
        $controller = new ArticuloController();
        $utilidad = $controller->calcularUtilidad(1);
        $this->assertTrue($utilidad == 7);
    }
}
