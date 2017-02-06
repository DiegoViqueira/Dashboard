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
class Email 
{
	const DEBUG = false; 
	private $msg;
    private $email;
	
	public function __construct($email,$msg) 
	{
		$this->msg=$msg;
		$this->email=$email;
		
	}
	
	public function send()
	{
		$to = $this->email;
		
		$subject = "Rec!amo On-Line NOTIFICACION";

		$message = "
		<html>
		<head>
		<title>Rec!amo On-Line</title>
		</head>
		<body>

		<div style=\"text-align:leftp;\">
		<img src=\"http://fojacerorockcomar820.ipage.com/reclamos.2.0/images/claim.png\" 
			width=\"150\" 
			height=\"50\" 
			border=\"0\" 
			alt=\"Rec!amo On-Line\">
		<br>
		</div>
		<div style=\"text-align:leftp; \">
		<BR>
		<span>
		".$this->msg."
		</span>
		<BR>
		<BR>
		<span>
		Atte. Rec!amo On-Line.
		<BR>
		Web: www.reclamoonline.com.ar
		</span>
		</div>


		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <d_viqueira@hotmail.com>' . "\r\n";
			if (mail($to,$subject,$message,$headers))
		    {
					return "Mensaje Enviado con Exito.";
			}	
			else
			{
					return "No se pudo Enviar el Mensaje.";
			}

		
	}
	
}
?>
	