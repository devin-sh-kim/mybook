<?

session_start();

if($_SESSION["_MONEYBOOK_IS_LOGIN"] == "YES"){
    $userId = $_SESSION["_MONEYBOOK_USER_ID"];
    $email = $_SESSION["_MONEYBOOK_EMAIL"];
    $username = $_SESSION["_MONEYBOOK_USERNAME"];
    
} else if ($_SESSION["_MONEYBOOK_IS_LOGIN"] == "FAIL"){
    header("Location: ".$ctx."loginPage/error");
    exit();
} else{
    header("Location: ".$ctx."loginPage");
    exit();
}

?>