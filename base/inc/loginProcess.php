<?

include( INCLUDE_DIR . 'commons/opendb.php');

session_start();

extract($_POST);

$sql = "SELECT id, email, username FROM users where email = '".$email."' AND password = password('".$password."')";


$result = $conn->query($sql);
	
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
	$userId = $row['id'];
	$username = $row['username'];

	$_SESSION["_MONEYBOOK_IS_LOGIN"] = "YES";
	$_SESSION["_MONEYBOOK_USER_ID"] = $userId;
	$_SESSION["_MONEYBOOK_EMAIL"] = $email;
	$_SESSION["_MONEYBOOK_USERNAME"] = $username;
	
}else{
    
    $_SESSION["_MONEYBOOK_IS_LOGIN"] = "FAIL";
    $_SESSION["_MONEYBOOK_USER_ID"] = "";
	$_SESSION["_MONEYBOOK_EMAIL"] = "";
	$_SESSION["_MONEYBOOK_USERNAME"] = "";
    
}

include( INCLUDE_DIR . 'commons/closedb.php');

header("Location: ".$ctx."dashboard");
exit();

?>
