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

/**$(document).ready(function() {
  // Evento que se dispara cuando se selecciona una categoría
  $("#category").change(function() {
    filtrarProductos();
  });
});

function filtrarProductos() {
  var categoria = $("#category").val();

  $.ajax({
    url: "app/helpers/generaCuadros.php",
    method: "POST",
    data: { category: categoria },
    success: function(response) {
      // Manipular la respuesta del servidor
      // Aquí puedes actualizar la lista de productos o realizar cualquier otra acción necesaria
      console.log(response); // Ejemplo: Imprimir la respuesta en la consola

      // Actualizar la sección de productos en el index.php
      $(".productos__center").html(response);
    },
    error: function(xhr, status, error) {
      // Manejar errores de la solicitud AJAX
      console.error(error); // Ejemplo: Imprimir el error en la consola
    }
  });
}*/
function goBack() {
  window.location.href = "../../index.php"; // Reemplaza "ruta_del_archivo" con la ruta al archivo deseado
}
