<?
  include "../clases/db.class.php";

  $filename = $_FILES['file']['name'];
  $meta = $_POST;
  $response='';
  $destination = "../images/usersfotos/". $filename;
  if ( move_uploaded_file( $_FILES['file']['tmp_name'] , $destination ) )
  {
		//aCTUALIZO LAiMAGEN EN LA bd
  		$db=new MySQL();
		$img_file = "images/usersfotos/". $filename;
		if ($db->connected())
		{
			$strSql="UPDATE CLIENT_USERS set picture='".$img_file."' where email='".$meta['mail']."'";
			
			if ($db->executeSQL($strSql))
			{	
				echo "FILE OK";
			}
			else
			{
				echo "ERROR UPDATE DB";
			}
			
		}

		$db->closeConnection();
	  
	  
  }
  else
  {
	  
	  echo "FILE LOAD ERROR";
  }

?>