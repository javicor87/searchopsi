  <?php
  require_once("conexion/conexion.php");
  
  /********* Creamos un objeto de la clase Consulta *********/
  $Convenio = new Consulta();
  
  $id_institucion = $_GET['id'];
  $id_ubicacion = $_GET['idz'];
  //Consulta la aplicacion del convenios
  $resultadoConsultaGeneralPorID=$Convenio->get_institucionId("$id_institucion");
  $resultadoProgramaPreg=$Convenio->get_prgPreg("$id_institucion");
  $resultadoProgramaPost=$Convenio->get_prgPos("$id_institucion");  

?>
<HTML>
    <HEAD>
	  <title>Detalle</title>
	  
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <script language="javascript" src="js/jquery-3.3.1.min.js"></script>
	  <script src="js/funciones.js"></script>
    </HEAD>
    <BODY>
    	<br>
		<div class="container">
		  <div class="panel-group">
		    <div class="panel panel-success class">
		    	<?php 
		    		//for($i=0;$i<sizeof($resultadoConsultaGeneralPorID);$i++){
		    	?>
		      <div class="panel-heading"><?php echo ($resultadoConsultaGeneralPorID[0]["nom_institucion"]); ?></div>
		      <div class="panel-body">
		          <button type="button" onclick="javascript:history.back()" class="btn btn-info">Nueva Busqueda</button>
		      	<p>
		      		<center>
                      <img src="<?php echo $resultadoConsultaGeneralPorID[0]["logo_inst"]; ?>" width="60%" alt="No Existe Icono: <?php echo $resultadoConsultaGeneralPorID[0]["nom_institucion"]; ?>" class="img-fluid">
                    </center>
		      	</p>
		      	<p>
		      		<p align="lef"><b>Descripci&oacute;n:</b></p>
                	<p align="justify"><?php echo ($resultadoConsultaGeneralPorID[0]["descripcion_institucion"]); ?></p>
		      	</p>
		      	
		      		<p align="lef"><b>Programas Acad&eacute;micos</b></p>

		      		<div style="float: left; width: 100%;">
		      		<div style="float: left; width: 50%;">
		      			<h2>Pregrado</h2>
						<?php
		      				for($i=0;$i<sizeof($resultadoProgramaPreg);$i++){
								echo "<li>".$resultadoProgramaPreg[$i]["programas_nivel"]."</li>";
								echo "<br>";
		      				}
		      			?>
		      		</div>
		      		<?php if (!empty($resultadoProgramaPost)){?>
		      		<div style="float: right; width: 50%;">
		      			<h2>Posgrado</h2>
						<?php
		      				for($i=0;$i<sizeof($resultadoProgramaPost);$i++){
								echo "<li>".$resultadoProgramaPost[$i]["programas_nivel"]."</li>";
								echo "<br>";
		      				}
		      			?>
		      		</div>
		      		<?php }?>
		      	</div>
		      	
		      	<!--Programa corto-->
		      	<?php if ($resultadoConsultaGeneralPorID[0]["programa_corto"] != ""){?>
		      	<div style="float: left; width: 100%;">
		      		<div style="float: left; width: 100%;">
		      			<h2>Programas cortos</h2>
						<p align="justify"><?php echo $resultadoConsultaGeneralPorID[0]["programa_corto"]; ?></p>
		      		</div>
		      	</div>
                <?php }?>
		      	<!--Fin Programa corto-->

		      	
		      	<p>
                    <h2><b> Cont&aacute;ctenos</b></h2>
                    <p>
                      <span class="glyphicon glyphicon-user"></span>
                      <?php echo ($resultadoConsultaGeneralPorID[0]["nombre_contacto"]); ?>                      
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-send"></span>
                      <?php echo ($resultadoConsultaGeneralPorID[0]["email_contacto"]); ?>
                    </p>
                    <p>
                      <span class="glyphicon glyphicon-earphone"></span>
                      <?php echo ($resultadoConsultaGeneralPorID[0]["tlf_contacto"]); ?>
                    </p>
                </p>
                <p>
                	<p align="lef"><b>Sitio Web</b></p>
                	<p>
                      <span class="glyphicon glyphicon-globe"></span>
                      <?php echo ($resultadoConsultaGeneralPorID[0]["sitio_web"]); ?>
                    </p>
                </p>	      	
		      </div>
		      <?php
			  	//}
			  ?>
		    </div>


		  </div>
		</div>


    </BODY>
</HTML>