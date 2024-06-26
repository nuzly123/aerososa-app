$("input[name='dni']").on("keyup", function(){
    $("input[name='number']").val(destroyMask(this.value));
this.value = createMask($("input[name='number']").val());
})
function createMask(string){
    //console.log(string)
    return string.replace(/(\d{4})(\d{4})(\d{5})/,"$1-$2-$3");
}
function destroyMask(string){
    //console.log(string)
    return string.replace(/\D/g,'').substring(0, 13);
}


function updateFileName() {
  var input = document.getElementById('photo');
  var label = document.getElementById('photoName');
  if (input.files.length > 0) {
      label.innerHTML = input.files[0].name;
  } else {
      label.innerHTML = 'Seleccionar';
  }
}

  
function validarSoloLetras(selector){
$(selector).bind('keypress', function(event) {
    var regex = new RegExp("^[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\\s]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      alert("Por favor, ingresa solo letras (sin números).");
      return false;
    }
  });
}

validarSoloLetras("input#name");
validarSoloLetras("input#last_name");
validarSoloLetras("input#position");

/* 
  Swal.fire({
    title: 'Error!',
    text: 'Do you want to continue',
    icon: 'error',
    confirmButtonText: 'Cool'
  })

 */