<?php
require_once('WEB-INF/class/get_user_inf.php');
session_start();
if(!isset($_SESSION['s_id']) && !isset($_SESSION['a_id'])){
  header('Location: login.php');
}
$userDetails = [];
$userName = [];
if(isset($_GET['g_aid'])){
  $aid = $_GET['g_aid'];
  $conn = new GetUser;
  $userDetails = $conn->get_user_profile($aid);
  $userName = $conn->get_user_by_aid($aid);
  echo '<script>alert("G ID SELECTED");</script>';
}else{
  $aid = $_SESSION['a_id'];
  $conn = new GetUser;
  $userDetails = $conn->get_user_profile($aid);
  $userName = $conn->get_user_by_aid($aid);
}
$fullName = $userName['f_name'].' '.$userName['l_name'];
  
/* If users hasnt set their iformation redirect to registe continue*/
if(!$userDetails && isset($_SESSION['s_id'])){
  $_SESSION['errMsg'] = 'Complete Additional Information';
  header('Location: reg_cont.php?sid='.$_SESSION['s_id'].'&aid='.$_SESSION['a_id']);
  //echo '<script>window.location.href="reg_cont.php?sid='.$_SESSION['s_id'].'&aid='.$_SESSION['a_id'].'";</script>';
}

/* FOR UPDATING POST */
$postToUpdate = [];
if(isset($_GET['cedit'])){
  $conn = new GetUserComment;
  $postToUpdate = $conn->get_one_post($_GET['cedit']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="src/css/profile.css">
</head>
<body onload="<?php echo isset($_SESSION['err']) ? 'msgPop()': '';?>">
  <section class="container1">
    <div class="user-pic">
      <div class="image-container">
        <img id="user-img" src="media/image/<?php echo $userDetails['user_image'];?>" alt="ProfilePic">
      </div>
    </div>
    <div class="u-name uh">
      <h3><?php echo $fullName?></h3>
      <h6><?php echo $userDetails['user_title'];?></h6>
    </div>
    <div class="u-name-1">
      <h6><?php echo $userDetails['user_address'];?></h6>
      <h6><?php echo $userDetails['user_number'];?></h6>
      <h6><?php echo $userDetails['user_email'];?></h6>
      <h6><a href="<?php echo $userDetails['user_website'];?>"><?php echo $userDetails['user_website'];?></a></h6>
    </div>

    <div class="u-bio uh">
      <h4>BIO</h4>
    </div>
    <div class="u-bio-1">
      <p><?php echo $userDetails['user_bio'];?></p>
    </div>

    <div class="u-hobbies uh">
      <h4>Hobbies</h4>
    </div>
    <div class="u-hobbies-1 close">
      <ul>
        <?php 
          $hb = json_decode($userDetails['user_hobbies'], true);
          foreach($hb as $item){
        ?>
        <li><?php echo $item;?></li>
        <!-- <li>Coding</li>
        <li>Basket Ball</li>
        <li>News</li> -->
        <?php }?>
      </ul>
    </div>

    <div class="u-skills uh">
      <h4>Skills</h4>
    </div>
    <div class="u-skills-1 close">
      <ul>
        <?php 
          $hb = json_decode($userDetails['user_skills'], true);
          foreach($hb as $item){
        ?>
        <li><?php echo $item;?></li>
        <!-- <li>Coding</li>
        <li>Basket Ball</li>
        <li>News</li> -->
        <?php }?>
      </ul>
    </div>
  </section>


  <section class="container2">
    <div class="main-container">
      <div class="nav">
        <!-- <a href="index1.php">Home</a> -->
        <header>
          <div class="main-menu">
            <div class="m-m-1">
              <a id="m-profile" href="profile.php">Profile</a>
              <a href="profile.php" id="m-bio">Bio</a>
            </div>
            <!-- <div class="m-m-2">
              <img class="profile-image"src="https://i.pravatar.cc/300" alt="pp" width="20">
            </div> -->
            <div class="m-m-3">
              <a id="m-home" href="index1.php">Home</a>
              <a href="WEB-INF/process/log_out.php" id="m-logout">Logout</a>
            </div>
            
          </div>
        </header>
      </div>
      <div class="post-container">
        <form action="WEB-INF/process/post_comment.php" method="post" class="form1" enctype="multipart/form-data">
          <input type="text" name="comment_title" id="comment_title" placeholder="Subject">
          <input type="hidden" name="session_id" value="<?php echo $_SESSION['s_id'];?>">
          <input type="hidden" name="account_id" value="<?php echo $_SESSION['a_id'];?>">
          <input type="hidden" name="user_full_name" value="<?php echo $fullName;?>">
          <input type="hidden" name="user_comment_id" value="<?php echo $_SESSION['c_id'];?>">
          <textarea name="comment_data" id="comment" cols="30" rows="3.90" placeholder="Write something..."></textarea>
          <div class="post-button">
            <input type="file" name="user_photo_comment" id="photo-comment" >
            <input type="button" value="POST" id="post-btn">
          </div>
        </form>
      </div>

      
        
      <!-- DISPLAY ALL USERs COMMENTS -->
      <?php
        $connComment = new GetUserComment;
        $comments = $connComment->get_user_comments($_SESSION['a_id']);
        if(count($comments) > 0){
          foreach($comments as $item){
      ?>
        <div class="posted">
          <a class="post-menu" href="javascript:void(0)">
            <i class="material-icons">more</i>
            <div class="more">
              <a href="profile.php?cedit=<?php echo $item['comment_id'];?>">Edit</a>
              <form action="WEB-INF/process/delete_comment.php" method="post">
                <input type="hidden" name="account_id" value="<?php echo $_SESSION['a_id'];?>">
                <input type="hidden" name="comment_id" value="<?php echo $item['comment_id'];?>">
                <a class="delete-comment" href="javascript:void(0)">Delete</a>
              </form>
            </div>
          </a>
          <div class="post-head">
            <div class="p-image-container">
              <img class="p-image"src="media/image/<?php echo $userDetails['user_image'];?>" alt="pp">
            </div>
            <div class="p-name">
              <h3><?php echo $fullName?></h3>
              <h6><?php echo $userDetails['user_title'];?></h6>
            </div>
            <div class="p-date">
              <p class="com-date"><?php 
                  $time = strtotime($item['comment_date']);
                  echo date('h:i A, d-M-y',$time);
                  /* echo $item['comment_date']; */
                ?></p>
                <p class="com-edited-date">
                  <?php echo strlen($item['comment_updated_date']) > 0 ?date('d-M-y',strtotime($item['comment_updated_date'])).' (Edited)':'';?>
               <!--  (EDITED 31 Dec 2020 ) -->
                </p>
            </div>
          </div>
          <div class="post-body">
            <h2 class="p-b-t"><?php echo $item['comment_title'];?></h2>
            <?php 
            if(strlen($item['comment_image']) > 0){
              echo '<div class="c-image-container">
                      <img src="media/image/post/'.$item['comment_image'].'" alt="Photo" class="c-image">
                    </div>';
            }
            ?>
            <p class="p-b-b"><?php echo nl2br($item['comment_body']);?></p>
          </div>
        </div>
      <?php
          }
        }
      ?>
     
            
      <div class="message close" >
        <div class="action-message">
            <?php echo $_SESSION['err'];
              unset($_SESSION['err']);
            ?>
        </div>
      </div>

      

    </div>

    <div class="add-container">
            
    </div>

    
    
  </section>
  <!-- END OF SECTION 2 -->


  <section class="container3 <?php echo !isset($_GET['cedit']) ? 'close' : ' ' ;?>">
    <div class="update-container">
        <div class="close-update">
          &times;
        </div>
        
        <form action="WEB-INF/process/update_comment.php" method="post" class="form2" enctype="multipart/form-data">
          <input type="text" name="comment_title" id="update_title" value="<?php echo $postToUpdate['comment_title'];?>" placeholder="Subject">
          <input type="hidden" name="session_id" value="<?php echo $_SESSION['s_id'];?>">
          <input type="hidden" name="account_id" value="<?php echo $_SESSION['a_id'];?>">
          <input type="hidden" name="comment_id" value="<?php echo $postToUpdate['comment_id'];?>">
          <input type="hidden" name="comment_image" value="<?php echo $postToUpdate['comment_image'];?>">
          <input type="hidden" name="comment_img_delete">
          <div class="update-image-container <?php echo strlen($postToUpdate['comment_image']) > 0 ?' ':'close';?>">
            <?php echo '<img src="media/image/post/'.$postToUpdate['comment_image'].'" alt="update image">';?>
            <!-- <img src="media/image/post/<?php echo $postToUpdate['comment_image'];?>" alt="update image"> -->
            <input type="button" value="remove image" id="del-img-btn">
          </div>
          <textarea name="comment_data" id="upload-comment" cols="30" rows="3.90" placeholder="Write something..."><?php echo $postToUpdate['comment_body'];?></textarea>
          <div class="post-button">
            <input type="file" name="user_photo_comment" id="photo-comment" >
            <input type="button" value="UPDATE" id="update-btn">
          </div>
        </form>
        
    </div>
  </section>


    <?php
    /* echo '<pre>';
    var_dump($postToUpdate);
    echo '</pre>'; */
    ?>

  <script language="javascript" src="src/js/profile.js"></script>
  <script>

  </script>
  
</body>
</html>