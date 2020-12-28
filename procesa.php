<?php
require_once("conexion/conexion.php");
$Convenio = new Consulta();
//Consulta con ubicación
//$resultadoUbicacionInstitucion=$Convenio->get_ubicacionInstitucion($_POST["elegido"]);
$resultadoRegiones=$Convenio->get_regiones($_POST["elegido"], $_POST["elegido1"]);

$options='<option value="0" selected="selected" style="font-size:15px;">Seleccione una opci&oacute;n...</option>';

   for($i=0;$i<sizeof($resultadoRegiones);$i++){
    ?>
        
        $options = <option value="<?php echo $resultadoRegiones[$i]["zona_ubicacion"];?>" style="font-size:15px;"><?php echo $resultadoRegiones[$i]["zona_ubicacion"]; ?></option>
    <?php   
    }               
echo $options;   

?>