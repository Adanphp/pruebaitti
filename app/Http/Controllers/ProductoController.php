<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required',
            'cantidad' => 'required',
        ]);

        $producto = new Producto;
        $producto->descripcion = $request->descripcion;
        $producto->categoria = $request->categoria;
        $producto->cantidad = $request->cantidad;
        $producto->save();

        return response()->json([
            'message' => 'Registro agregado correctamente',
            'status' => 200,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required',
            'cantidad' => 'required',
        ]);

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 400,
            ], 400);
        }

        $producto->descripcion = $request->descripcion;
        $producto->categoria = $request->categoria;
        $producto->cantidad = $request->cantidad;
        $producto->save();

        return response()->json([
            'message' => 'Registro actualizado correctamente',
            'status' => 200,
        ]);
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'Producto no encontrado',
                'status' => 400,
            ], 400);
        }

        $producto->estado = false;
        $producto->save();

        return response()->json([
            'message' => 'Producto dado de baja correctamente',
            'status' => 200,
        ]);
    }

    public function index()
    {
        $productos = Producto::all();

        return response()->json([
            'data' => $productos,
            'status' => 200,
        ]);
    }
}