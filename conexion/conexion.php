<?php

	class Conectar{
		
	  public function con (){
        $username = "root";
	    $password = 'root';
	    $hostname = "localhost";
	    //$hostname = "localhost";

	    $dbhandle = mysqli_connect($hostname, $username, $password)
	    or die ("No es posible conectarse a mysql");

        mysqli_select_db($dbhandle, "studyinecuador_search")
        or die("Could not select examples");

        return $dbhandle;
      }

	}
	
	class Consulta extends Conectar
	{
			
		private $aplicacionConvenio;	
		private $consultaFiltro;
		private $ubicacionInstitucion;
		private $ubicacion;
		private $institucion;
		private $institucionId;
		private $programaInstitucion;
		private $areaConocimiento;
		private $tipoPrograma;
		private $prgPreg;
		private $prgPos;
	
		public function __construct()
		{
			$this->consultaFiltro = array();
			$this->ubicacionInstitucion = array();
			$this->institucion = array();
			$this->institucionId = array();
			$this->programaInstitucion = array();
			$this->ubicacion = array();
			$this->areaConocimiento = array();
			$this->tipoPrograma = array();
			$this->prgPreg = array();
			$this->prgPos = array();
		}
		


		/************Consulta aplicacion de los convenios*************/		
		public function get_aplicacionConvenio()
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			//$sqlAplicacionConvenio = "Select * from institución";
			$sqlAplicacionConvenio = "Select * from institución ins 
									  join contacto con on (con.id_institucion = ins.id_institucion)
									  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)";
			//$resAplicacionConvenio = mysql_query(parent::con(),$sqlAplicacionConvenio); 
			$resAplicacionConvenio = mysqli_query($dbhandle, $sqlAplicacionConvenio); 

			if (mysqli_num_rows($resAplicacionConvenio)) {
			  while ( $regAplicacionConvenio = mysqli_fetch_array($resAplicacionConvenio, MYSQLI_ASSOC) ) {		
				$this->aplicacionConvenio[]=$regAplicacionConvenio;
			  }
			  return $this->aplicacionConvenio;
			}else{
				echo "No existen registros...";
				exit;
			}
		}


		/************Consulta aplicacion de las institucion por id*************/		
		public function get_institucionId($id_institucion)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from institución ins 
									  join contacto con on (con.id_institucion = ins.id_institucion)
									  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)
									  where ins.id_institucion = $id_institucion";
			$res = mysqli_query($dbhandle, $sql); 

			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->institucionId[]=$reg;
			  }
			  return $this->institucionId;
			}else{
			    echo "No existen registros...";
				exit;
			}
		}

		/*public function get_programa_institucion($id_institucion)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from nivel_asociado where id_institucion = $id_institucion";
			$res = mysqli_query($dbhandle, $sql); 

			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->programaInstitucion[]=$reg;
			  }
			  return $this->programaInstitucion;
			}else{
			    echo "No existen registros...";
				exit;
			}
		}*/

		public function get_prgPreg($id_institucion)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from nivel_asociado where id_institucion = $id_institucion and nombre_nivel like 'Tercer Nivel'";
			$res = mysqli_query($dbhandle, $sql); 

			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->prgPreg[]=$reg;
			  }
			  return $this->prgPreg;
			}else{
			    echo "No existen registros...";
				exit;
			}
		}

		public function get_prgPos($id_institucion)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from nivel_asociado where id_institucion = $id_institucion and nombre_nivel like 'Cuarto Nivel'";
			$res = mysqli_query($dbhandle, $sql); 

			
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->prgPos[]=$reg;
			  }
			  return $this->prgPos;
			
		}

		/************Consulta con filtros - combos*************/		
		public function get_datosConsultaFiltro()
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from institución";

			$res = mysqli_query($dbhandle, $sql); 
			
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->consultaFiltro[]=$reg;
			  }
			  return $this->consultaFiltro;
			

		}
		
		/************Consulta ubicacion - institución*************/		
		public function get_Institucion($id_institucionSelec, $zonaSelec, $regSelec)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			if($zonaSelec == "")
			{
				$sql = "Select DISTINCT ins.id_institucion, ins.nom_institucion, ins.descripcion_institucion, ins.logo_institucion, ins.logo_inst, ins.sitio_web,
							con.nombre_contacto, con.email_contacto, con.tlf_contacto, ubi.zona_ubicacion  from institución ins 
										  join contacto con on (con.id_institucion = ins.id_institucion)
										  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)
										  join nivel_asociado nv_as on (nv_as.id_institucion = ins.id_institucion)
										  where nv_as.tipo_programa like '$id_institucionSelec'";
				$res = mysqli_query($dbhandle, $sql); 
				if (mysqli_num_rows($res)) {
				  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
					$this->institucion[]=$reg;
				  }
				  return $this->institucion;
				}else{
					echo "No existen registros...";
					exit;
				}

			}elseif($regSelec == "")
			{
				$sql = "Select DISTINCT ins.id_institucion, ins.nom_institucion, ins.descripcion_institucion, ins.logo_institucion, ins.logo_inst, ins.sitio_web,
							con.nombre_contacto, con.email_contacto, con.tlf_contacto, ubi.zona_ubicacion  from institución ins 
										  join contacto con on (con.id_institucion = ins.id_institucion)
										  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)
										  join nivel_asociado nv_as on (nv_as.id_institucion = ins.id_institucion)
										  where nv_as.tipo_programa like '$id_institucionSelec' and nv_as.area_conocimiento like '$zonaSelec'";	
				$res = mysqli_query($dbhandle, $sql); 
				if (mysqli_num_rows($res)) {
				  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
					$this->institucion[]=$reg;
				  }
				  return $this->institucion;
				}else{
					echo "No existen registros...";
					exit;
				}

			}else{
				$sql = "Select DISTINCT ins.id_institucion, ins.nom_institucion, ins.descripcion_institucion, ins.logo_institucion, ins.logo_inst, ins.sitio_web,
							con.nombre_contacto, con.email_contacto, con.tlf_contacto, ubi.zona_ubicacion  from institución ins 
										  join contacto con on (con.id_institucion = ins.id_institucion)
										  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)
										  join nivel_asociado nv_as on (nv_as.id_institucion = ins.id_institucion)
										  where nv_as.tipo_programa like '$id_institucionSelec' and nv_as.area_conocimiento like '$zonaSelec' and ubi.zona_ubicacion like '$regSelec'";	
				$res = mysqli_query($dbhandle, $sql); 
				if (mysqli_num_rows($res)) {
				  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
					$this->institucion[]=$reg;
				  }
				  return $this->institucion;
				}else{
					echo "No existen registros...";
					exit;
				}
			}

			return $this->institucion;
		}
	

		/************Consulta ubicacion - institución*************/		
		public function get_ubicacionInstitucion($id_institucion)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select * from ubicacion where id_institucion = $id_institucion";
			$res = mysqli_query($dbhandle, $sql); 
			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->ubicacionInstitucion[]=$reg;
			  }
			  return $this->ubicacionInstitucion;
			}else{
				echo "No existen registros...";
				exit;
			}

		}

		public function get_regiones($id_institucionSelec, $zonaSelec)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "Select DISTINCT ubi.zona_ubicacion  from institución ins
										  join ubicacion ubi on (ubi.id_institucion = ins.id_institucion)
										  join nivel_asociado nv_as on (nv_as.id_institucion = ins.id_institucion)
										  where nv_as.tipo_programa like '$id_institucionSelec' and nv_as.area_conocimiento like '$zonaSelec'";
			$res = mysqli_query($dbhandle, $sql); 
			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->ubicacion[]=$reg;
			  }
			  return $this->ubicacion;
			}else{
				echo "No existen registros...";
				exit;
			}

		}

		public function get_areaConocimiento($tp_prg)
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			
			$sql = "select area_conocimiento from nivel_asociado where tipo_programa like '$tp_prg' group by area_conocimiento";
			$res = mysqli_query($dbhandle, $sql); 
			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->areaConocimiento[]=$reg;
			  }
			  return $this->areaConocimiento;
			}else{
				echo "No existen registros...";
				exit;
			}
		}
	
		public function get_tipoPrograma()
		{
			$dbhandle = parent::con();
			mysqli_query($dbhandle,'SET NAMES utf8 ');
			$sql = "select tipo_programa from nivel_asociado group by tipo_programa";
			$res = mysqli_query($dbhandle, $sql); 

			if (mysqli_num_rows($res)) {
			  while ( $reg = mysqli_fetch_array($res, MYSQLI_ASSOC) ) {		
				$this->tipoPrograma[]=$reg;
			  }
			  return $this->tipoPrograma;
			}else{
			    echo "No existen registros...";
				exit;
			}
		}


	}


?>
