function updateFileName() {
    var input = document.getElementById('img');
    var label = document.getElementById('photoName');
    if (input.files.length > 0) {
        label.innerHTML = input.files[0].name;
    } else {
        label.innerHTML = 'Seleccionar';
    }
  }