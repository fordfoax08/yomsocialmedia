<?php
require_once('../class/get_user_inf.php');
require_once('../class/crud_proc.php');
/* echo '<pre>';
var_dump($replyData);
echo '</pre>';
 cid = comment id */
$cid = getPostData('comment_id');
$user_cid = getPostData('user_comment_id');
$post_reply = getPostData('post_comment');
$reply_date = getPostData('reply_date');
/* prepare data to be inserted 
*  USER => [commentData : commentDate];
*/
$dataArray[$user_cid] = [$post_reply,$reply_date];
/* $data = json_encode($dataArray); */

/* Fetching /Getting all comment Replies */
$connGet = new GetUserComment;
$userReplies = $connGet->get_comment_replies($cid);
/* get comment_comments data (default string) decode if if data is existing if not set empty array */
$replyData = strlen($userReplies['comment_comments']) > 0?json_decode($userReplies['comment_comments'],true):[];


/* now appened / push data to replyData */
array_push($replyData,$dataArray);
/* now Update database insert data */
$connUpdate = new CrudComment;
$res = $connUpdate->post_reply($cid,json_encode($replyData));
/* BACK */
echo '<script>window.history.back();</script>';

/* 
echo $test; */


function getPostData($str){
  $data = $_POST[$str] ??= '';
  return htmlentities(trim($data));
}

?>