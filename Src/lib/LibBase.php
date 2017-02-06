<?php
/*  ---------------------------------------------------------
                  Library Base Class
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	

	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include_once "../clases/user.class.php";
	include_once "../clases/db.class.php";
	
	
	
	
/* --------------------------------------------------------------------------------------*/
/*                       Functions                                                       */
/* --------------------------------------------------------------------------------------*/

function check_validation()
{

    if(!isset($_SESSION['User'])) 
	{	

			header('Location:index.php' );
	
	}
	else
	{
		$User = unserialize($_SESSION['User']);
		
		
		if ( !$User->isValid() )
		{
			$_SESSION['User']=serialize($User);
			header('Location:index.php' );
		}
		
		$_SESSION['User']=serialize($User);
	}
	
}

function load_user($userarray)
{
					
					
					$mydb = new MySQL();
					
					if (!$mydb->connected())
					{
						echo $mydb->lastError;
						die;
					}
					
					$result=$mydb->executeSQL('SELECT * FROM claim.CLIENT_USERS WHERE 1');
					
					
					
					    $User = new User();
						$User->id  = $result['id'];
						$User->user  = $result['user'];
						$User->type  = $result['type'];
						$User->email  = $result['email'];
						$User->iteracion  = $result['iteration'];
						$User->profile  = $result['profile'];
						$User->description  = $result['description'];
						$User->valid  = true;
						$_SESSION['User'] = serialize($User);
					    
						
					
					$mydb->closeConnection();
}

function print_select ($table ,$keyField ,$ValueField,$SelectName,$ngModel,$placeholder,$SelectedValue='')
{
	
					$mydb = new MySQL();
					
					if (!$mydb->connected())
					{
						echo $mydb->lastError;
						die;
					}
					
					$result=$mydb->executeSQL('SELECT '.$keyField .','.$ValueField.' FROM '.$table);
	
					if (is_array($result))
					{
						echo ' <select name='.$SelectName.' ng-model='.$ngModel.' placeholder='.$placeholder.'>';
						foreach ( $result as $i => $item) 
							{
								if($SelectedValue == $item[$keyField] )
									echo '<option value="'.$item[$keyField].'" selected>'.$item[$ValueField].'</option>';
							    else
									echo '<option value="'.$item[$keyField].'">'.$item[$ValueField].'</option>';
						}
						echo '</select>';
					
					}
					$mydb->closeConnection();
}

function get_modules($profile)
{
		$mydb = new MySQL();
				
		
		if (!$mydb->connected())
		{
			echo $mydb->lastError;
			die;
		}
		else
		{
			
			$result=$mydb->executeSQL("SELECT CONCAT_WS(' ',b.icono,b.name) AS name ,b.file AS page FROM MODULES_PROFILES a, MODULES b WHERE a.moduleid = b.id AND a.profileid = ".$profile);
			
		}
		
		
		$mydb->closeConnection();
		
		
		
		return $result;
		
}

function clear_vars()
{
	    session_unset();
		session_destroy();

		
}

function add_user($InputNombre,$InputLastName,$InputGender,$Inputbday,$InputEmail,$InputPassword,$InputPhone,$InputEmpresa,$InputFBid = 0)
{
	
					
					$mydb = new MySQL();
					if (!$mydb->connected())
					{
						echo $mydb->lastError;
						die;
					}
					
					
					
					$strSql1="SELECT * FROM CLIENT_USERS where email='".$InputEmail. "' limit 1";
					if ( $data=$mydb->executeSQL($strSql1) )
					{
						if ($mydb->records > 0 )
						return 8;
					
					}
					else
					{					
					
						if ($InputEmpresa != 0)
						{
							$profile=3;
						}
						else
						{
							$profile=1;
						}
						
						
						$sqlstr="insert into CLIENT_USERS (profile,name,lastname,gender,phone,passwd,email,iteration,bday,picture,id_empresa,fbid) values ($profile,'$InputNombre','$InputLastName',$InputGender,'$InputPhone','$InputPassword','$InputEmail',0, STR_TO_DATE('$Inputbday', '%d/%m/%Y'),'images/default_user.jpg',$InputEmpresa,'$InputFBid')";
						
						$ret=false;
						
						if ( $mydb->executeSQL($sqlstr) )
							$ret=true;
							
						$mydb->closeConnection();
						
						return $ret;
					}
}


?>