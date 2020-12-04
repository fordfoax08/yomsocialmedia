<?php 
require_once(dirname(dirname(__FILE__)).'/class/get_user_inf.php');
require_once(dirname(dirname(__FILE__)).'/class/crud_proc.php');
echo '<pre>';
var_dump($_POST);
echo '</pre>';
//Getting Data from Post
$fname = getPostData('f_name');
$lname = getPostData('l_name');
$uid = createUid($fname, $lname);
$aid = createAid();
$sid = createSessionid();
$commentId = createCommentId($fname,$lname);
$email = getPostData('user_email');
$pw = getPostData('user_pw');
$repw = getPostData('user_repw');
$Hpw = password_hash($pw, PASSWORD_DEFAULT);
$doby = getPostData('dob_y');
$dobm = getPostData('dob_m');
$dobd = getPostData('dob_d');
$dob = date('Y-m-d',strtotime("$doby-$dobm-$dobd", time()));
echo $doby;
/*Getting all data from db*/

/* Preparing data */
if(strlen($email) !== 0){
  $chkUserExist = new GetUser;
  $createNewUser = new Crud;
  if($chkUserExist->check_user_exist($email)){
    session_start();
    $_SESSION['err'] = "$email already Exist";
    echo 'User Exist!';
    /*header('Location: register.php');*/
    echo "<script>window.history.back();</script>";
  }else{
    echo $createNewUser->create_user($uid,$aid,$sid,$fname,$lname,$email,$Hpw,$dob,$commentId);
    header("Location: ../../reg_cont.php?sid=$sid&aid=$aid");
    /* echo "<script>window.location.href='../../login.php'</script>"; */
  }
}


function getPostData($pname){
  $pnameData = $_POST[$pname] ??= '';
  return trim($pnameData);
}
function createUid($fname, $lname){
  $a = strtoupper(substr($fname, 0, 1));
  $b = strtoupper(substr($lname,0 , 1));
  $c = time();
  $d = rand(100, 900);
  $uid = "$a$b-$c-$d";
  return $uid;
}
function createAid(){
  $a = time();
  $b = rand(100,999);
  return $a.$b;
}
function createSessionid(){
  $a = rand(100,999);
  $b = time();
  return $a.$b;
}
function createCommentId($fname,$lname){
  $a = strtoupper(substr($fname, 0, 1));
  $b = strtoupper(substr($lname, 0, 1));
  $c = rand(1000,9999);
  return "$a$b$c";
}

?>