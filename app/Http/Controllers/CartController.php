<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Producto;



class CartController extends Controller
{
    public function __contruct()
    {
        if(!\Session::has('cart'))
        {
            \Session::put('cart', array());
        } 
    }

    //Mostrar carrito

    public function showCart()
    {
        return response()->json(\Session::get('cart'));
        
    }

    //Añadir item

    public function addItem(Producto $producto)
    {
    
        $cart = \Session::get('cart');
        
        //De forma predeterminada la cantidad es 1, en metodo update le vamos a dar la posibilidad de modificarlo.
        $producto->quantity=1;
        $cart[$producto->slug] = $producto;
        \Session::put('cart', $cart);

        return response()->json('Item agregado!');
    }

    //Actualizar cantidad item

    public function updateCantidad(Producto $producto, $cantidad)
    {
        $cart = \Session::get('cart');
        $cart[$producto->cantidad] = $cantidad;
        \Session::put('cart', $cart);

        return response()->json('Cantidad actualizada!');

    }

    //Eliminar item

    public function deleteItem(Producto $producto)
    {
        $cart = \Session::get('cart');
        unset($cart[$producto->slug]);
        \Session::put('cart', $cart);

        return response()->json('Item eliminado!');
    }

    //Destruir carrito

    public function trash(Producto $producto)
    {
        \Session::forget('cart');

        return response()->json('Carrito vacío');
    }

    //Calcular total
    private function total()
    {
        $total=0;
        foreach ($cart as $item){
            $total += $item->precio * $item->cantidad;
        }
        return response()->json($total);
    }

}
