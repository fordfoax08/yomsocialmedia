<?php
require_once('../class/get_user_inf.php');
session_start();
/* echo '<pre>';
var_dump($_POST);
echo '</pre>'; */
/* Declare all post Data */
$email = getPostData('user_email');
$pw = getPostData('user_pw');
/* get User data via email */
$conn = new GetUser;
$userData = $conn->get_one_user($email) ? $conn->get_one_user($email) : false;
/* Login check */
if($userData){
  if($userData['user_email'] === $email && password_verify($pw, $userData['user_pw'])){
    $sid = $userData['session_id'];
    $aid = $userData['account_id'];
    $cid = $userData['user_comment_id'];
    logSuccess($sid,$aid,$cid);
  }else{
    logFailed('Wrong Username or Password');
  }
}else{
  logFailed('No User Found');
}

header('Location: ../../login.php');

function getPostData($pname){
  $pnameData = $_POST[$pname] ??= '';
  return trim($pnameData);
}
function logSuccess($sid,$aid,$cid){
  $_SESSION['s_id'] = $sid;
  $_SESSION['a_id'] = $aid;
  $_SESSION['c_id'] = $cid;
  echo "<script>window.history.back();</script>";
}
function logFailed($msg){
  $_SESSION['err'] = $msg;
  echo "<script>window.history.back();</script>";
}

?>