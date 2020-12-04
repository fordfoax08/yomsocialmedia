<?php
require_once('WEB-INF/class/get_user_inf.php');
session_start();
if(!isset($_SESSION['s_id']) && !isset($_SESSION['a_id'])){
  header('Location: login.php');
}
$userDetails = [];
if(isset($_GET['g_aid'])){
  echo '<script>alert("G ID SELECTED");</script>';
}else{
  $aid = $_SESSION['a_id'];
  $conn = new GetUser;
  $conn->get_user_profile($aid);
  echo '<script>alert("MAIN is SELECTED");</script>';
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="src/css/profile.css">
</head>
<body>
  <section class="container1">
    <div class="user-pic">
      <img id="user-img" src="https://i.pravatar.cc/200" alt="ProfilePic" width="150">
    </div>
    <div class="u-name uh">
      <h3>Josiah Johansehn</h3>
      <h6>Philantrophist</h6>
    </div>
    <div class="u-name-1">
      <h6>Philiipine Island Parwood nigga</h6>
      <h6>9823499283</h6>
      <h6>hulahula.com</h6>
      <h6>sendmesomething@gmai.com</h6>
    </div>

    <div class="u-bio uh">
      <h4>BIO</h4>
    </div>
    <div class="u-bio-1">
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit architecto alias harum laudantium dignissimos adipisci voluptas mollitia error nesciunt eveniet?</p>
    </div>

    <div class="u-hobbies uh">
      <h4>Hobbies</h4>
    </div>
    <div class="u-hobbies-1 close">
      <ul>
        <li>Coding</li>
        <li>Basket Ball</li>
        <li>News</li>
      </ul>
    </div>

    <div class="u-skills uh">
      <h4>Skills</h4>
    </div>
    
  </section>
  <section class="container2">
    <div class="main-container">
      <div class="nav">
        <a href="index1.php">Home</a>
      </div>
      <div class="post-container">
        <form action="" method="post" class="form1">
          <input type="text" name="comment_title" id="comment_title" placeholder="Subject">
          <textarea name="comment_data" id="comment" cols="30" rows="3.90" placeholder="Write something..."></textarea>
          <div class="post-button">
            <!-- <div class="upload-btn">
              <input type="button" value="&plus;">
              <h5>Upload Image</h5>
            </div> -->
            <input type="file" name="user_photo_comment" id="photo-comment" >
            <input type="button" value="POST">
          </div>
        </form>
      </div>

      <div class="posted">
        <div class="post-head">
          <img class="p-image"src="https://i.pravatar.cc/200" alt="pp" width="45" height="45">
          <div class="p-name">
            <h3>Mark John Hue</h3>
            <h6>Separatist</h6>
          </div>
        </div>
        <div class="post-body">
          <h2 class="p-b-t">Philippine Arbitration Issue</h2>
          <p class="p-b-b">This might be Shocking but it seems like people like to justify Government's Inconsistency regarding the arbitration issue in WPS</p>
        </div>
      </div>

      <div class="posted">
        <div class="post-head">
          <img class="p-image"src="https://i.pravatar.cc/200" alt="pp" width="45" height="45">
          <div class="p-name">
            <h3>Mark John Hue</h3>
            <h6>Separatist</h6>
          </div>
        </div>
        <div class="post-body">
          <h2 class="p-b-t">Philippine Arbitration Issue</h2>
          <p class="p-b-b">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis accusamus necessitatibus error! Ullam nulla odio debitis doloribus, illo eos repellat dignissimos provident cumque qui veritatis velit exercitationem tenetur cupiditate soluta veniam numquam amet ratione. Voluptatem nihil perspiciatis odit corrupti voluptatibus?</p>
        </div>
      </div>

      <div class="posted">
        <div class="post-head">
          <img class="p-image"src="https://i.pravatar.cc/200" alt="pp" width="45" height="45">
          <div class="p-name">
            <h3>Mark John Hue</h3>
            <h6>Separatist</h6>
          </div>
        </div>
        <div class="post-body">
          <h2 class="p-b-t">Philippine Arbitration Issue</h2>
          <p class="p-b-b">This might be Shocking but it seems like people like to justify Government's Inconsistency regarding the arbitration issue in WPS</p>
        </div>
      </div>



    </div>

    <div class="add-container">
    </div>
  </section>












  <script>
    const hobbiesBtn = document.querySelector('.u-hobbies');
    const texta = document.querySelector('#comment');

    hobbiesBtn.addEventListener('click', showHobbies);
    texta.addEventListener('keyup', textComment);

    function showHobbies(e){
      if(!e.target.classList.contains('u-hobbies')) return;
      let hb = e.target.nextElementSibling;
      let ht = e.target.nextElementSibling.scrollHeight;
      if(hb.classList.contains('close')){
        hb.classList.remove('close');
        hb.style.height = ht + 'px';
      }else{
        hb.classList.add('close');
        hb.style.height = '0';
      }
      console.log(e.target.nextElementSibling.scrollHeight);
    }

    function textComment(e){
      let scrlH = texta.scrollHeight < 70 ? 70 : texta.scrollHeight ;
      if(scrlH <= 40){
        texta.style.height = '70px';
      }else{
        texta.style.height = scrlH +'px';
        if(texta.value === ''){
          texta.style.height = '70px';
        }
      }
      /* console.log(e.target.value);
      console.log(texta.value); */
    }

  </script>
</body>
</html>