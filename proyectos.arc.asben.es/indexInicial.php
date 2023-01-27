<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" type="text/css" href="hoja.css">
</head>

<body>

<?php
  include("conexion.php");

//---------------------------------
$registros_por_pagina=5; /* CON ESTA VARIABLE INDICAREMOS EL NUMERO DE REGISTROS QUE QUEREMOS POR PAGINA*/
$estoy_en_pagina=1;/* CON ESTA VARIABLE INDICAREMOS la pagina en la que estamos*/

  if (isset($_GET["pagina"])){
    $estoy_en_pagina=$_GET["pagina"];				
  }

$empezar_desde=($estoy_en_pagina-1)*$registros_por_pagina;

$sql_total="SELECT * FROM productos";
/* CON LIMIT 0,3 HACE LA SELECCION DE LOS 3 REGISTROS QUE HAY EMPEZANDO DESDE EL REGISTRO 0*/
$resultado=$base->prepare($sql_total);
$resultado->execute(array());

$num_filas=$resultado->rowCount(); /* nos dice el numero de registros del reusulset*/
$total_paginas=ceil($num_filas/$registros_por_pagina);



//--------------------------------
  
  $conexion=$base->query("SELECT * FROM productos LIMIT $empezar_desde,$registros_por_pagina");
  $registros=$conexion->fetchAll(PDO::FETCH_OBJ);

?>

<h1>CRUD<span class="subtitulo">Create Read Update Delete</span></h1>

  <table width="50%" border="0" align="center">
    <tr >
      <td class="primera_fila">CODIGOARTICULO</td>
      <td class="primera_fila">SECCION</td>
      <td class="primera_fila">NOMBRE</td>
      <td class="primera_fila">PRECIO</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
  
    <?php
      foreach($registros as $producto):
    ?>

		
   	<tr>
      <td><?php echo $producto->CODIGOARTICULO?> </td>
      <td><?php echo $producto->SECCION?></td>
      <td><?php echo $producto->NOMBREARTICULO?></td>
      <td><?php echo $producto->PRECIO?></td>
 
      <td class="bot"><a href="borrar.php?id=<?php echo $producto->CODIGOARTICULO?>"><input type='button' name='del' id='del' value='Borrar'></a></td>

      <td class='bot'><a href="editarInicial.php?CODIGOARTICULO=<?php echo $producto->CODIGOARTICULO?> & SECCION=<?php echo $producto->SECCION?> & NOMBREARTICULO=<?php echo $producto->NOMBREARTICULO?> & PRECIO=<?php echo $producto->PRECIO?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>
    </tr>  
    
    <?php
      endforeach;
    ?>

	<tr>
      <form method="get" action="insertar.php">
        <td><input type='text' name='CODIGOARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='SECCION' size='10' class='centrado'></td>
        <td><input type='text' name='NOMBREARTICULO' size='10' class='centrado'></td>
        <td><input type='text' name='PRECIO' size='10' class='centrado'></td>
        <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td>
        <tr>
        <td colspan="4">

          <?php
          //-------------------------PAGINACION-----------------//

          for ($i = 1; $i <= $total_paginas; $i++) {
            echo "<a href='?pagina=" . $i . "'>" . $i . "</a>  ";
          }

          ?>
        </td>
      </tr>
    
      </tr> 
      </form>
  </table>
  
<p>&nbsp;</p>
</body>
</html>