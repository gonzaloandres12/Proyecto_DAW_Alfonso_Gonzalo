<?php
function calcularTotalCarrito($productos)
{
    $total = 0;

    foreach ($productos as $producto) {
        $total += $producto->price;
    }

    return $total;
}


function cantProductos($productos)
{
    if (is_array($productos)) {
        return count($productos);
    } else {
        return 0;
    }
}


function generarElementosCarrito($productos)
{
    
    $result = "";

    foreach ($productos as $producto) {

        $result .= '<div class="carrito__item">
            <img src="' . $producto->image . '" alt="' . $producto->title . '">
            <div>
                <h3>' . $producto->title . '</h3>
                <p class="price">€' . $producto->price . '</p>
            </div>
            <div class="talla">
                <select id="talla__shoe">
                    <option value="">Talla</option>
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                    <option value="45">45</option>
                    <option value="46">46</option>
                    <option value="47">47</option>
                    <option value="48">48</option>
                </select>
            </div>
            <div>
            <a href="carrito.php?remove_item=' . $producto->id . '" class="remove__item">
            <i class="bx bx-trash"></i>
        </a>        
            </div>
        </div>';
    }


    return $result;
}



?>