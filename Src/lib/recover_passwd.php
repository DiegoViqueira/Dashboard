<?php

	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "../clases/user.class.php";
	include "../clases/mail.class.php";
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	
	$Usuario = new User();
	
	
	if(DEBUG) 
	{
	
		if ($Usuario->get_passwd('d_viqueira@hotmail.coma'))	
		{	
		
			$Password = $Usuario->get_data();
			$msg="Segun lo solicitado desde nuestra pagina le enviamos los datos de Su Password \n  Password: " .$Password['passwd'];
			$Sender = new Email('d_viqueira@hotmail.com',$msg);
			$response=$Sender->send();
			
		}
		else
			$response= "No se pudo recuperar el password."; 
		
		echo $response;
	}
	else
	{	
		if ($Usuario->get_passwd($data->email))
		{	
			$Password = $Usuario->get_data();
			$msg="Segun lo solicitado desde nuestra pagina le enviamos los datos de Su Password\n Password:".$Password['passwd']."";
			$Sender = new Email($data->email,$msg);
			$response=$Sender->send();
			
		}
		else
			$response= "No se pudo recuperar el password."; 
		
		echo json_encode($response); //this will go back under "data" of angular call.
	}
	
	
	
?>