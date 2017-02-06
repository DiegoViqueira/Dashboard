<?php

	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "../clases/processor.class.php";
	
	const DEBUG = false;
	
	
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	
	$app = new Processor();
	
	$response=array();
	
	
	if(DEBUG) 
	{
	
		if ($app->update(4,32,'PRUEBA')	)
		{	
			$response['STATUS']=1;
			$response['MESAJE']="OK";
		}
		else
		{
			
			$response['STATUS']=$app->errorNro;
			$response['MESAJE']=$app->lasterror;
			
		}
		
		echo json_encode($response); //this will go back under "data" of angular call.
		
	}
	else
	{	

		if ($app->update($data->id_usuario,$data->id_reclamo,$data->mensaje,$data->id_cliente))
		{	
			
			$response['STATUS']=1;
			$response['MESAJE']="OK";
		}
		else
		{
			$response['STATUS']=$app->errorNro;
			$response['MESAJE']=$app->lasterror;
		}
		
		echo json_encode($response); //this will go back under "data" of angular call.
	}
	

?>