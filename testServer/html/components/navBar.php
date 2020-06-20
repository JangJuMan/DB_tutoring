<!-- Navbar -->
<?php session_start() ?>
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="main.php" class="w3-bar-item w3-button w3-padding-large <?php if($_SESSION['now'] == 'main'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>"><i class="fa fa-home w3-margin-right"></i>Home</a>
  <a href="notice.php" class="w3-bar-item w3-button w3-padding-large <?php if($_SESSION['now'] == 'notice'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>" title="News">공지글</a>
  <a href="qna.php" class="w3-bar-item w3-button w3-padding-large <?php if($_SESSION['now'] == 'qna'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>" title="Account Settings">Q & A</a>
  <a href="tutoring.php" class="w3-bar-item w3-button w3-padding-large <?php if($_SESSION['now'] == 'tutoring'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>" title="Messages">과외정보</a>
  <a href="login.php" class="w3-bar-item w3-button w3-padding-large <?php if($_SESSION['now'] == 'login'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>" title="Messages">로그아웃</a>
  <!-- <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">3</span></button>
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button">아마 알림기능이.. 있으려면 디비조금만 바꾸면 될거같긴 한데... ㅋㅋㅋㅋㅋ 하지말죠z </a>
    </div>
  </div> -->
  <a href="modify.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white <?php if($_SESSION['now'] == 'modify'){echo "w3-theme-d4";}else{echo "w3-hide-small w3-hover-white";}?>" title="My Account">
    <img src="<?php echo $_SESSION['user_img']?>" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Not used button</a>
  <a href="main.php" class="w3-bar-item w3-button w3-padding-large>" title="News">공지글</a>
  <a href="main.php" class="w3-bar-item w3-button w3-padding-large>" title="Account Settings">Q & A</a>
  <a href="main.php" class="w3-bar-item w3-button w3-padding-large>" title="Messages">과외정보</a>
</div>
