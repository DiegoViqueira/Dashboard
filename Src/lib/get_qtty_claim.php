<?php
/*  ---------------------------------------------------------
					Register USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "./LibBase.php";
	
	



	
	
	$DEBUG= false;
	
	if (!$DEBUG)
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	

	
		$db = new MySQL();
	
		
		if ($db->connected())
		{
			    $strSql = "Select count(*) cant from RECLAMOS_ACTIVOS where id_empresa = " . $data->id_empresa ." and status =1 ";
			   
			   
			   
			   
			   if ($res=$db->executeSQL($strSql))
			   {
				   
				   if($db->records == 1)
				   {
					   $response=$res;
				   }   
				   else
				   {
						$response=$res;
				   }
				   
				   
				   
			   }
			   else
			   {
				   $response=array();
			   }
			   
			   
			    
		}
        else
		{
			$response=array();
		}			
	
	
	
		echo json_encode($response); //this will go back under "data" of angular call.
	
?>