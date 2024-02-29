<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class CrudController extends Controller
{
    public function index(){
        $datos=DB::select(" select * from producto ");
        return view("welcome")->with("datos", $datos);
    }

    public function create(Request $request){
        try{
            // Verificar si ya existe un producto con el mismo nombre
            $exist = DB::select("SELECT * FROM producto WHERE nombre = ?", [$request->txtnombre]);
            if (!empty($exist)) {
                return back()->with("incorrect", "Ya existe el producto.");
            }
    
            // Insertar el nuevo producto
            $sql = DB::insert("INSERT INTO producto(nombre, precio, cantidad) VALUES (?, ?, ?)", [
                $request->txtnombre,
                $request->txtprecio,
                $request->txtcantidad
            ]);
        } catch(\Throwable $th){
            $sql = 0;
        }
    
        if ($sql == true){
            return back()->with('correct', 'El producto se ha agregado correctamente.');
        } else {
            return back()->with("incorrect", "Error al registrar");
        }
    }
    

    public function update(Request $request){
        try{
        $sql = DB::update(" update producto set nombre=?, precio=?, cantidad=? where id_producto=? ",[
            $request->txtnombre,
            $request->txtprecio,
            $request->txtcantidad,
            $request->txtcodigo
        ]);
        if ($sql==0){
            $sql=1;
        }
        } catch(\Throwable $th){
            $sql = 0;
        }
        if ($sql == true){
            return back()->with('correct', 'Producto modificado correctamente.');
        } else {
            return back()->with("incorrect", "Error al modificar");

        }
    }

    public function delete($id){
        try{
        $sql = DB::delete(" delete from producto where id_producto=$id ");
        } catch(\Throwable $th){
            $sql = 0;
        }
        if ($sql == true){
            return back()->with('correct', 'Producto eliminado.');
        } else {
            return back()->with("incorrect", "Error al eliminar");

        }
    }
}
