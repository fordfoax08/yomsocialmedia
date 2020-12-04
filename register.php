<?php

session_start();
if(isset($_SESSION['err'])){
  echo "<script>alert('".$_SESSION['err']."');</script>";
  session_destroy();
}
if(isset($_SESSION['s_id'])){
  header('Location: index1.php');
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="src/css/reg.css">
  <title>Sign Up for My Book</title>
</head>
<body>
  <header>
  </header>
  <section class="container1">
    <div class="sign-container">
      <div class="banner1">
        Sign Up
      </div>
      <form action="WEB-INF/process/sign_up.php" method="post" id="form1" class="form1">
        <div class="f-1">
          <div class="u-name">
            <input type="text" name="f_name" placeholder="First Name">
            <input type="text" name="l_name" placeholder="Last Name">
          </div>
          <h6>Date of Birth:</h6>
          <div class="u-dob">
            <select name="dob_m">
              <option value="1">Jan</option>
              <option value="2">Feb</option>
              <option value="3">Mar</option>
              <option value="4">Apr</option>
              <option value="5">May</option>
              <option value="6">Jun</option>
              <option value="7">Jul</option>
              <option value="8">Aug</option>
              <option value="9">Sep</option>
              <option value="10">Oct</option>
              <option value="11">Nov</option>
              <option value="12">Dec</option>
            </select>
            <select name="dob_d">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>
            <select name="dob_y">
              <option value="2019">2019</option>
              <option value="2018">2018</option>
              <option value="2017">2017</option>
              <option value="2016">2016</option>
              <option value="2015">2015</option>
              <option value="2014">2014</option>
              <option value="2013">2013</option>
              <option value="2012">2012</option>
              <option value="2011">2011</option>
              <option value="2010">2010</option>
              <option value="2009">2009</option>
              <option value="2008">2008</option>
              <option value="2007">2007</option>
              <option value="2006">2006</option>
              <option value="2005">2005</option>
              <option value="2004">2004</option>
              <option value="2003">2003</option>
              <option value="2002">2002</option>
              <option value="2001">2001</option>
              <option value="2000">2000</option>
              <option value="1999">1999</option>
              <option value="1998">1998</option>
              <option value="1997">1997</option>
              <option value="1996">1996</option>
              <option value="1995">1995</option>
              <option value="1994">1994</option>
              <option value="1993">1993</option>
              <option value="1992">1992</option>
              <option value="1991">1991</option>
              <option value="1990">1990</option>
              <option value="1989">1989</option>
              <option value="1988">1988</option>
              <option value="1987">1987</option>
              <option value="1986">1986</option>
              <option value="1985">1985</option>
              <option value="1984">1984</option>
              <option value="1983">1983</option>
              <option value="1982">1982</option>
              <option value="1981">1981</option>
              <option value="1980">1980</option>
              <option value="1979">1979</option>
              <option value="1978">1978</option>
              <option value="1977">1977</option>
              <option value="1976">1976</option>
              <option value="1975">1975</option>
              <option value="1974">1974</option>
              <option value="1973">1973</option>
              <option value="1972">1972</option>
              <option value="1971">1971</option>
              <option value="1970">1970</option>
              <option value="1969">1969</option>
              <option value="1968">1968</option>
              <option value="1967">1967</option>
              <option value="1966">1966</option>
              <option value="1965">1965</option>
              <option value="1964">1964</option>
              <option value="1963">1963</option>
              <option value="1962">1962</option>
              <option value="1961">1961</option>
              <option value="1960">1960</option>
              <option value="1959">1959</option>
              <option value="1958">1958</option>
              <option value="1957">1957</option>
              <option value="1956">1956</option>
              <option value="1955">1955</option>
              <option value="1954">1954</option>
              <option value="1953">1953</option>
              <option value="1952">1952</option>
              <option value="1951">1951</option>
              <option value="1950">1950</option>
              <option value="1949">1949</option>
              <option value="1948">1948</option>
              <option value="1947">1947</option>
              <option value="1946">1946</option>
              <option value="1945">1945</option>
              <option value="1944">1944</option>
              <option value="1943">1943</option>
              <option value="1942">1942</option>
              <option value="1941">1941</option>
              <option value="1940">1940</option>
              <option value="1939">1939</option>
              <option value="1938">1938</option>
              <option value="1937">1937</option>
              <option value="1936">1936</option>
              <option value="1935">1935</option>
              <option value="1934">1934</option>
              <option value="1933">1933</option>
              <option value="1932">1932</option>
              <option value="1931">1931</option>
              <option value="1930">1930</option>
              <option value="1929">1929</option>
              <option value="1928">1928</option>
              <option value="1927">1927</option>
              <option value="1926">1926</option>
              <option value="1925">1925</option>
              <option value="1924">1924</option>
              <option value="1923">1923</option>
              <option value="1922">1922</option>
              <option value="1921">1921</option>
              <option value="1920">1920</option>
              <option value="1919">1919</option>
              <option value="1918">1918</option>
              <option value="1917">1917</option>
              <option value="1916">1916</option>
              <option value="1915">1915</option>
              <option value="1914">1914</option>
              <option value="1913">1913</option>
              <option value="1912">1912</option>
              <option value="1911">1911</option>
              <option value="1910">1910</option>
              <option value="1909">1909</option>
              <option value="1908">1908</option>
              <option value="1907">1907</option>
              <option value="1906">1906</option>
              <option value="1905">1905</option>
            </select>
          </div>
  
          <div class="u-login">
            <input type="email" name="user_email" placeholder="Email-Address">
            <input type="password" name="user_pw" placeholder="Password">
            <input type="password" name="user_repw" placeholder="Re-Password">
          </div>
          
          <div class="u-submit">
            <input type="button" value="SIGNUP" id="signupBtn">
            <a href="login.php" id="LOGIN">Login</a>
          </div>
        </div>

      </form>
    </div>
  </section>

  <script>
    const signupBtn = document.querySelector('#signupBtn');
    signupBtn.addEventListener('click', submitSignup);
    function submitSignup(e){
      const fname = document.querySelector('input[name=f_name]');
      const lname = document.querySelector('input[name=l_name]');
      const email = document.querySelector('input[name=user_email]');
      const pw = document.querySelector('input[name=user_pw]');
      const repw = document.querySelector('input[name=user_repw]');
      
      /* checkLength(fname.value) && checkStrExp(fname.value) ? inputStyle(fname, 1) : inputStyle(fname, 0);
      checkLength(lname.value) && checkStrExp(lname.value) ? inputStyle(lname, 1) : inputStyle(lname, 0);
      checkLength(email.value) ? inputStyle(email, 1) : inputStyle(email, 0);
      checkLength(pw.value) ? inputStyle(pw, 1) : inputStyle(pw, 0);
      checkLength(repw.value) ? inputStyle(repw, 1) : inputStyle(repw, 0); */

      checkNames(fname.value) ? inputStyle(fname, 1) : inputStyle(fname, 0);
      checkNames(lname.value) ? inputStyle(lname, 1) : inputStyle(lname, 0);
      checkEmail(email.value) ? inputStyle(email, 1) : inputStyle(email, 0);
      checkPassword(pw.value, repw.value) ? inputStyle(pw, 1) : inputStyle(pw, 0); 
      checkPassword(pw.value, repw.value) ? inputStyle(repw, 1) : inputStyle(repw, 0); 
      
      if(!isStringValid(pw.value)){
        alert('HA! trying to insert JS?');
        return;
      }
      
      if(checkNames(fname.value) && checkNames(lname.value) &&  checkEmail(email.value) && checkPassword(pw.value, repw.value) && checkPassword(pw.value, repw.value)){
        e.target.parentNode.parentNode.parentNode.submit();
      }
      

    }

    function checkNames(str){
      if(!checkLength(str)){
        return false;
      }else{
        if(!checkStrExp(str)){
          return false;
        }else{
          return true;
        }
      }
    }

    function checkEmail(strmail){
      if(!checkLength(strmail)){
        return false;
      }else{
        if(!checkEmailstr(strmail)){
          return false;
        }else{
          return true;
        }
      }
    }
    function checkPassword(pw, repw){
      if(pw.length === 0 || repw.length === 0) return;
      if(pw === repw){
        return true;
      }else{
        return false;
      }
    }

    function checkLength(str){
      if(str.length <= 0){
        return false;
      }else{
        return true;
      }
    }
    function checkStrExp(str){
      let regex = /^[A-Za-z ]{1,50}$/i;
      if(!regex.test(str)){
        return false;
      }else{
        return true;
      }
    }
    function checkEmailstr(e){
      let regex = /^[A-Za-z0-9_.]{3,30}@[A-Za-z]{2,10}.[A-Za-z]{2,10}$/i;
      if(!regex.test(e)){
        return false;
      }else{
        return true;
      }
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

    function inputStyle(input,opt){
      if(opt !== 1){
        input.style.border = '1px solid red';
      }else{
        input.style.border = 'none';
        input.style.borderBottom = '2px solid #aaa';
      }
    }

    /* const showBtn = document.querySelector('.banner1');
    showBtn.addEventListener('click', showRegBtn);

    function showRegBtn(e){
      if(e.target.nextElementSibling.classList.contains('close')){
        e.target.nextElementSibling.classList.remove('close');
      }else{
        e.target.nextElementSibling.classList.add('close');
      }
      console.log(e.target.nextElementSibling);
    } */
  </script>
</body>
</html>