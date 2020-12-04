<?php
require_once('../class/crud_proc.php');
session_start();
/* echo '<pre>';
var_dump($_POST);
echo '</pre>'; */

$sid = getPostData('session_id');
$aid = getPostData('account_id');
$cid = getPostData('comment_id');
$c_title = getPostData('comment_title');
$c_data = getPostData('comment_data');
$c_img = getPostData('comment_image');
$c_img_del = intval(getPostData('comment_img_delete'));



/* IMAGE FILE seT Up */
$file = $_FILES['user_photo_comment'];
$fileImageName = '';
$fileTemp = $file['tmp_name'];
/* Check if Image is Valid */
if(isValidImage($file)){
  $fileImageName = getImageName($file,$cid);
  echo 'Valid '.$fileImageName.' <br/>';
}
$imgErr = strlen($fileImageName) > 0 ? true : false;

/* echo $aid.'<br>';
var_dump($imgErr);
var_dump($fileImageName); */


if($imgErr){
  if(is_file('../../media/image/post/'.$c_img)){
    unlink('../../media/image/post/'.$c_img);
  }
  if(strlen($aid) > 0){
    $conn = new CrudComment;
    $res = $conn->updatePost($aid,$cid,$c_title,$c_data,$fileImageName,date('Y-m-d H:i:s'));
    if($res > 0){
      echo 'Updated';
      move_uploaded_file($fileTemp,'../../media/image/post/'.$fileImageName);
    }
    else{
      echo 'Failed Updating';
    }
  }
  $_SESSION['err'] = 'Post Updated';
}else{
  if($c_img_del > 0){
    if(is_file('../../media/image/post/'.$c_img)){
      unlink('../../media/image/post/'.$c_img);
    }
    if(strlen($aid) > 0){
      $conn = new CrudComment;
      $res = $conn->updatePost($aid,$cid,$c_title,$c_data,null,date('Y-m-d H:i:s'));
      if($res > 0){
        echo 'Updated deleted Image';
        move_uploaded_file($fileTemp,$fileImageName);
      }
      else{
        echo 'Failed deleting Image something went wrong';
      }
    }
  }else{
      if(strlen($aid) > 0){
        $conn = new CrudComment;
        $res = $conn->updatePost($aid,$cid,$c_title,$c_data,$c_img,date('Y-m-d H:i:s'));
        if($res > 0){
          echo 'Updated SUCCESSSSSSSSSSSSSSSS';
          move_uploaded_file($fileTemp,$fileImageName);
        }
        else{
          echo 'FAILEEEEEEEED';
        }
      }
  }
  $_SESSION['err'] = 'Post Updated';
}


header('Location: ../../profile.php');



//Function to get post data
function getPostData($post){
  $data = $_POST[$post] ??= '';
  return htmlentities($data);
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