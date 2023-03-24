

<div class="modal fade" id="modalProducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header color_header_modal ">
          <h5 class="modal-title" id="modal_title" >   </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('saveProduct') }}" id="form_products">
                <div class="mb-3">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <input type="hidden" value="0" id="idProduct" />
                  <label for="clave" class="form-label"><strong> {{ trans('tabla.tbl_products_clave') }} </strong> </label>
                  <input type="text" class="form-control" id="clave" name="clave">
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label"> <strong> {{ trans('tabla.tbl_products_nombre') }} </strong> </label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label"> <strong> {{ trans('tabla.tbl_products_precio') }} </strong>  </label>
                    <input type="text" class="form-control" id="precio" name="precio">
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label"> <strong> {{ trans('tabla.tbl_products_costo') }}  </strong></label>
                    <input type="text" class="form-control" id="costo" name="costo">
                </div>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> {{ trans('tabla.modal.cerrar') }} </button>
          <button type="button" id="btn_save" class="btn btn-primary" onclick="saveProducto()" > {{ trans('tabla.modal.guardar') }} </button>
        </div>
      </div>
    </div>
  </div>
