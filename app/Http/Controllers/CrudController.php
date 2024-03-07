<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use PhpParser\Node\Stmt\TryCatch;

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

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');
    //     $productos = Producto::where('nombre', 'LIKE', "%$searchTerm%")->get();
    
    //     return view('partials.productos_table', ['productos' => $productos]);
    // }


    public function show($id_producto)
    {
        $producto = Producto::findOrFail($id_producto);
        return view('producto.show', compact('producto'));
    }

    //---------------- CREATE ----------------
    public function create(Request $request)
{
    try {
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
    } catch (\Throwable $th) {
        return back()->with("incorrect", "Error al registrar");
    }
}

    //---------------- UPDATE ----------------
    public function update(Request $request, $id_producto)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'precio' => 'required',
                'cantidad' => 'required',
            ]);

            $producto = Producto::find($id_producto);

            $producto->nombre = $request->input('nombre');
            $producto->precio = $request->input('precio');
            $producto->cantidad = $request->input('cantidad');
            $producto->save();

            return back()->with('correct', 'Producto modificado correctamente.');
        } catch (\Throwable $th) {
            return back()->with("incorrect", "Error al modificar");
            // return back()->with("incorrect", "Error al modificar: " . $th->getMessage());

        }
    }

    //---------------- DELETE ----------------
    public function destroy($id_producto)
    {
        try {
            Producto::destroy($id_producto);
            return back()->with('correct', 'Producto eliminado correctamente.');
        } catch (\Throwable $th) {
            return back()->with('incorrect', 'Error al eliminar el producto.');
        }
    }
}