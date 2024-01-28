<?PHP
if(!isset($_SESSION))
{
    session_start();
}
if ($_SESSION['ADMINUSERLOGGED'] != NULL){
    echo $_SESSION['ADMINUSERLOGGED'];
}

/*
IF (($_SESSION['ADMINUSERLOGGED'])==0)
{

 echo "<html><script language=\"javascript\">location.href='login.php'</script></html>";
} */
/*

$strSQL="select * from users where id = ".$_SESSION['ADMINUSERID']." and logged=1;";
$RSA = mysql_query($strSQL) or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysql_error());
if(mysql_num_rows($RSA)==0)
{
  header("Location: "."login.php");
}
$RSA=NULL;*/

?>

