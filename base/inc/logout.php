<?
session_start();

unset($_SESSION["_MONEYBOOK_IS_LOGIN"]);
unset($_SESSION["_MONEYBOOK_USER_ID"]);
unset($_SESSION["_MONEYBOOK_EMAIL"]);
unset($_SESSION["_MONEYBOOK_USERNAME"]);
header("Location: ".$ctx."loginPage");
exit();

?>