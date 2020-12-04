<?php
require_once('../class/crud_proc.php');
session_start();
//GET ALL DATA
$sid = getPostData('session_id');
$aid = getPostData('account_id');
$u_title = getPostData('user_title');
$u_address = getPostData('user_address');
$u_number = getPostData('user_number');
$u_email = getPostData('user_email');
$u_website = getPostData('user_website');
$u_bio = getPostData('user_bio');
$u_hobbies = getPostData('user_hobbies');
$u_skills = getPostData('user_skills');
//GET IMAGE DATA
$file = $_FILES['user_image'];
$imageName = $file['name'];
$extractName = explode('.',$imageName);
$getExtension = end($extractName);
$imageNewName = "$aid".'_'."$sid.$getExtension";
$imageTemp = $file['tmp_name'];
//Insert data into DB
if(strlen($sid) > 1){
  $conn = new Crud;
  $conn->create_profile($imageNewName,$aid,$sid,$u_title,$u_address,$u_number,$u_email,$u_website,$u_bio,$u_hobbies,$u_skills);  
  move_uploaded_file($imageTemp, '../../media/image/'.$imageNewName);
  $_SESSION['err'] = "Account Created";
}

/* echo '<pre>';
var_dump($u_skills);
echo '</pre>'; */
/* echo '<pre>';
var_dump($_FILES);
echo '</pre>'; */
//echo $test;



function getPostData($name){
  $data = $_POST[$name] ??= '';
  if(is_array($data)){
    return json_encode($data);
  }
  return trim(htmlentities($data));
}


header('Location: ../../login.php');
?>