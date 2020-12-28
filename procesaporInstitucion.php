<?php
require_once("conexion/conexion.php");
$Convenio = new Consulta();

//Verificamos si eligio uno o varios combos
$institucionSelec;
$zonaSelec;

if (isset($_POST["elegidoInst"])){
	$institucionSelec = $_POST["elegidoInst"];
} else{
	$institucionSelec = "";
}

if (isset($_POST["elegidoZona"])){
	$zonaSelec = $_POST["elegidoZona"];
} else{
	$zonaSelec = "";
}

if (isset($_POST["elegidoRegion"])){
  $regionSelec = $_POST["elegidoRegion"];
} else{
  $regionSelec = "";
}

//Consulta con ubicaci¨®n
$resultadoInstitucion=$Convenio->get_Institucion($institucionSelec, $zonaSelec, $regionSelec);

$options= 
""?>

        <div class="table">
        <h3>Instituciones</h3>
        <br/>
          <?php
            for($i=0;$i<sizeof($resultadoInstitucion);$i++){
          ?>
        <div class="table-responsive buscar">
          <table class="table table-sm" border="1">
            <tbody>
              <tr>
                <td scope="col" colspan="3" width="100%">
                  <h4><center><b>
                    <span class="glyphicon glyphicon-education"></span>
                    &nbsp&nbsp
                    <?php echo $resultadoInstitucion[$i]["nom_institucion"]; ?>
                  </b></center></h4>
                  <p style="text-align:  center;">
                    <span class="glyphicon glyphicon-pushpin"></span>
                    Regi&oacute;n: <?php echo ($resultadoInstitucion[$i]["zona_ubicacion"]); ?>
                  </p>
                </td>
              </tr>
              <tr>
                <td scope="row" rowspan="2" width="25%"  style="vertical-align:middle;" >
                  <p>
                    <center>
                      <img src="<?php echo $resultadoInstitucion[$i]["logo_institucion"]; ?>" width="60%" height="60%" alt="No Existe Icono: <?php echo $resultadoInstitucion[$i]["nom_institucion"]; ?>" class="img-fluid">
                    </center>
                  </p>
                </td>
                <td width="30%">
                    <p><center><b>Informaci&oacute;n de contacto</b></center></p>
                    <p>
                      <span class="glyphicon glyphicon-user"></span>
                      <?php echo ($resultadoInstitucion[$i]["nombre_contacto"]); ?>                      
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-send"></span>
                      <?php echo ($resultadoInstitucion[$i]["email_contacto"]); ?>
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-earphone"></span>
                      <?php echo ($resultadoInstitucion[$i]["tlf_contacto"]); ?>
                    </p>
                </td>
                <td width="100%">
                  <p><center><b>Descripci&oacute;n</b></center></p>
                  <p align="justify"><div class="hidden-xs"><?php echo substr(($resultadoInstitucion[$i]["descripcion_institucion"]), 0, 500); ?></div>&nbsp&nbsp<a href="detalle.php?id=<?php echo ($resultadoInstitucion[$i]["id_institucion"]); ?>&idz=<?php echo ($resultadoInstitucion[$i]["id_ubicacion"]); ?>">Leer m&aacute;s..</a></p>
                </td>
              </tr>
              <tr>
                <td scope="row" colspan="2">
                  <p>Sitio web: </b> <a href="<?php echo $resultadoInstitucion[$i]["sitio_web"]; ?>" target="_blank"><?php echo $resultadoInstitucion[$i]["sitio_web"]; ?></a></p>
                </td>
              </tr>
            </tbody>
          </table>
         </div>
        <?php   
          }
        ?>
      </div>
<?php           
echo $options;   

?>
