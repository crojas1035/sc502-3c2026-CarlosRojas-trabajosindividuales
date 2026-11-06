
<?php

$transacciones = array();

function registrarTransaccion($id, $descripcion, $monto) {

    global $transacciones;

    $ingreso_transaccion = array(
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    );

    array_push($transacciones, $ingreso_transaccion);
}

function generarEstadoDeCuenta() {

    global $transacciones;

    $total = 0;

    $contenido = "ESTADO DE CUENTA\n\n";
    $contenido .= "DETALLE DE TRANSACCIONES\n\n";

    echo "<h1>Estado de Cuenta</h1>";
    echo "<h2>Detalle de Transacciones</h2>";

    foreach ($transacciones as $transaccion) {

        echo "ID: " . $transaccion["id"] . "<br>";
        echo "Descripcion: " . $transaccion["descripcion"] . "<br>";
        echo "Monto: " . $transaccion["monto"] . "<br><br>";

        $contenido .= "ID: " . $transaccion["id"] . "\n";
        $contenido .= "Descripcion: " . $transaccion["descripcion"] . "\n";
        $contenido .= "Monto: " . $transaccion["monto"] . "\n\n";

        $total = $total + $transaccion["monto"];
    }

    $interes = $total * 0.026;
    $totalConInteres = $total + $interes;

    $cashback = $total * 0.001;

    $montoFinal = $totalConInteres - $cashback;

    echo "<h2>Resumen del Estado de Cuenta</h2>";

    echo "Total de contado: " . $total . "<br>";
    echo "Interes del 2.6%: " . $interes . "<br>";
    echo "Total con intereses: " . $totalConInteres . "<br>";
    echo "Cashback del 0.1%: " . $cashback . "<br>";
    echo "Monto final a pagar: " . $montoFinal . "<br>";

    $contenido .= "RESUMEN DEL ESTADO DE CUENTA\n\n";
    $contenido .= "Total de contado: " . $total . "\n";
    $contenido .= "Interes del 2.6%: " . $interes . "\n";
    $contenido .= "Total con intereses: " . $totalConInteres . "\n";
    $contenido .= "Cashback del 0.1%: " . $cashback . "\n";
    $contenido .= "Monto final a pagar: " . $montoFinal . "\n";

  $resultado = file_put_contents(__DIR__ . "/estado_cuenta.txt", $contenido);

if ($resultado === false) {
    echo "<p>Error: No se pudo crear el archivo de texto.</p>";
} else {
    echo "<p>Archivo estado_cuenta.txt generado correctamente.</p>";
}
}
registrarTransaccion(1, "Compra de supermercado", 10000);
registrarTransaccion(2, "Compra de ropa", 20000);
registrarTransaccion(3, "Compra de gasolina", 30000);
registrarTransaccion(4, "Compra de comida", 40000);
registrarTransaccion(5, "Compra de medicamentos", 50000);

generarEstadoDeCuenta();

?>



