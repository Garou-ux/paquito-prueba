
/**controlador de la vista productos */

//creamos variable para obtener el elemento del modal
const modalProductos = document.getElementById('modalProducts');

//variable para procesar si editar o crear un producto
const ProductoProcesos = {
   'crear'    : 'create',
   'editar'   : 'edit'
};

//funcion que obtiene un producto por su id
const getProduct = async (id) => {
    $('#form_products').trigger('reset'); //reseteamos el form
   let data = { id: id, _token : $('meta[name="csrf-token"]').attr('content'), url : $('#url_get_product').val()  }//preparamos la data a enviar en un objeto

   let response = await postData(data.url, data, 'POST');//ejecutamos la funcion postdata para obtener el producto buscado por su id
    setInputValues('idProduct', response.id)
    setInputValues('clave', response.clave)
    setInputValues('nombre', response.nombre)   // =====================> con los datos obtenidos, seteamos los valores a los inputs del formulario para editarlo
    setInputValues('precio', response.precio)
    setInputValues('costo', response.costo)

    $('#modalProducts').modal('show'); //mostramos el modal
};

//funcion que muestra una alerta para confirmar si eliminar el producto
const confirmdeleteProduct = (id) => {
    Swal.fire({
        title: 'Estas seguro',
        text: "Se eliminara el producto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        if (result.isConfirmed) {
              deleteProduct(id)//si se confirma, ejecutamos la funcion de eliminar
        }
      })
};

//elimina un producto por su id
const deleteProduct = async (id) => {
    let data = {
                    id: id,
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    url : $('#url_delete_product').val(),
                    proceso : ProductoProcesos.eliminar
               }
    let response = await postData(data.url, data, 'POST');

    //libreria sweetalert2, muestra una alerta
    Swal.fire({
        title: '',
        text: response.msg,
        icon: response.tipo,
        confirmButtonText: 'OK'
      });
       if(response.bandera){//si la bandera retornada es true, actualizamos la pagina
         location.reload();
       }

}


//funcion que edita o crea un producto en base al id del formulario si es 0 crea si es mayor a 0 edita el producto
const saveProducto = async () => {
   formData = getFormValues('form_products');
   formData.url = document.getElementById("form_products").action;
   idProduct  = document.getElementById('idProduct');
   formData.id = idProduct.value;

   formData.proceso = formData.id == 0 ? ProductoProcesos.crear : ProductoProcesos.editar;
   let response = await postData(formData.url, formData ,'POST');
    if(response.msg == undefined){
        printErrorMsg(response.errors);
        return;
    }
    Swal.fire({
    title: '',
    text: response.msg,
    icon: response.tipo,
    confirmButtonText: 'OK'
  });
   if(response.bandera){
     location.reload();
   }

};


//funcion que obtiene los valores(inputs) de formalurio
function getFormValues(form){
    var parsedData = {_token :  $('meta[name="csrf-token"]').attr('content')};
    $(`#${form}`).serializeArray().map(function(x){parsedData[x.name] = x.value;});
    return parsedData;
}

//fetch nativo de javascrip, sirve para hacer peticiones web o a apis etc....
const postData = async(url = "", data = {}, method = 'GET') => {
    const response = await fetch(url, {
       method: method,
       mode: "same-origin",
         cache: "no-cache",
         credentials: "same-origin",
         headers: {
           "Content-Type": "application/json",
           "Accept": "application/json",
           "X-Requested-With": "XMLHttpRequest",
           "X-CSRF-Token": data._token
         },
         redirect: "follow",
         referrerPolicy: "no-referrer",
         body : method === "GET" ? null : JSON.stringify(data)

     });

    return response.json();
}


//funcion que muestra la respuesta de un request(validador de un formulario)
function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( msg, function( key, value ) {
      $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
  }

  //limpia las alertas de inputs requeridos
  function clearErrorMsg (){
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','none');
  }

  //agregar el evento de cuando se cierre el modal, limpie las alertas y el formulario
  modalProductos.addEventListener('hidden.bs.modal', function (event) {
    clearErrorMsg();
    $('#form_products').trigger('reset');
  })

  //setea los valores a un input del formulario usando jquery
  function setInputValues (input, value){
    $(`#${input}`).val(value);
  }
