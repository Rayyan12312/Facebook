<?php
include('connection.php');
include('login_signup.php');
?>
<html oncontextmenu="return false">

<head>
  <meta charset="utf-8">
  <title>Facebook - Log in or sign up</title>
  <link rel="icon" href="facebook.png">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class="upper-box">
    <div class="heading-box">
      <h1 class="heading1">facebook</h1>
    </div>
    <form class="" action="" method="post">
    <div class="EmailPhone-Box">
      <label class="email-label" aria-hidden="true">Email</label><br>
      <input class="email-input" type="email" name="email" required>
    </div>
    <div class="Password-Box">
      <label class="password-label">Password</label><br>
      <input class="password-input" type="password" name="pass" required><br>


      <a class="forget" href="#">Forgetten account?</a>

    </div>
    <div class="login-box">
      <button type="submit" name="login" class="log-in-button"> Log In</button>
    </div>

      </form>


      <?php if($msg3!="") { ?>
      <div class="already-box" style=" left:81%; bottom:15%;width:150px;">
        <p class="already-p">
        <?php echo $msg3; ?>
        </p>
      <?php } ?>
    </div>
  </div>
  <div class="middle-box">
    <div class="image-box">
      <p class="image-text">Facebook helps you connect and share with the people in your life.</p>
      <img class="image1" src="Image1.png" alt="image1">
    </div>
    <form class="" action="" method="post">
      <div class="Account-Info-Box">
        <h1 class="CA">Create an account</h1>
        <p class="p1">It's quick and easy.</p>
        <div class="Fname-Box">
          <input class="Fname" type="text" name="FirstName" value="" placeholder=" First name" required>
        </div>
        <div class="Sname-Box">
          <input class="Sname" type="text" name="LastName" value="" placeholder=" Surname" required>
        </div>
        <?php if($msg2!="") { ?>
        <div class="already-box" style="bottom: 76%; width:250px";>
          <p class="already-p">
          <?php echo $msg2; ?>
          </p>
        </div>
        <?php } ?>

        <div class="M-or-E-Box">
          <input class="M-or-E" type="email" name="email" value="" placeholder=" Email address" required>
        </div><br>
        <div class="New-Password-Box">
          <input class="New-Pass" type="password" name="Password" value="" placeholder=" New Password" minlength="6" required>
        </div>
        <div class="d">
          <label class="Date-label"><b>Date of birth</b></label><br>
        </div>
        <div class="Date-Box">
          <form class="date-form">
            <select class="Date-select" name="Day">
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
          </form>
        </div>
        <div class="Month-Box">
          <select class="Month-Select" name="Month">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>

        </div>
        <div class="Year-Box">

          <select class="Year-Select" name="Year">
            <option value="2020">2020</option>
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
        <div class="d">
          <label class="Gender-label"><b>Gender</b></label><br>
        </div>
        <div class="Gender-Box">

          <input type="radio" id="male" name="Gender" value="male" required>
          <label for="male">Male</label>
          <input type="radio" id="female" name="Gender" value="female" required>
          <label for="female">Female</label>
        </div>

        <div class="Term-and-Condition-Box">
          <p class="term-p">By clicking Sign Up, you agree to our <a class="A" href="#">Terms</a>, <a class="A" href="#">Data Policy</a> and <a class="A" href="#">Cookie Policy</a>. You may receive SMS notifications from us and can opt out at any
            time.
          </p>
        </div>
        <div class="Sign-Up-Box">
          <button class="sign-up" type="submit" name="save">Sign Up</button>
        </div>
        <?php if($msg!="") { ?>
        <div class="already-box">
          <p class="already-p">
          <?php echo $msg; ?>
          </p>
        <?php } ?>
    </form>
    </div>
  </div>
  </div>
  <div class="buttom-box">
    <div class="language-and-Media">
      <p class="L-and-M">
        <a class="M" href="#">English(UK)</a>
        <a class="M" href="#">اردو</a>
        <a class="M" href="#">پښتو</a>
        <a class="M" href="#">العربية</a>
        <a class="M" href="#">हिन्दी</a>
        <a class="M" href="#">ਪੰਜਾਬੀ</a>
        <a class="M" href="#">বাংলা</a>
        <a class="M" href="#">Deutsch</a>
        <a class="M" href="#">ગુજરાતી</a>
        <a class="M" href="#">فارسی</a>
        <a class="M" href="#">Español</a>
      </p>
      <a class="add" href="#">+</a>
      <hr>
      <p class="C">
        <a class="B" href="#">Sign_Up</a>
        <a class="B" href="#">Log_In</a>
        <a class="B" href="#">Messenger</a>
        <a class="B" href="#">Facebook_Lite</a>
        <a class="B" href="#">Watch_People</a>
        <a class="B" href="#">Pages</a>
        <a class="B" href="#">Page_categories</a>
        <a class="B" href="#">Places</a>
        <a class="B" href="#">Games</a>
        <a class="B" href="#">Locations</a>
        <a class="B" href="#">Marketplace</a>
        <a class="B" href="#">Facebook_Pay</a>
      </p>
      <p class="C">
        <a class="B" href="#">Groups</a>
        <a class="B" href="#">Oculus </a>
        <a class="B" href="#">Portal </a>
        <a class="B" href="#">Instagram</a>
        <a class="B" href="#">Local</a>
        <a class="B" href="#">Fundraisers</a>
        <a class="B" href="#">Services</a>
        <a class="B" href="#">About </a>
        <a class="B" href="#">Create_ad </a>
        <a class="B" href="#">Create_Page</a>
        <a class="B" href="#">Developers</a>
        <a class="B" href="#">Careers</a>
        <a class="B" href="#">Privacy</a>
        <a class="B" href="#">Cookies</a>
      </p>
      <p class="C">
        <a class="B" href="#">AdChoices</a>
        <a class="B" href="#">Terms</a>
        <a class="B" href="#">Help</a>
      </p><br>
      <p class="P">Facebook © 2020</p>
    </div>
  </div>


  <script>
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
  </script>



</body>

</html>
