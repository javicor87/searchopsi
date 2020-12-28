<?php

  require_once("conexion/conexion.php");
  
  /********* Creamos un objeto de la clase Consulta *********/
  $Convenio = new Consulta();
  
  //Consulta la aplicacion del convenios
  $resultadoAplicacionConvenio=$Convenio->get_aplicacionConvenio();
  
  //Consulta con filtros
  $resultadoConsultaFiltro=$Convenio->get_datosConsultaFiltro();

  $resultadoTipoPrograma=$Convenio->get_tipoPrograma();
  
  //Consulta unidades
  //$resultadoTipoOrganizacion = $Convenio->get_tipoOrganizacion();
  
  //Consulta la localidad del convenio
  //$resultadoLocalidad = $Convenio->get_localidad(); 
  
  //Consulta organizaciones
  //$resultadoOrganizaciones = $Convenio->get_organizaciones();
  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Buscador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
  <script src="js/funciones.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
   $("#listInst").change(function () {
           $("#listInst option:selected").each(function () {
            elegido=$(this).val();
            $.post("procesa.php", { elegido: elegido }, function(data){
            $("#menu2").html(data);
            });            
        });
   })
});

    $(document).ready(function(){
   $("#listZona").change(function () {
           $("#listZona option:selected").each(function () {
            elegido=document.getElementById("comboboxInst").value;
            elegido1=$(this).val();
            $.post("procesa1.php", { elegido: elegido,  elegido1: elegido1 }, function(data){
            $("#menu3").html(data);
            });            
        });
   })
});

//procesaporInstitucion
  	$(document).ready(function(){
   $("#listInst").change(function () {
           $("#listInst option:selected").each(function () {
            elegidoInst=$(this).val();
            $.post("procesaporInstitucion.php", { elegidoInst: elegidoInst }, function(data){
            $("#filtroInst").html(data);
            });            
        });
   })
});

//procesaPorInistitucionyZona
  	$(document).ready(function(){
   $("#menu2").change(function () {
           $("#menu2 option:selected").each(function () {
           	elegidoInst=document.getElementById("comboboxInst").value;
            elegidoZona=$(this).val();
            $.post("procesaporInstitucion.php", { elegidoInst: elegidoInst, elegidoZona:elegidoZona }, function(data){
            $("#filtroInst").html(data);
            });            
        });
   })
});

    //procesaPorInistitucionyZona
    $(document).ready(function(){
   $("#menu3").change(function () {
           $("#menu3 option:selected").each(function () {
            elegidoInst=document.getElementById("comboboxInst").value;
            elegidoZona=document.getElementById("menu2").value;
            elegidoRegion=$(this).val();
            $.post("procesaporInstitucion.php", { elegidoInst: elegidoInst, elegidoZona:elegidoZona, elegidoRegion:elegidoRegion  }, function(data){
            $("#filtroInst").html(data);
            });            
        });
   })
});


  </script>

</head>
<body>
<!--  ********************************  INICIO DE MENU SUPERIOR CON PESTAÑAS  **************************************-->
<div class="container">
  <h2>Estudia en Ecuador</h2>
  <ul class="nav nav-tabs">
    <li>
      <span style="font-size:48px;color:red" class="glyphicon glyphicon-education"></span>
      <!--<a data-toggle="tab" href="#home">Programs</a>-->
    </li>
    <!--<li>
      <span style="font-size:48px;color:red" class="glyphicon glyphicon-education"></span>
      <a data-toggle="tab" href="#menu1">Programas</a>
    </li>-->
  </ul>
<!--  ********************************  FIN DE MENU SUPERIOR CON PESTAÑAS  **************************************-->


<div class="tab-content">
<!--  ********************************  INICIO CONTENIDO DEL MENU INSTITUCIONES  *********************************-->
      <div id="menu1" class="tab-pane fade">
        <div class="table">
            <br>
            <div class="alert alert-info" role="alert">Esta opción le permitirá encontrar una lista de universidades ecuatorianas.</div>
        <br/>
        <div class="input-group">
          <span class="input-group-addon">Buscar</span>
          <input id="filtrar" type="text" class="form-control" placeholder="Ingrese texto para empezar...">
        </div>
        <br/>
          <?php
            for($i=0;$i<sizeof($resultadoAplicacionConvenio);$i++){
          ?>
        <div class="table-responsive buscar">
          <table class="table table-sm" style="display: none;" border="1">
            <tbody>
              <tr>
                <td scope="col" colspan="3" width="100%">
                  <h4><center><b>
                    <span class="glyphicon glyphicon-tower"></span>
                    &nbsp&nbsp
                    <?php echo $resultadoAplicacionConvenio[$i]["nom_institucion"]; ?>
                  </b></center></h4>
                </td>
              </tr>
              <tr>
                <td scope="row" rowspan="2" width="25%"  style="vertical-align:middle;" >
                  <p>
                    <center>
                      <img src="<?php echo $resultadoAplicacionConvenio[$i]["logo_institucion"]; ?>" width="60%" height="60%" alt="No Existe Icono: <?php echo $resultadoAplicacionConvenio[$i]["nom_institucion"]; ?>" class="img-fluid">
                    </center>
                  </p>
                </td>
                <td width="45%">
                  <p><center><b>Descripci&oacute;n</b></center></p>
                  <p align="justify"><div class="hidden-xs"><?php echo substr(($resultadoAplicacionConvenio[$i]["descripcion_institucion"]), 0, 500); ?></div>&nbsp&nbsp<a href="detalle.php?id=<?php echo ($resultadoAplicacionConvenio[$i]["id_institucion"]); ?>&idz=<?php echo ($resultadoAplicacionConvenio[$i]["id_ubicacion"]); ?>">Leer m&aacute;s..</a></p>
                </td>
                <td width="30%">
                    <p><center><b>Informaci&oacute;n de contacto</b></center></p>
                    <p>
                      <span class="glyphicon glyphicon-user"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["nombre_contacto"]); ?>                      
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-send"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["email_contacto"]); ?>
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-earphone"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["tlf_contacto"]); ?>
                    </p>
                </td>
              </tr>
              <tr>
                <td scope="row" colspan="2">
                  <p align="justify"><a href="<?php echo ($resultadoAplicacionConvenio[$i]["sitio_web"]); ?>" target="_blank"><?php echo ($resultadoAplicacionConvenio[$i]["sitio_web"]); ?></a></p>
                </td>
              </tr>
            </tbody>
          </table>
         </div>
        <?php   
          }
        ?>
      </div>
    </div>


<!--  ********************************  FIN CONTENIDO DEL MENU INSTITUCIONES  *********************************-->


<!--  ********************************  INICIO CONTENIDO DEL MENU PROGRAMAS  *********************************-->
		<br>
    <div id="home" class="tab-pane fade in active" style="width: 100%">  
    <div class="alert alert-info" role="alert">Utilice el buscador de abajo para encontrar universidades ecuatorianas que mejor se adapten a sus intereses; luego, use los detalles de contacto que figuran en sus perfiles para ponerse en contacto y recibir información más detallada sobre sus programas y servicios.</div>
      <div class="row">
            <div class="col-sm-3">
              <div id="listInst" style="font-size:15px;color:black; display: inline-block;">
	      <h4>Tipo de Programa:</h4>
	      <select name="AplicacionConvenio" id="comboboxInst">
	      <option value="0" style="font-size:15px;">Seleccione una opción...</option> 
		    <?php
		          for($i=0;$i<sizeof($resultadoTipoPrograma);$i++){
		        ?>
		          <option value="<?php echo $resultadoTipoPrograma[$i]["tipo_programa"];?>" style="font-size:15px;"><?php echo ($resultadoTipoPrograma[$i]["tipo_programa"]); ?></option>
		        <?php   
		          }
		        ?>
		    </select>
		    
    	</div>
            </div>
            <div class="col-sm-5">
              <div id="listZona" style="font-size:15px;color:black; display: inline-block">
    		<h4>Área del conocimiento:</h4>
					<select name="modelo" id="menu2">    
	    		<option value="0" style="font-size:15px;">Seleccione una opción...</option>
					</select>
				
    	</div>
            </div>
            <div class="col-sm-4">
              <div id="listZona1" style="font-size:15px;color:black; display: inline-block">
        <h4>Región:</h4>
          <select name="modelo1" id="menu3">    
          <option value="0" style="font-size:15px;">Seleccione una opción...</option>
          </select>
      </div>
            </div>
        </div>

    	<div id="filtroInst">
<!--  ********************************  INICIO CONTENIDO DEL MENU INSTITUCIONES  *********************************-->
        <div class="table">
        <br/>
          <!--<?php
            for($i=0;$i<sizeof($resultadoAplicacionConvenio);$i++){
          ?>
        <div class="table-responsive buscar">
          <table class="table table-sm" border="1">
            <tbody>
              <tr>
                <td scope="col" colspan="3" width="100%">
                  <h4><center><b>
                    <span class="glyphicon glyphicon-education"></span>
                    &nbsp&nbsp
                    <?php echo $resultadoAplicacionConvenio[$i]["nom_institucion"]; ?>
                  </b></center></h4>
                </td>
              </tr>
              <tr>
                <td scope="row" rowspan="2" width="25%"  style="vertical-align:middle;" >
                  <p>
                    <center>
                      <img src="<?php echo $resultadoAplicacionConvenio[$i]["logo_institucion"]; ?>" width="60%" height="60%" alt="No Existe Icono: <?php echo $resultadoAplicacionConvenio[$i]["nom_institucion"]; ?>" class="img-fluid">
                    </center>
                  </p>
                </td>
                <td width="30%">
                    <p><center><b>Informaci&oacute;n de Contacto</b></center></p>
                    <p>
                      <span class="glyphicon glyphicon-user"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["nombre_contacto"]); ?>                      
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-send"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["email_contacto"]); ?>
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-earphone"></span>
                      <?php echo ($resultadoAplicacionConvenio[$i]["tlf_contacto"]); ?>
                    </p>
                </td>
                <td width="100%">
                  <p><center><b>Descripci&oacute;n</b></center></p>
                  <p align="justify"><div class="hidden-xs"><?php echo substr(($resultadoAplicacionConvenio[$i]["descripcion_institucion"]), 0, 500); ?></div>&nbsp&nbsp<a href="detalle.php?id=<?php echo ($resultadoAplicacionConvenio[$i]["id_institucion"]); ?>&idz=<?php echo ($resultadoAplicacionConvenio[$i]["id_ubicacion"]); ?>">Leer m&aacute;s..</a></p>
                </td>
              </tr>
              <tr>
                <td scope="row" colspan="2">
                  <p align="justify"><b>Sitio Web: </b> <a href="<?php echo $resultadoAplicacionConvenio[$i]["sitio_web"]; ?>" target="_blank"><?php echo $resultadoAplicacionConvenio[$i]["sitio_web"]; ?></a> </p>
                </td>
              </tr>
            </tbody>
          </table>
         </div>
        <?php   
          }
        ?>-->
      </div>
<!--  ********************************  FIN CONTENIDO DEL MENU INSTITUCIONES  *********************************-->
    	</div>


    </div>



  <!--  ********************************  FIN CONTENIDO DEL MENU INSTITUCIONES  *********************************-->




<!--  ********************************  FIN CONTENIDO DE OTROS MENUS   *********************************-->

  </div>
</div>
</body>
</html>