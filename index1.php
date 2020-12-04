<?php
require_once('WEB-INF/class/get_user_inf.php');
session_start();

if(!isset($_SESSION['s_id']) && !isset($_SESSION['a_id'])){
  header('Location: login.php');
}

/* GETTING USER DATA */
$userAccount = []; /* Get user's Name */
$userDetails = [];  /* Get user's Image */
if(isset($_SESSION['s_id']) && isset($_SESSION['a_id'])){
  $conn = new GetUser;
  $userAccount = $conn->get_user_by_aid($_SESSION['a_id']);
  $userDetails = $conn->get_user_profile($_SESSION['a_id']);
}



/* var_dump($userAccount); */
/* echo '<script>alert("'.$_SESSION['c_id'].'");</script>'; */
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="src/css/a2.css">
</head>
<body onload="<?php echo isset($_SESSION['err']) ? 'errAnimate()':'';?>">
  <header>
    <div class="main-menu">
      <div class="m-m-1">
        <a id="m-profile" href="profile.php">Profile</a>
        <a href="profile.php" id="m-bio">Bio</a>
      </div>
      <div class="m-m-2">
        <img class="profile-image"src="media/image/<?php echo $userDetails['user_image'] ??= 'notset.jpg';?>" alt="pp">
      </div>
      <div class="m-m-3">
        <a id="m-home" href="index1.php">Home</a>
        <a href="WEB-INF/process/log_out.php" id="m-logout">Logout</a>
      </div>
      <div class="m-m-4">
        <?php
          $fname = $userAccount['f_name'];
          $mname = $userAccount['m_name'] ??= '';
          $lname = $userAccount['l_name'];
          echo "$fname $mname $lname";
        ?>
      </div>
    </div>
  </header>








  <section class="container1">
    <div class="post-container">
      <?php
        /* GET COMMENTS OF all users */
        if(isset($_SESSION['s_id']) && isset($_SESSION['a_id'])){
          $conn = new GetUserComment;
          $conn2 = new GetUser;
          $allUserComments = $conn->get_all_comments();
          $allUserInfo = $conn2->get_all_user_profile();
          
          /* echo '<pre>';
          var_dump($allUserInfo[0]);
          echo '</pre>'; */
          /* foreach($allUserInfo as $user){ */
            foreach($allUserComments as $item){
      ?>
      <div class="post">
        <a class="post-menu" href="javascript:void(0)">
        <i class="material-icons">more</i>
          <div class="more">
            <a href="javascript:void(0)">Hide</a>
            <a href="javascript:void(0)">Block</a>
            <a href="javascript:void(0)">Report</a>
          </div>
        </a>
        <div class="post-head">
          <div class="p-image-container">
            <img class="p-image"src="media/image/<?php
              foreach($allUserInfo as $user){
                if($item['account_id'] === $user['account_id']){
                  echo $user['user_image'];
                }
              }
            ?>" alt="pp" >
            </div>
          <div class="p-name">
            <h3><a href="<?php echo $userAccount['account_id'] !== $item['account_id']? 'profile.php?user='.$item['account_id']:'profile.php';?>"><?php echo $item['comment_user'];?></a></h3>
            <h6><?php
              foreach($allUserInfo as $eachUser){
                if($item['account_id'] === $eachUser['account_id']){
                  echo $eachUser['user_title'];
                }
              }
            ?></h6>
          </div>
        </div>
        <div class="post-body">
          <h3 class="p-b-t"><?php echo $item['comment_title'];?></h3>
          <?php
            if(strlen($item['comment_image']) > 3){
              echo '
                <div class="p-comment-image">
                  <img src="media/image/post/'.$item['comment_image'].'"alt="post">
                </div>
              ';
            }
          ?>
          <p class="p-b-b"><?php echo nl2br($item['comment_body']);?></p>
        </div>

        <div class="post-footer">
          <div class="p-f-1">
            <form action="WEB-INF/process/like_post.php" method="post">
              <input type="hidden" name="c_id" value="<?php echo $item['comment_id'];?>">
              <input type="hidden" name="u_c_id" value="<?php echo $userAccount['user_comment_id'];?>">


              <a href="javascript:void(0)" class="support <?php 
                echo in_array($userAccount['user_comment_id'], json_decode($item['comment_likes'],true)) ?'true':'';
              ?>">
                &hearts;
              </a>
              <p class="likers">
                <?php echo count(is_array(json_decode($item['comment_likes'],true))?json_decode($item['comment_likes'],true):[]) !== 0 ? count(json_decode($item['comment_likes'],true)):'';?>
              </p>
            </form>
          </div>
          <div class="p-f-2">
            <input class="comment-btn" type="button" value="Comment">
          </div>
        </div>
        <!-- Post Comment -->
        <div class="comment-section">
          <form action="WEB-INF/process/reply_comment.php" method="post">
            <input type="hidden" name="comment_id" value="<?php echo $item['comment_id'];?>">
            <input type="hidden" name="user_comment_id" value="<?php echo $userAccount['user_comment_id'];?>">
            <input type="hidden" name="reply_date" value="<?php echo date('Y-m-d H:i:s');?>">
            <p class="reply-count">/255</p>
            <textarea name="post_comment" class="textarea-reply" cols="30" rows="1"></textarea>
            <div class="submit-comment">
              <input type="button" value="POST" class="post-comment-btn">
            </div>
          </form>
        </div>
        <!-- COMMENTS ***REMOVE OPEN**** -->
        <div class="comments">
          <a class="v-comments" href="javascript:void(0)">View all comments</a>
          
          <!-- REPLY AREA*****************************REMOVE OPEN**** -->
          <div class="replies">
            <?php 
              $getJsonComment = count($conn->get_comment_replies($item['comment_id'])) > 0 ? $conn->get_comment_replies($item['comment_id']):[];
              
              foreach($getJsonComment as $reply){
                if(strlen($reply) > 0){/* if $reply str is not empty */
                foreach(json_decode($reply,true) as $key => $reps){
                  $keyName = array_keys($reps);/* $keyName[0] = get user ucid */
                  $arrValue = array_values($reps);
                  /* Get user information through userCommentId */
                  $reply_userProfile = $conn2->get_user_account_and_profile($keyName[0]);
                  $fname = $reply_userProfile['f_name'];
                  $lname = $reply_userProfile['l_name'];
                  $repAccountId = $reply_userProfile['account_id'];
                  $image = $reply_userProfile['user_image'];
                  /* echo '<pre>';
                  var_dump($reply_userProfile['user_title']);
                  echo '</pre><br>'; */
            ?>
            <div class="user-replies">
              <?php 
                if($userAccount['user_comment_id'] === $keyName[0] || $item['account_id'] === $userAccount['account_id']){
              ?>
              <div class="delete-reply-container">
                <form action="WEB-INF/process/delete_reply.php" method="post">
                  <input type="hidden" name="comment_id" value="<?php echo $item['comment_id'];?>">
                  <input type="hidden" name="user_reply_id" value="<?php echo $keyName[0];?>">
                  <input type="hidden" name="reply_date" value="<?php echo $arrValue[0][1];?>">
                  <a href="javascript:void(0);" class="delete-reply">&times;</a>
                </form>
              </div>
              <?php };?>

              <div class="u-r-h">
                <div class="r-image-container">
                  <img class="r-image"src="media/image/<?php echo $image;?>" alt="pp">
                </div>
                <a href="profile.php?p=<?php echo $repAccountId;?>"><?php echo $fname.' '.$lname;?></a>
              </div>
              <div class="u-r-b">
                <p><?php echo nl2br($arrValue[0][0]);?></p>
              </div>
            </div>

                <?php }}};?>
          
            <!-- <div class="user-replies">
              <div class="u-r-h">
                <img class="r-image"src="https://i.pravatar.cc/50" alt="pp" width="30">
                <a href="view_user.php">Brian Glaslov Sanches</a>
              </div>
              <div class="u-r-b">
                <p>This is a test comment for edit option.</p>
              </div>
            </div> -->

          </div>

        </div>

      </div>
      <?php }}/* } */?>


    </div>
     
  </section>
  
  <div class="err-container" >
    <div class="err">
      <?php echo $_SESSION['err'] ??= '';
        unset($_SESSION['err']);
      ?>
    </div>
  </div>
  <script language="javascript" src="src/js/main.index.js"></script>
</body>
</html>