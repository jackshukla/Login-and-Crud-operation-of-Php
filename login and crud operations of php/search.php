<?php
require_once "functions.php";
if( isset($_POST["submit"]))
  {
     if(!empty($_POST["text"]))
	  {
		 $conn = mysqli_connect("localhost","root","","adminform");
         if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
		$c= $_POST["text"];
		$stmt = $db->prepare('SELECT * FROM users where first_name=?');
		$stmt->bind_param("i", $c);
		$stmt->execute();
		$stmt->bind_result($id, $first_name, $last_name,$contact_no);
		print '<table border="1">';
		
		while($stmt->fetch()) {  
		while($stmt->fetch()) {
	    print '<tr>';
    	print '<td>'.$id.'</td>';
	    print '<td>'.$first_name.'</td>';
    	print '<td>'.$last_name.'</td>';
	    print '<td>'.$contact_no.'</td>';
    	print '</tr>';
		}   
		print '</table>';
		$stmt->close();
		  }		
		}
		else
	 	{
		$flag=true;
	 	}
}
?>