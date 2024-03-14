<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class CrudController extends Controller
{
    //---------------- READ ----------------
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $productos = Producto::where('nombre', 'like', "%$searchTerm%")
                            ->orWhere('precio', 'like', "%$searchTerm%")
                            ->orWhere('cantidad', 'like', "%$searchTerm%")
                            ->get(); 
        return view('welcome', ['productos' => $productos, 'searchTerm' => $searchTerm]); 
    }

    //---------------- CREATE ----------------
    public function create(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
        ]);

        // Crear el nuevo producto
        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->save();

        return back()->with('correct', 'El producto se ha agregado correctamente.');
    }

    //---------------- UPDATE ----------------
    public function update(Request $request, $id_producto)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'cantidad' => 'required',
        ]);

        // Actualizar el producto
        $producto = Producto::find($id_producto);

        $producto->nombre = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->cantidad = $request->input('cantidad');
        $producto->save();

        return back()->with('correct', 'Producto modificado correctamente.');
    }

    //---------------- DELETE ----------------
    public function destroy($id_producto)
    {
        // Eliminar el producto
        Producto::destroy($id_producto);
        return back()->with('correct', 'Producto eliminado correctamente.');
    }
}
