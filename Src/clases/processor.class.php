<?php
/*  ---------------------------------------------------------
                  Processor WRAPPER Class
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
/* INLCUDES */
include_once('db.class.php');
include_once('user.class.php');
include_once('mail.class.php');

define("_ENDL_", '<BR>');


/* Aplication User Class */
class Processor 
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
	
	public function pop($userKey,$userEmpresa)
	{
		
		
		
		$db1=new MySQL();
		if ($db1->connected())
		{
				$strSql="SELECT  * from RECLAMOS_ACTIVOS where id_empresa = ".$userEmpresa." and status = 2 and id_sid= ".$userKey. " limit 1 FOR UPDATE ";
			
				
				if ($this->data=$db1->executeSQL($strSql))
				{	 
							$db1->closeConnection();
							$this->errorNro= -6;
							return true;
				}
		}
		else
		{
			if(self::DEBUG) echo  "Processor::pop(ERROR)BD NOT Connected." . _ENDL_ ;
			$this->lasterror = "BD NOT Connected";
			return false;
			$this->errorNro= -3;
		}
		
		
		if(self::DEBUG) echo  "Processor::pop()" . _ENDL_ ;
		$db=new MySQL(false);
		
		if ($db->connected())
		{
			if(self::DEBUG) echo  "Processor::pop()BD Connected" . _ENDL_ ;
			
			if ($db->begin())
			{
				if(self::DEBUG) echo  "Processor::pop()Begin Transaction Starts" . _ENDL_ ;
				
				$strSql="SELECT  a.* , b.name as categoria from RECLAMOS_ACTIVOS a , CATEGORIES b where a.id_empresa = ".$userEmpresa." and a.status = 1 and a.id_sid=0  and a.id_categoria = b.id  limit 1 FOR UPDATE ";
			
				
				if ($this->data=$db->executeSQL($strSql))
				{	 
					if(self::DEBUG) echo  "Processor::pop()SELECT OK" . _ENDL_ ;
					if ( $db->records == 1  || $db->affected == 1)
					{
						if(self::DEBUG) echo  "Processor::pop()Record Geted" . _ENDL_ ;
						
						$strSql="UPDATE  RECLAMOS_ACTIVOS  set id_sid=".$userKey." , status = 2 where id =".$this->data['id'] ."";
						
						if ( $db->executeSQL($strSql) )
						{
							if(self::DEBUG) echo  "Processor::pop()UPDATE perform Id[".$this->data['id']."]" . _ENDL_ ;
							$db->commit();
							$db->closeConnection();
							$this->errorNro= -6;
							
							if(self::DEBUG) echo  "Processor::pop()Geting User for send Mail." . _ENDL_ ;
							$user = new User();
							
							if ( $user->get_user($this->data['id_cliente']) )
							{
								
								$data_client=$user->get_data();
								if ( $data_client['notify'] == 1 )
								{
									$msg="Su reclamo Nro [". $this->data['id'] ."] fue Pasado a estado en PROCESO.";
									if(self::DEBUG) echo  "Processor::pop()Sending mail to " . $data_client['email']  . _ENDL_ ;
									$Sender = new Email($data_client['email'],$msg);
									$res=$Sender->send();
									if(self::DEBUG) echo  "Processor::pop()mail send with response " .$res . _ENDL_ ;
								}
					
							}
							
							
							return true;
						}	
						else
						{
							if(self::DEBUG) echo  "Processor::pop(ERROR)UPDATE fail for Id[".$this->data['id']."] [".$db->lasterror."]" . _ENDL_ ;
							$db->rollback();
							$db->closeConnection();
							$this->errorNro= -7;
							$this->lasterror = "Update Fail";
							return false;
							
						}
					}
					else
					{
						if(self::DEBUG) echo  "Processor::pop()No records found " . _ENDL_ ;
						
						$this->lasterror = "No records found";
						$this->errorNro= -8;
						$db->roolback();
						$db->closeConnection();
						
						return false;
					}
				}
				else
				{
							if(self::DEBUG) echo  "Processor::pop(ERROR)SELECT fail." . _ENDL_ ;
							$db->rollback();
							$db->closeConnection();
							$this->lasterror = $db->lasterror;
							$this->errorNro= -5;
							return false;
				}
				
				

		}
			else
			{
				if(self::DEBUG) echo  "Processor::pop(ERROR)Begin fail." . _ENDL_ ;
				$db->closeConnection();
				$this->lasterror = "Begin Fail [".$db->lasterror."]";
				$this->errorNro= -4;
				return false;
		
			}
		}
		else
		{
			if(self::DEBUG) echo  "Processor::pop(ERROR)BD NOT Connected." . _ENDL_ ;
			$this->lasterror = "BD NOT Connected";
			return false;
			$this->errorNro= -3;
			
		}

		$this->lasterror = "UNK ERROR";
		$this->errorNro= -2;
		return false;
	}
	
	
	public function update($userKey,$idClaim,$detail,$idClient)
	{
		
		
		
		$db1=new MySQL();
		
		
		
		if(self::DEBUG) echo  "Processor::update(".$userKey.",".$idClaim .",".$detail . ")" . _ENDL_ ;
		
		$db=new MySQL(false);
		
		if ($db->connected())
		{
			if(self::DEBUG) echo  "Processor::update()BD Connected" . _ENDL_ ;
			
			if ($db->begin())
			{
				if(self::DEBUG) echo  "Processor::update()Begin Transaction Starts" . _ENDL_ ;
				
				$strSql="update RECLAMOS_ACTIVOS set isread=0 , status = 3 where id = " . $idClaim;
			
				
				if ($this->data=$db->executeSQL($strSql))
				{	 
					if(self::DEBUG) echo  "Processor::update() UPDATE OK" . _ENDL_ ;
					if ( $db->records == 1  || $db->affected == 1)
					{
						if(self::DEBUG) echo  "Processor::update() Record Updated." . _ENDL_ ;
						
						$strSql="insert into RECLAMOS_MENSAJES (id_reclamo,description) values (".$idClaim.",'". $detail ."')";
						
						if ( $db->executeSQL($strSql) )
						{
							
							$strSql="insert into RECLAMOS_CERRADOS  SELECT * from RECLAMOS_ACTIVOS where id = ".$idClaim ;
							if ( $db->executeSQL($strSql) )
							{
								$strSql="DELETE FROM RECLAMOS_ACTIVOS where id = ".$idClaim;
								
								
								if ( $db->executeSQL($strSql) )
								{
									$strSql="insert into RECLAMOS_MENSAJES_OLD  SELECT * from RECLAMOS_MENSAJES where id_reclamo =".$idClaim;
								
									if ( $db->executeSQL($strSql) )
									{
										$strSql="DELETE FROM RECLAMOS_MENSAJES where id_reclamo =".$idClaim;
								
										if(self::DEBUG) echo  "Processor::update() ". $strSql . _ENDL_ ;
										if ( $db->executeSQL($strSql) )
										{
											if(self::DEBUG) echo  "Processor::update() Mesaje Inserted." . _ENDL_ ;
											$db->commit();
											$db->closeConnection();
											$this->errorNro= -6;
											
											if(self::DEBUG) echo  "Processor::update()Geting User for send Mail." . _ENDL_ ;
											$user = new User();
											
											if ( $user->get_user($idClient) )
											{
												
												$data_client=$user->get_data();
												if ( $data_client['notify'] == 1 )
												{
													$msg="Su reclamo Nro [". $idClaim ."] fue Pasado a estado en CERRADO con el siguiente mensaje [". $detail ."].";
													if(self::DEBUG) echo  "Processor::update()Sending mail to " . $data_client['email']  . _ENDL_ ;
													$Sender = new Email($data_client['email'],$msg);
													$res=$Sender->send();
													if(self::DEBUG) echo  "Processor::update()mail send with response " .$res . _ENDL_ ;
												}
									
											}
										
											return true;
										}
										else
										{
											if(self::DEBUG) echo  "Processor::update(ERROR) Mesaje fail delete mesages claim [".$idClaim."]" . _ENDL_ ;
											$db->rollback();
											$db->closeConnection();
											$this->errorNro= -14;
											$this->lasterror = "Mesaje insert fail. -14 ";
											return false;
										}
									}
									else
									{
										if(self::DEBUG) echo  "Processor::update(ERROR) Mesaje fail insert in old mesages claim [".$idClaim."]" . _ENDL_ ;
										$db->rollback();
										$db->closeConnection();
										$this->errorNro= -13;
										$this->lasterror = "Mesaje insert fail.-13";
										return false;
									}
								}
								else
								{
									if(self::DEBUG) echo  "Processor::update(ERROR) Mesaje fail delete from new claim [".$idClaim."]" . _ENDL_ ;
									$db->rollback();
									$db->closeConnection();
									$this->errorNro= -12;
									$this->lasterror = "Mesaje insert fail. -12";
									return false;
								}
							}
							else
							{
								if(self::DEBUG) echo  "Processor::update(ERROR) Mesaje fail move to OLD CLAIM [".$idClaim."]" . _ENDL_ ;
								$db->rollback();
								$db->closeConnection();
								$this->errorNro= -11;
								$this->lasterror = "Mesaje insert fail. -11";
								return false;
							}
						}	
						else
						{
							if(self::DEBUG) echo  "Processor::update(ERROR) Mesaje fail to insert for id [".$idClaim."]" . _ENDL_ ;
							$db->rollback();
							$db->closeConnection();
							$this->errorNro= -7;
							$this->lasterror = "Mesaje insert fail.";
							return false;
							
						}
					}
					else
					{
						if(self::DEBUG) echo  "Processor::update()No records found for update  " . _ENDL_ ;
						
						$this->lasterror = "No records found for update";
						$this->errorNro= -8;
						$db->roolback();
						$db->closeConnection();
						
						return false;
					}
				}
				else
				{
							if(self::DEBUG) echo  "Processor::update(ERROR) Update fail." . _ENDL_ ;
							$db->rollback();
							$db->closeConnection();
							$this->lasterror = $db->lasterror;
							$this->errorNro= -5;
							return false;
				}
				
				

		}
			else
			{
				if(self::DEBUG) echo  "Processor::update(ERROR)Begin fail." . _ENDL_ ;
				$db->closeConnection();
				$this->lasterror = "Begin Fail [".$db->lasterror."]";
				$this->errorNro= -4;
				return false;
		
			}
		}
		else
		{
			if(self::DEBUG) echo  "Processor::update(ERROR)BD NOT Connected." . _ENDL_ ;
			$this->lasterror = "BD NOT Connected";
			return false;
			$this->errorNro= -3;
			
		}

		$this->lasterror = "UNK ERROR";
		$this->errorNro= -2;
		return false;
	}
	
	
}



	
?>