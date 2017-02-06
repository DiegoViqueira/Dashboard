<?php
	if(!isset($_SESSION)) { session_start(); } 
	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	
	/*Global Classes*/
	include "../clases/user.class.php";
	include "./LibBase.php";
	
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	
		$Usuario = new User();
	
	
		
		
		
		if ($Usuario->load_user_fb($data->email))
		{	
			$response=array();
			$response['User'] = $Usuario->get_data();
			$response['Tables'] = $Usuario->get_tables();
			$response['unreadmessages'] = $Usuario->get_unreadmessages();
			$response['DefaultPage'] = $Usuario->getDefaultPage();
			
			
		}
		else
		{
			$sexo = $data->genger == 'male' ? 1 : 2 ;
			
			$result=add_user($data->first_name,$data->last_name,$sexo ,"00/00/0000",$data->email,'','',0,$data->id);
			
			
			if ( $result == 1 )
			{
				if ($Usuario->load_user_fb($data->email))
				{	
					$response=array();
					$response['User'] = $Usuario->get_data();
					$response['Tables'] = $Usuario->get_tables();
					$response['unreadmessages'] = $Usuario->get_unreadmessages();
					$response['DefaultPage'] = $Usuario->getDefaultPage();
					
					
				}
				else
				{
					$response =  "No se pudo cargar el Usuario";
				}
			}
			else if ($result == 8 )
			{
				
				$response="Usuario existente";
				
			}
			else
			{
				
				$response =  "No se pudo registrar el Usuario";
				
			}
			
		}
			
		
		echo json_encode($response); //this will go back under "data" of angular call.
	
	

?>