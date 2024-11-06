

<?php 
	function OpenConn(){
    $c_host = "localhost";
    $c_uname = "root";
    $c_pass = "clashflash";

    $conn = new mysqli($c_host,$c_uname,$c_pass);
    if($conn->connect_error){
        die("connection failed". $conn->connect_error);
    }
    
    $dbname = "hostel_finder";
    $conn -> select_db($dbname);
    
    return $conn;
}

	
?>