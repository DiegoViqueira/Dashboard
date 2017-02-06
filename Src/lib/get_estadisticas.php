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
	
	
	function last_day()
	{
		$date = new DateTime('now');
		$date->modify('last day of this month');
		return $date->format('d');
	}


	function map_months($array)
	{
		$RESPONSE['MONTHS']=array();
		
		
		
		if(is_array($array))
		{
			for($mes=1;$mes <= 12 ; $mes++ )
			{
				$entre=false;
				for($i=0 ; $i< count($array);$i++)
				{
					
					if ($mes == $array[$i]['mes'] )
					{	
						
						$item['mes']=$mes;
						$item['cant']= $array[$i]['cant'];
						array_push($RESPONSE['MONTHS'] ,$item);
						
						$entre=true;
						break;
					}
				}
				
				if (!$entre)
				{
						$item['mes']=$mes;
						$item['cant']=0;
						array_push($RESPONSE['MONTHS'] ,$item);
						
						
				}
			}
		}
		return $RESPONSE['MONTHS'];
	};
	
	
	$DEBUG= false;
	
	if (!$DEBUG)
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	else
	{
		$data['id']=1;
		$data['profile']=1;
	}

	
		$db = new MySQL();
	
		
		if ($db->connected())
		{
		   if($data->profile == '1' ) //CLIENTE
		   {
			   
			   
			   $strSqlMonth = "Select distinct mes , sum(cant ) as cant
				from (
				Select MONTH(fecha) mes , count(*) cant from RECLAMOS_ACTIVOS where id_cliente = " . $data->id ." 
				group by mes UNION Select MONTH(fecha) mes , count(*) cant from RECLAMOS_CERRADOS where id_cliente = " . $data->id ."  
				group by mes ) AS A
				where A.mes IS NOT NULL  group by mes ;";
			
				
			   
			   if ($res=$db->executeSQL($strSqlMonth))
			   {
				   
				   if($db->records == 1)
				   {
					   $enviar=array();
					   array_push($enviar, $res);
					   $response['MONTH']=map_months($enviar);
				   }   
				   else
				   {
					$response['MONTH']=map_months($res);
				   }
				   
				   
				   
			   }
			   else
			   {
				   $response['MONTH']=map_months(array());
			   }
			   
			   $strSqlDay  = "SELECT DISTINCT * FROM
							(
							select b.description status ,count(*) cant from RECLAMOS_ACTIVOS a , ESTADOS_RECLAMOS b  where a.id_cliente = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							UNION
							select b.description status ,count(*) cant from RECLAMOS_CERRADOS a , ESTADOS_RECLAMOS b  where a.id_cliente = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							) AS t1
							" ;
			   
		    
				
			   if ($res=$db->executeSQL($strSqlDay))
			   {
				 $response['TOTAL']=$res;
				   
			   }
			   else
			   {
				   
				   $response['TOTAL']=array();
			   }
			   $response['STATUS'] = 1;
			   $response['ERROR'] = "OK";
		   }
		   else if ( $data->profile == '2')// EMPRESA
		   {
			   $strSqlMonth =   $strSqlMonth = "Select DISTINCT  mes , sum(cant ) as cant 
				from (
				Select MONTH(fecha) mes , count(*) cant from RECLAMOS_ACTIVOS where id_empresa = " . $data->id ." group by mes
				UNION Select MONTH(fecha) mes , count(*) cant from RECLAMOS_CERRADOS where id_empresa = " . $data->id ." 
				 group by mes ) AS A
				where A.mes IS NOT NULL  group by mes ;;";
			   
			   
			   
			   
			   if ($res=$db->executeSQL($strSqlMonth))
			   {
				   
				   if($db->records == 1)
				   {
					   $enviar=array();
					   array_push($enviar, $res);
					   $response['MONTH']=map_months($enviar);
				   }   
				   else
				   {
					$response['MONTH']=map_months($res);
				   }
				   
				   
				   
			   }
			   else
			   {
				   $response['MONTH']=map_months(array());
			   }
			   
			   
			    $strSqlDay  = "SELECT DISTINCT * FROM
							(
							select b.description status ,count(*) cant from RECLAMOS_ACTIVOS a , ESTADOS_RECLAMOS b  where a.id_empresa = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							UNION
							select b.description status ,count(*) cant from RECLAMOS_CERRADOS a , ESTADOS_RECLAMOS b  where a.id_empresa = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							) AS t1
							" ;
			  
			   
			   if ($res=$db->executeSQL($strSqlDay))
			   {
				 $response['TOTAL']=$res;
				   
			   }
			   else
			   {
				   
				   $response['TOTAL']=array();
			   }
			   
			   $response['STATUS'] = 1;
			   $response['ERROR'] = "OK";
		   }
		   else if  ( $data->profile == '3' )// USER EMPRESA
		   {
			   $strSqlMonth =   $strSqlMonth = "Select DISTINCT  mes , sum(cant ) as cant 
				from (
				Select MONTH(fecha) mes , count(*) cant from RECLAMOS_ACTIVOS where id_sid = " . $data->id ."  
				group by mes UNION Select MONTH(fecha) mes , count(*) cant from RECLAMOS_CERRADOS where id_sid = " . $data->id ."  
				group by mes ) AS A
				where A.mes IS NOT NULL  group by mes ;";
			   
			   
			   
			   if ($res=$db->executeSQL($strSqlMonth))
			   {
				   
				   if($db->records == 1)
				   {
					   $enviar=array();
					   array_push($enviar, $res);
					   $response['MONTH']=map_months($enviar);
				   }   
				   else
				   {
					$response['MONTH']=map_months($res);
				   }
				   
				   
				   
			   }
			   else
			   {
				   $response['MONTH']=map_months(array());
			   }
			   
			   
				$strSqlDay  = "SELECT DISTINCT * FROM
							(
							select b.description status ,count(*) cant from RECLAMOS_ACTIVOS a , ESTADOS_RECLAMOS b  where a.id_sid = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							UNION
							select b.description status ,count(*) cant from RECLAMOS_CERRADOS a , ESTADOS_RECLAMOS b  where a.id_sid = " . $data->id ."   and MONTH(a.fecha) = MONTH(CURRENT_TIMESTAMP()) and a.status=b.id  group by status
							) AS t1
							" ;
			  
			   
			   if ($res=$db->executeSQL($strSqlDay))
			   {
				 $response['TOTAL']=$res;
				   
			   }
			   else
			   {
				   
				   $response['TOTAL']=array();
			   }
			   
			   $response['STATUS'] = 1;
			   $response['ERROR'] = "OK";
			   
		   }
		   else
		   {
			   $response['STATUS'] = 0;
			   $response['ERROR'] = "Perfil de Usuario Invalido";
			   $response['TOTAL']=array();
			   $response['MONTH']=map_months(array());
			   
		   }
			  
		}
		else
		{
			$response['STATUS'] = 0;
			$response['ERROR'] = "No se pudo realizar laconsulta";
			$response['TOTAL']=array();
			$response['MONTH']=map_months(array());
		}
	
	
	
		echo json_encode($response); //this will go back under "data" of angular call.
	
?>