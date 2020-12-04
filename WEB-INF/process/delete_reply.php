<?php
require_once('../class/get_user_inf.php');
require_once('../class/crud_proc.php');
session_start();
/* echo '<pre>';
var_dump($_POST);
echo '</pre>'; */
/* Getting All Post Data */
$comment_id = getPostData('comment_id');
$user_reply_id = getPostData('user_reply_id');
$reply_date = getPostData('reply_date');

/* Getting Reply Comment */
$connReply = new GetUserComment; 
$allReplyData = $connReply->get_comment_replies($comment_id);
$replies = json_decode($allReplyData['comment_comments'], true);
/* FILTER removed item === postData */
$newReplies = array_filter($replies, function($item) use($user_reply_id,$reply_date){
  if(!isset($item[$user_reply_id][1])){
    return $item;
  }else{
    return $item[$user_reply_id][1] !== $reply_date && key($item) === $user_reply_id;
  }
});

/* Jsonify */
/* Update replies from DB*/
$connDelete = new CrudComment;
$res = $connDelete->post_reply_delete($comment_id,json_encode(array_values($newReplies)));
if($res > 0){
  $_SESSION['err'] = 'Comment Deleted Successfully';
}else{
  $_SESSION['err'] = 'Deletetion Failed';
}

echo '<script>window.history.back();</script>';

/* echo $test; */
function getPostData($str){
  $data = $_POST[$str] ??= '';
  return $data;
}
?>