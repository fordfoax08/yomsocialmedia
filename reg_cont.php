<?php

session_start();
if(isset($_SESSION['errMsg'])){
  echo "<script>alert('".$_SESSION['errMsg']."');</script>";
  unset($_SESSION['errMsg']);
  /* session_destroy(); */
}
if(!isset($_GET['aid'])){
  $_SESSION['err'] = 'Sign Up first';
  header('Location: register.php');
}


/* if(isset($_SESSION['s_id'])){
  header('Location: index1.php');
} */



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/reg_cont.css">
  <title>Profile Details</title>
</head>
<body>
  <header>
  </header>
  <section class="container1">
    <div class="form-container">
      <form action="WEB-INF/process/profile_update.php" method="post" enctype="multipart/form-data">
        <div class="profile-img">
          <div class="samp">
            <img src="media/image/profile/profileplaceholder.png" alt="Profile" width="200" id="profile-image">
          </div>
        </div>
        <div class="upload-img">
          <input type="file" name="user_image" accept="image/*" id="upload-img">
        </div>
        <div class="user-title">
          <input type="text" name="user_title" id="user_title" placeholder="Title">
        </div>
        <div class="user-contacts">
          <h2>Basic Contact</h2>
          <input type="text" name="user_address" placeholder="Address">
          <input type="text" name="user_number" placeholder="Contact No.">
          <input type="email" name="user_email" placeholder="E-mail">
          <input type="text" name="user_website" placeholder="Website">
          <input type="hidden" name="account_id" value="<?php echo $_GET['aid'] ??= null;?>">
          <input type="hidden" name="session_id" value="<?php echo $_GET['sid'] ??= null;?>">
        </div>
        <div class="user-bio">
          <h2>Bio</h2>
          <textarea id="user_bio" name="user_bio" cols="20" rows="10" placeholder="About you/Quotes"></textarea>
        </div>
        <div class="user-hobbies">
          <h2>Hobbies</h2>
          <!-- <input type="text" name="user_hobbies" placeholder="Hobby" class="usrhb"> -->
          <div class="add-hobbies">
            <input type="button" value="&plus;" id="addHobby">
            <h5>Add Hobby</h5>
          </div>
        </div>
        <div class="user-skills">
          <h2>Skills</h2>
          <!-- <input type="text" name="user_skills">
          <input type="text" name="user_skills"> -->
          <div class="add-skills">
            <input type="button" value="&plus;" id="addSkills">
            <h5>Add Skills</h5>
          </div>
        </div>

        <div class="upload-submit">
          <input type="button" value="UPLOAD" id="submit-btn">
        </div>
      </form>
    </div>
  </section>

  <script language="javascript" src="src/js/reg_cont.js"></script>
  <script>
  </script>
</body>
</html>