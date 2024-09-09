<?php
require_once 'modelos.php'; // Requerimos las clase modelos

$valores = $_POST; // Guardamos en $valores los datos del formulario

$usuario = "'".$valores['usuario']."'"; // Guardamos el usuario entre '
$password = "'".$valores['password']."'"; // Guardamos el password entre '

$usuarios = new Modelo('cliente'); // Creamos el objeto $usuarios basado en la tabla cliente
$usuarios->set_criterio("usuario=$usuario AND password=$password"); // Establecemos los criterios de usuario y password

$datos = $usuarios->seleccionar(); // Ejecutamos el método seleccionar

echo $datos; // Devolvemos los datos

// SELECT * FROM clientes WHERE usuarios= 'josedesanmartin' AND password= '123456'


?>