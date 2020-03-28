<?php
$fn =$_POST['fn'];
$ln =$_POST['ln'];
$gender =$_POST['gender'];
$em =$_POST['em'];

if (!empty($fn) || !empty($ln) || !empty($gender) || !empty($em)){
	$host ="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="18ce0a5";

    //connection

    $conn =new mysqli($host,$dbUsername,$dbPassword,$dbname);

    if(mysql_connect_error()){
    	die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
    	$SELECT= "SELECT email from 18ce081form Where email =? Limit 1";
    	$INSERT ="INSERT Into 18ce081form (fn,ln,gender,em) values (?,?,?,?)";

    	//prepare

    	$stmt =$conn->prepare($SELECT);
    	$stmt->bind_param("s",$em);
    	$stmt->execute();
    	$stmt->bind_result($em);
    	$stmt->store_result();
    	$rnum = $stmt->num_rows;

    	if($rnum==0){
    		$stmt->close();
    		$stmt = $conn->prepare($INSERT);
    		$stmt->bind_param($fn,$ln,$gender,$em);
    		$stmt->execute();
    		echo "New record inserted Successfully";
    	}
    	else{
    		echo"Someone already register using this email";
    	}
    	$stmt->close();
    	$conn->close();
    }

}

else{
	echo "All fields are required";
	die();

}

?>