<?php
/*  ---------------------------------------------------------
                  BD User WRAPPER Class
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
/* INLCUDES */
include_once('db.class.php');
/* Aplication User Class */
class Reclamos 
{
	const DEBUG = false; 
	public $data;
	public $lasterror;
	public $errorNro;
	
	public function __construct() 
	{
		$this->data=array();
		$this->lasterror='';
		$this->errorNro=0;
	}
	
	
	public function get_pendientes($idCliente)
	{
		
			$db = new MySQL();
			$resul=false;
		
			if ($db->connected())
			{
				$strSql="SELECT a.id , a.identificador , a.fecha , b.name , b.picture , c.description AS status ,d.name as categoria FROM RECLAMOS_ACTIVOS a ,  CLIENT_USERS b , ESTADOS_RECLAMOS c , CATEGORIES d  where a.id_cliente = " . $idCliente ."  and a.id_empresa = b.id and a.status in (1,2) and a.status = c.id  and a.id_categoria = d.id";
				if ($this->data=$db->executeSQL($strSql))
				{
					$this->lasterror='OK';
					$this->errorNro=1;
					$response=$data;	
					$resul=true;
					
				}
				else
				{
					$this->lasterror='NO DATA FOUND';
					$this->errorNro=0;
					
				}

				$db->closeConnection();
			}
	

		return $resul;
	
	}
	
	
	public function get_old($idCliente)
	{
		
		$db = new MySQL();
			$resul=false;
		
			if ($db->connected())
			{
				$strSql="SELECT a.id , a.identificador , a.fecha , b.name , b.picture , c.description AS status , a.isread as isread , d.name as categoria FROM RECLAMOS_CERRADOS a ,  CLIENT_USERS b , ESTADOS_RECLAMOS c , CATEGORIES d   where a.id_cliente = " . $idCliente ."  and a.id_empresa = b.id and a.status in (3) and a.status = c.id and a.id_categoria = d.id";
				if ($this->data=$db->executeSQL($strSql))
				{
					$this->lasterror='OK';
					$this->errorNro=1;
					$response=$data;	
					$resul=true;
					
				}
				else
				{
					$this->lasterror='NO DATA FOUND';
					$this->errorNro=0;
					
				}

				$db->closeConnection();
			}
	

		return $resul;
	
		
	}
	
	
	
}

?>