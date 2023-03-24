@extends('utilities.app')

@section('body')
<div class="row center_container">
    <h1> {{ trans('tabla.titulo_index') }} </h1>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 button">
                <button type="button"  data-bs-toggle="modal" data-bs-target="#modalProducts" class="btn btn-primary"> {{ trans('tabla.nuevo_producto') }} </button>
           </div>
        </div>
        <table class="table table-hover table-products">
            <thead>
                <th> {{ trans('tabla.tbl_products_clave')  }} </th>
                <th> {{ trans('tabla.tbl_products_nombre') }} </th>
                <th> {{ trans('tabla.tbl_products_precio')}} </th>
                <th> {{ trans('tabla.tbl_products_costo')}} </th>
                <th> {{ trans('tabla.tbl_prodcuts_acciones')}} </th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>   {{--  fila de la tabla  --}}
                    <th>{{ $product->clave  }}  </th>
                    <th>{{ $product->nombre }}  </th>
                    <th>{{ $product->precio }}  </th>
                    <th>{{ $product->costo  }}  </th>
                    <th>
                        <button type="button" class="btn btn-success" onclick="getProduct({{ $product->id }})"> {{ trans('tabla.tbl_products_editar') }} </button>
                        <button type="button" class="btn btn-danger" onclick="confirmdeleteProduct({{ $product->id }})"> {{ trans('tabla.tbl_productos_eliminar') }} </button>
                    </th>
                   </tr>
                @endforeach
            </tbody> {{--  cuerpo de la tabla  --}}
        </table>  {{--  fin de la tabla  --}}
    </div>
</div>
@include('forms.modal-product')
<input type="hidden" value="{{ url('/getProduct') }}" id="url_get_product" /> {{--  url para obtener el producto  --}}
<input type="hidden" value="{{ url('/deleteProduct') }}" id="url_delete_product" /> {{-- url para eliminar el produt   --}}
<script type="text/javascript" src="{!! asset('js/ProductsController.js') !!}"></script> {{--   asset va a la carpeta public, no olvides poner los css y js ahi --}}
@stop
