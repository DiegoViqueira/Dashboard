<?php
/*  ---------------------------------------------------------
                  BD MYSQL WRAPPER Class
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/					   


/* Define configuration */
	define("DB_HOST", 'fojacerorockcomar820.ipagemysql.com');
	define("DB_USER", 'reclamos');
	define("DB_PASS", 'reclamos');
	define("DB_NAME", 'reclamos');
	define("_ENDL_", '<BR>');


	/* Database Wrapper Class */
class MySQL 
{
	/*Constant */
	const DEBUG = false; 
	/* Private Members */
    public  $lastError;         // Holds the last error
	public  $lastQuery;         // Holds the last query
	public  $result;            // Holds the MySQL query result
	public  $records;           // Holds the total number of records returned
	public  $affected;          // Holds the total number of records affected
	public  $rawResults;        // Holds raw 'arrayed' results
	public  $arrayedResult;     // Holds an array of the result
	
	private $hostname;          // MySQL Hostname
	private $username;          // MySQL Username
	private $password;          // MySQL Password
	private $database;          // MySQL Database
	private $connected;         // MySQL Connection Status
	private $transactions;      // MySQL enable transactions
	
	private $databaseLink;      // Database Connection Link
	
	
	
	/* *******************
	 * Class Constructor *
	 * *******************/
	
	function __construct($autocommit = true)
	{
		$this->database = DB_NAME;
		$this->username = DB_USER;
		$this->password = DB_PASS;
		$this->hostname = DB_HOST;
		$this->connected=false;
		
		$this->Connect($autocommit);
	}
	
	/* *******************
	 * Class Destructor  *
	 * *******************/
	
	function __destruct(){
		
	}
	
	
	/* *******************
	 * Private Functions *
	 * *******************/
	
	// Connects class to database
	// $persistant (boolean) - Use persistant connection?
	private function Connect($persistant ){

		if(self::DEBUG) echo  "MySQL::Connect(".$persistant.")" . _ENDL_ ;
		$this->transactions=$persistant;
		$this->databaseLink = new mysqli($this->hostname, $this->username, $this->password,$this->database);
		
		if ( $this->databaseLink->connect_errno )
		{
				$this->lastError = "Falló la conexión a MySQL: (" . $this->databaseLink->connect_errno . ") " . $this->databaseLink->connect_error;
				$this->connected=false;
				if(self::DEBUG) echo  "MySQL::Connect(".$persistant.")". $this->lastError . _ENDL_ ;
		}
		else
		{
			if(!$persistant)
			{
				$this->databaseLink->autocommit(false);
				
			}	
			else
			{
				$this->databaseLink->autocommit(true);
				
			}
			$this->connected=true;
		}
		
		if(self::DEBUG) echo  "MySQL::Connect(".$persistant.") Connected." . _ENDL_ ;
		return $this->connected;
	}
	
	
	// Performs a 'mysql_real_escape_string' on the entire array/string
	private function SecureData($data, $types=array()){
		if(is_array($data)){
            $i = 0;
			foreach($data as $key=>$val){
				if(!is_array($data[$key])){
                    $data[$key] = $this->CleanData($data[$key], $types[$i]);
					$data[$key] = mysql_real_escape_string($data[$key], $this->databaseLink);
                    $i++;
				}
			}
		}else{
            $data = $this->CleanData($data, $types);
			$data = mysql_real_escape_string($data, $this->databaseLink);
		}
		return $data;
	}
    
    // clean the variable with given types
    // possible types: none, str, int, float, bool, datetime, ts2dt (given timestamp convert to mysql datetime)
    // bonus types: hexcolor, email
    private function CleanData($data, $type = ''){
        switch($type) {
            case 'none':
				// useless do not reaffect just do nothing
                //$data = $data;
                break;
            case 'str':
            case 'string':
                settype( $data, 'string');
                break;
            case 'int':
            case 'integer':
                settype( $data, 'integer');
                break;
            case 'float':
                settype( $data, 'float');
                break;
            case 'bool':
            case 'boolean':
                settype( $data, 'boolean');
                break;
            // Y-m-d H:i:s
            // 2014-01-01 12:30:30
            case 'datetime':
                $data = trim( $data );
                $data = preg_replace('/[^\d\-: ]/i', '', $data);
                preg_match( '/^([\d]{4}-[\d]{2}-[\d]{2} [\d]{2}:[\d]{2}:[\d]{2})$/', $data, $matches );
                $data = $matches[1];
                break;
            case 'ts2dt':
                settype( $data, 'integer');
                $data = date('Y-m-d H:i:s', $data);
                break;
            // bonus types
            case 'hexcolor':
                preg_match( '/(#[0-9abcdef]{6})/i', $data, $matches );
                $data = $matches[1];
                break;
            case 'email':
                $data = filter_var($data, FILTER_VALIDATE_EMAIL);
                break;
            default:
                break;
        }
        return $data;
    }
    /* ******************
     * Public Functions *
     * ******************/
	// check connection
	public function connected()
	{
		return $this->connected;
	}
	 
    // Executes MySQL query
	public function executeSQL($query){
		
		if(self::DEBUG) echo  "MySQL::executeSQL($query)" . _ENDL_ ;
        $this->lastQuery = $query;
		$this->result = $this->databaseLink->query($query);
        
		if($this->result)
		{
			if(self::DEBUG) echo  "MySQL::executeSQL(RESULT)"  . _ENDL_ ;
            
			
			$this->records  = $this->result->num_rows;
			$this->affected = $this->databaseLink->affected_rows;
			
            if($this->records > 0  ||  $this->affected > 0 )
			{
				if ( $this->records == 0 &&  $this->affected > 0 )
				{
					if(self::DEBUG) echo  "MySQL::executeSQL(RESULT) Record or Afected" . _ENDL_ ;
					return true;
				}
				else
				{
					if(self::DEBUG) echo  "MySQL::executeSQL(RESULT) Rows geted" . _ENDL_ ;
					$this->arrayResults();
					$this->result->free();
					return $this->arrayedResult;
				}
            }else
			{
				if(self::DEBUG) echo  "MySQL::executeSQL(RESULT) NO Record or Afected" . _ENDL_ ;
                return false;
            }
        }else{
			
            $this->lastError = mysql_error($this->databaseLink);
			if(self::DEBUG) echo  "MySQL::executeSQL(NORESULT):". $this->lastError. _ENDL_ ;
            return false;
        }
    }
	public function commit(){
		
		if(self::DEBUG) echo  "MySQL::commit().". _ENDL_ ;
		return  $this->databaseLink->commit();
	}
  
	public function rollback(){
		if(self::DEBUG) echo  "MySQL::rollback().". _ENDL_ ;
			return  $this->databaseLink->rollback();
	}
	
    // Adds a record to the database based on the array key names
    public function insert($table, $vars, $exclude = '', $datatypes=array()){
        // Catch Exclusions
        if($exclude == ''){
            $exclude = array();
        }
        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one
        // Prepare Variables
        $vars = $this->SecureData($vars, $datatypes);
        $query = "INSERT INTO `{$table}` SET ";
        foreach($vars as $key=>$value){
            if(in_array($key, $exclude)){
                continue;
            }
            $query .= "`{$key}` = '{$value}', ";
        }
        $query = trim($query, ', ');
        return $this->executeSQL($query);
    }
    // Deletes a record from the database
    public function delete($table, $where='', $limit='', $like=false, $wheretypes=array()){
        $query = "DELETE FROM `{$table}` WHERE ";
        if(is_array($where) && $where != ''){
            // Prepare Variables
            $where = $this->SecureData($where, $wheretypes);
            foreach($where as $key=>$value){
                if($like){
                    $query .= "`{$key}` LIKE '%{$value}%' AND ";
                }else{
                    $query .= "`{$key}` = '{$value}' AND ";
                }
            }
            $query = substr($query, 0, -5);
        }
        if($limit != ''){
            $query .= ' LIMIT ' . $limit;
        }
        return $this->executeSQL($query);
    }
    // Gets a single row from $from where $where is true
    public function select($from, $where='', $orderBy='', $limit='', $like=false, $operand='AND',$cols='*', $wheretypes=array()){
        // Catch Exceptions
        if(trim($from) == ''){
            return false;
        }
        $query = "SELECT {$cols} FROM `{$from}` WHERE ";
        if(is_array($where) && $where != ''){
            // Prepare Variables
            $where = $this->SecureData($where, $wheretypes);
            foreach($where as $key=>$value){
                if($like){
                    $query .= "`{$key}` LIKE '%{$value}%' {$operand} ";
                }else{
                    $query .= "`{$key}` = '{$value}' {$operand} ";
                }
            }
            $query = substr($query, 0, -(strlen($operand)+2));
        }else{
            $query = substr($query, 0, -6);
        }
        if($orderBy != ''){
            $query .= ' ORDER BY ' . $orderBy;
        }
        if($limit != ''){
            $query .= ' LIMIT ' . $limit;
        }
        $result = $this->executeSQL($query);
        if(is_array($result)) return $result;
        return array();
    }
    // Updates a record in the database based on WHERE
    public function update($table, $set, $where, $exclude = '', $datatypes=array(), $wheretypes=array()){
        // Catch Exceptions
        if(trim($table) == '' || !is_array($set) || !is_array($where)){
            return false;
        }
        if($exclude == ''){
            $exclude = array();
        }
        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one
        $set 	= $this->SecureData($set, $datatypes);
        $where 	= $this->SecureData($where,$wheretypes);
        // SET
        $query = "UPDATE `{$table}` SET ";
        foreach($set as $key=>$value){
            if(in_array($key, $exclude)){
                continue;
            }
            $query .= "`{$key}` = '{$value}', ";
        }
        $query = substr($query, 0, -2);
        // WHERE
        $query .= ' WHERE ';
        foreach($where as $key=>$value){
            $query .= "`{$key}` = '{$value}' AND ";
        }
        $query = substr($query, 0, -5);
        return $this->executeSQL($query);
    }
    // 'Arrays' a single result
    public function arrayResult()
	{
        $this->arrayedResult = $this->result->fetch_assoc();
        return $this->arrayedResult;
    }
    // 'Arrays' multiple result
    public function arrayResults(){
        if($this->records == 1){
            return $this->arrayResult();
        }
        $this->arrayedResult = array();
        while ($data = $this->result->fetch_assoc()){
            $this->arrayedResult[] = $data;
        }
        return $this->arrayedResult;
    }
    // 'Arrays' multiple results with a key
    public function arrayResultsWithKey($key='id'){
        if(isset($this->arrayedResult)){
            unset($this->arrayedResult);
        }
        $this->arrayedResult = array();
        while($row = $this->result->fetch_assoc()){
            foreach($row as $theKey => $theValue){
                $this->arrayedResult[$row[$key]][$theKey] = $theValue;
            }
        }
        return $this->arrayedResult;
    }
    // Returns last insert ID
    public function lastInsertID(){
        return $this->databaseLink->insert_id ;
    }
    // Return number of rows
    public function countRows($from, $where=''){
        $result = $this->select($from, $where, '', '', false, 'AND','count(*)');
        return $result["count(*)"];
    }


    // begin transaction
    public function begin()
	{
			
			if(self::DEBUG) echo  "MySQL::begin_transaction () Start Transaction." . _ENDL_ ;
			$strsql="BEGIN;";
			$result= $this->executeSQL($strsql);
			
			if ($result ==0)
				return true;
			else
				return $result;
				
			
	}
    // Closes the connections
    public function closeConnection(){
		
		
        if($this->databaseLink)
		{
			// Commit before closing just in case : in non persisten mode)
			if ($this->transactions)
					$this->commit();
			$this->databaseLink->close();
			$this->connected=false;
        }
		if(self::DEBUG) echo  "MySQL::closeConnection() Closed." . _ENDL_ ;
    }
	
}



	
?>