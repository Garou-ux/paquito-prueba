<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\SaveProductRequest;

class ProductsContoller extends Controller
{

   public function indexProducts(Request $request){
      $products = $this->getProducts($request);
      return view('index', compact('products')); //compact sirve para mandarle las variables a la vista blade en este caso le mando la variable products
   }

   public function getProducts(Request $request){
       $products = Product::get(); //retorna el modelo de los productos en un array []
       return $products;
   }

   public function saveProduct(SaveProductRequest $request){  //Request = a los valores que se envian desde el js
       switch ($request->proceso) {
        case 'create':
             $response = $this->createProduct($request);
            break;
        case 'edit':
            $response = $this->editProduc($request);
            break;
       }

       return response()->json($response);
   }

   public function createProduct($request){
    try {
        $response = [ "msg" => 'Guardado', 'tipo' => 'success', 'bandera' => true];
        $product = Product::create([
             'clave' => $request->clave,
             'nombre' => $request->nombre,   ///create de eloquent orm laravel = crea un nuevo producto es igual a un insert de sql
             'precio' => $request->precio,
             'costo' => $request->costo
        ]);

    } catch (\Exception $e) {
        $response = [ "msg" => "Error" . $e->getMessage(), 'tipo' => 'error'];
    }

      return $response;
   }

   public function editProduc($request){
      try {
        $response = [ "msg" => 'Guardado', 'tipo' => 'success', 'bandera' => true];
        $product = Product::find($request->id); //find busca el modelo por su id

        $product->clave = $request->clave;
        $product->nombre = $request->nombre;
        $product->precio = $request->precio;
        $product->costo =  $request->costo;

        $product->save(); //save guarda el modelo buscado
      } catch (\Exception $e) {
        $response = [ "msg" => "Error" . $e->getMessage(), 'tipo' => 'error'];

      }
      return $response;
   }


   //usa sofdelete para hacer una eliminacion logica poniendo el deleted_at con el datetime de cuando se elimino
   public function deleteProduct(Request $request){
     try {
        $response = [ "msg" => 'Elimnado', 'tipo' => 'success', 'bandera' => true];
        $product = Product::find($request->id);
        $product->delete();
    } catch (\Exception $e) {
        $response = [ "msg" => "Error" . $e->getMessage(), 'tipo' => 'error'];
     }
     return response()->json($response);
   }

   public function getProduct(Request $request){
     $product = Product::where('id', $request->id)
                       ->first();

     return response()->json($product);
   }

}
