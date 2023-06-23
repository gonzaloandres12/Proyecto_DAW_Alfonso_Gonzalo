// Obtener todos los elementos con la clase "remove__item"
var elementosEliminar = document.querySelectorAll(".remove__item");

// Agregar un controlador de eventos "click" a cada elemento
elementosEliminar.forEach(function(elemento) {
    elemento.addEventListener("click", function() {
        var productoID = elemento.getAttribute("data-id");
        window.location.href = "carrito.php?remove_item=" + productoID;
    });
});

function clearCart() {
    if (confirm("¿Estás seguro de que deseas eliminar todo el carrito?")) {
        window.location.href = "carrito.php?clear_cart=1";
    }
}

document.addEventListener("DOMContentLoaded", function() {
  // Obtener referencia al botón "Comprar"
  var comprarBtn = document.querySelector(".comprar__carrito");

  // Agregar Event Listener al botón
  comprarBtn.addEventListener("click", comprar);
});


function comprar() {
  window.location.href = "app/views/compraProducto.php";
}

function goBack() {
  window.location.href = "../../index.php"; // Reemplaza "ruta_del_archivo" con la ruta al archivo deseado
}


