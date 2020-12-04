<?php

session_start();

if(isset($_SESSION['err'])){
  $err = $_SESSION['err'];
  echo "<script>alert('$err');</script>";
  session_destroy();
}
if(isset($_SESSION['s_id']) && $_SESSION['a_id']){
  header('Location: index1.php');
}


//echo $_SESSION['err'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    *{
      margin: 0;
      -moz-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }
    body{
      background-color: rgb(189, 204, 255);
    }

    header{
      height: 70px;
      background-color: rgb(0, 5, 36);
    }
  </style>
  <link rel="stylesheet" href="src/css/a1.css">
  <title>Login to My Book</title>
</head>
<body>
  <header>

  </header>
  <section class="container1">
    <div class="login-container">
      <div class="l-c1">
        <h2>Welcome to My Book</h2>
        <form id="form1" action="WEB-INF/process/log_in.php" method="post">
          <input type="email" name="user_email" placeholder="Email">
          <i class="material-icons u-n">perm_identity</i>
          <input type="password" name="user_pw" placeholder="Password">
          <i class="material-icons u-p">lock</i>
          <a href="forgot_pw.php" class="forgot">Forgot password?</a>
          <p class="not-reg">Not registered yet?</p>
          <div class="register">
            <a href="register.php">Sign Up</a>
          </div>
        </form>
      </div>
      <div class="l-c2">
        <input type="button" value="LOGIN">
      </div>
    </div>
  </section>

  <script>
    const btnSubmitLogin = document.querySelector('.l-c2');
    btnSubmitLogin.addEventListener('click', loginProc);
    function loginProc(){
      const form1 = document.querySelector('#form1');
      const email = document.querySelector('input[name="user_email"]');
      const pw = document.querySelector('input[name="user_pw"]');
      if(!isEmailValid(email.value)){
        alert('Invalid Email Address');
        return;
      }
      if(!isStringValid(pw.value)){
        alert('Invalid Password');
        return;
      }
      //if(confirm('Are you sure?')){
        form1.submit();
      //}
    }


    function isEmailValid(str){
      let regex = /^[A-Za-z0-9_.]{3,30}@[A-Za-z]{2,20}.[A-Za-z]{2,10}$/i;
      if(!regex.test(str)){
        return false;
      }
      return true;
    }

    function isStringValid(str){
      //let regex = /^[<>/]$/i;
      let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
      if(str.length <= 0){
        return false;
      }
      if(regex.test(str)){
        return false;
      }
      return true;
    }

  </script>
</body>
</html>