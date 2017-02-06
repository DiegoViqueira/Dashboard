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
class User 
{
    const DEBUG = false; 
	private $valid;
    private $data;
	private $tables;
	private $unreadmessages;
	private $default_page;
	public  $lastError;
	
	public function __construct() 
	{
		$this->data=array();
		$this->tables=array();
		$this->valid = false;
		$this->unreadmessages = array() ;
		$this->default_page = '' ;
	}



	public function get_user($userKey)
	{
		
		
		$db=new MySQL();
		
		if ($db->connected())
		{
			
			$strSql="SELECT  *  from CLIENT_USERS where id=".$userKey." ";
			
			if ($this->data=$db->executeSQL($strSql))
			{	 
				
			}
			$db->closeConnection();
				
			return true;
		}
		else
		{
				$db->closeConnection();
				$this->lastError='USER NOT FOUND';
				return false;
		}
	}
	
	public function get_passwd($userKey)
	{
		
		
		$db=new MySQL();
		
		if ($db->connected())
		{
			
			$strSql="SELECT  passwd  from CLIENT_USERS where email='".$userKey."' ";
			
			if ($this->data=$db->executeSQL($strSql))
			{	 
				
			}
			$db->closeConnection();
				
			return true;
		}
		else
		{
				$db->closeConnection();
				$this->lastError='USER NOT FOUND';
				return false;
		}
	}
	public function load_user($userKey,$UserPassword)
	{
		$db=new MySQL();
		
		if ($db->connected())
		{
			
			$strSql="SELECT * from CLIENT_USERS where email='".$userKey."' and passwd='".$UserPassword."'";
			
			if ($this->data=$db->executeSQL($strSql))
			{	 
				//Unset password for security
				$this->data['bday']= substr($this->data['bday'],8,2) .'/'. substr($this->data['bday'],5,2).'/'.substr($this->data['bday'],0,4);
				unset($this->data['passwd']);
				if(self::DEBUG)	echo  "User::load_user() User Get\r\n";
				
				$strSql="SELECT b.name AS grupo , c.name AS modulo , c.file AS archivo , c.icono AS icono
						 FROM MODULES_PROFILES a , MODULES_GROUP b , MODULES c
						 where a.profileid = " . $this->data['profile'] ." and 
						 a.moduleid = c.id       and 
						 b.id     = c.id_group";
				
				if(self::DEBUG) echo  "User::load_user() strSQL[".$strSql."]\r\n";
				
				if ($this->tables=$db->executeSQL($strSql))
				{	
					if(self::DEBUG) echo  "User::load_user() Tables Get\r\n";
				}
				
				$strsql="SELECT count(*) cant FROM RECLAMOS_CERRADOS WHERE id_cliente= ". $this->data['id'] ." and  isread = 0 ";
				
				if ($this->unreadmessages=$db->executeSQL($strsql))
				{	
					if(self::DEBUG) echo  "User::load_user() unread mesages Get\r\n";
				}
				
				$strsql="SELECT file FROM DEFAULT_PAGE WHERE id_group= ". $this->data['profile'] ;
				
				if ($this->default_page=$db->executeSQL($strsql))
				{	
					if(self::DEBUG) echo  "User::load_user() Default Page Get\r\n";
				}
				
				
				
				$db->closeConnection();
				
				return true;
			}
			else
			{
				$db->closeConnection();
				$this->lastError='USER NOT FOUND';
				return false;
			}
			
		}
	}
	
	
	public function load_user_fb($usermail)
	{
		$db=new MySQL();
		
		if ($db->connected())
		{
			
			$strSql="SELECT * from CLIENT_USERS where email='".$usermail."'";
			
			if ($this->data=$db->executeSQL($strSql))
			{	 
				//Unset password for security
				$this->data['bday']= substr($this->data['bday'],8,2) .'/'. substr($this->data['bday'],5,2).'/'.substr($this->data['bday'],0,4);
				unset($this->data['passwd']);
				if(self::DEBUG)	echo  "User::load_user() User Get\r\n";
				
				$strSql="SELECT b.name AS grupo , c.name AS modulo , c.file AS archivo , c.icono AS icono
						 FROM MODULES_PROFILES a , MODULES_GROUP b , MODULES c
						 where a.profileid = " . $this->data['profile'] ." and 
						 a.moduleid = c.id       and 
						 b.id     = c.id_group";
				
				 if(self::DEBUG) echo  "User::load_user() strSQL[".$strSql."]\r\n";
				
				if ($this->tables=$db->executeSQL($strSql))
				{	
					if(self::DEBUG) echo  "User::load_user() Tables Get\r\n";
				}
				
				$strsql="SELECT count(*) cant FROM RECLAMOS_CERRADOS WHERE id_cliente= ". $this->data['id'] ." and  isread = 0 ";
				
				if ($this->unreadmessages=$db->executeSQL($strsql))
				{	
					if(self::DEBUG) echo  "User::load_user() unread mesages Get\r\n";
				}
				
				
				$strsql="SELECT file FROM DEFAULT_PAGE WHERE id_group= ". $this->data['profile'] ;
				
				if ($this->default_page=$db->executeSQL($strsql))
				{	
					if(self::DEBUG) echo  "User::load_user() Default Page Get\r\n";
				}
				
				
				$db->closeConnection();
				
				return true;
			}
			else
			{
				$db->closeConnection();
				$this->lastError='USER NOT FOUND';
				return false;
			}
			
		}
	}
	
	
	
	public function get_data()
	{
		return $this->data;
	}
	
	public function get_tables()
	{
		return $this->tables;
	}
	
	public function get_unreadmessages()
	{
		return $this->unreadmessages;
	}

	public function isValid()
	{
		return $this->valid;
	}

	public function getDefaultPage()
	{
		return $this->default_page;
	}
	
	
}



	
?>