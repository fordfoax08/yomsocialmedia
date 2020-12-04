<?php
require_once('../class/crud_proc.php');
session_start();
echo '<pre>';
var_dump($_FILES);
echo '</pre>';


$c_id = commentId();
$s_id = getPostData('session_id');
$a_id = getPostData('account_id');
$c_user = getPostData('user_full_name');
$c_title = getPostData('comment_title');
$c_body = getPostData('comment_data');
$c_date = date('Y-m-d H:i:s');
/* IMAGE FILE seT Up */
$file = $_FILES['user_photo_comment'];
$fileImageName = '';
$fileTemp = $file['tmp_name'];
/* Check if Image is Valid */
if(isValidImage($file)){
  $fileImageName = getImageName($file,$c_id);
  echo 'Valid '.$fileImageName.' <br/>';
}
$imgErr = strlen($fileImageName) > 0 ? true : false;

var_dump($imgErr);
var_dump($fileImageName);


if(isset($s_id)){
  $conn = new CrudComment;
  $res = $conn->newPost($c_id,$s_id,$a_id,$c_user,$c_title,$c_body,$c_date,$fileImageName);
  if($res === 0){
    $_SESSION['err'] = 'Post Failed';
  }
  if($imgErr){
    move_uploaded_file($fileTemp,'../../media/image/post/'.$fileImageName);
    echo 'MOVED';
  }
  $_SESSION['err'] = 'POSTED';
  /* echo '<script>window.history.back();</script>'; */
}
header('Location: ../../profile.php');




//echo $test;

function getPostData($post){
  $data = $_POST[$post] ??= '';
  return htmlentities($data);
}

function commentId(){
  $a = rand(100,999);
  $b = time();
  return $a.$b;
}

//GET IMAGE INFORMATION


function isValidImage($img){
  if(strlen($img['name']) > 200 || strlen($img['name']) <= 0){
    return false;
  }
  if($img['size'] > 10000000 || $img['size'] < 1){
    return false; 
  }
  //Extract image info
  $ext = pathinfo($img['name'],PATHINFO_EXTENSION);
  $arr = ['jpg','jpeg','png','gif'];
  if(!in_array($ext, $arr)){
    return false;
  }
  return true;
}

function getImageName($file,$name){
  $ext = pathinfo($file['name'],PATHINFO_EXTENSION);
  return "$name.$ext";
}


?>