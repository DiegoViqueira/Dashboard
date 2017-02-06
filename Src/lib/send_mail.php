<?php

	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "../clases/mail.class.php";
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	    $msg = 'Contacto desde la WEB por Empresa['. $data->empresa .'] Mail ['. $data->email . '] Mensaje ['.$data->mensaje .']';
		$Sender = new Email('d_viqueira@hotmail.com',$msg);
		$resp=$Sender->send();
		
		$response['ERROR']=1;
		$response['MENSAJE']=$resp;
			
		
		echo json_encode($response); //this will go back under "data" of angular call.

	
	
	
?>