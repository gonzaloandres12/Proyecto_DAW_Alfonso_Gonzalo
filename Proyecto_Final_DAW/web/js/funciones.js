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
  
document.getElementById("category").addEventListener("change", filtrarProductos);

function filtrarProductos() {
  var categoria = $("#category").val();

  // Realizar la solicitud AJAX para obtener los nuevos elementos
  $.ajax({
    url: "app/helpers/generaCuadros.php",
    method: "POST",
    data: { category: categoria },
    success: function(response) {
      // Actualizar la sección de productos con los nuevos elementos
      $(".productos__center").html(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}