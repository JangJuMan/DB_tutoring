<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<?php session_start(); ?>

<div class="w3-col m3">
  <!-- Profile -->
  <div class="w3-card w3-round w3-white">
    <div class="w3-container">
     <h4 class="w3-center">My Profile</h4>
     <p class="w3-center"><img src="<?php echo $_SESSION['user_img']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
     <hr>
     <p><i class="fas fa-pencil-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['user_name']?></p>
     <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> DB.User.Location</p>
     <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> DB.User.birth_year</p>
    </div>
  </div>
  <br>

  <!-- Accordion -->
  <div class="w3-card w3-round">
    <div class="w3-white">
      <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> My Groups</button>
      <div id="Demo1" class="w3-hide w3-container">
        <p>Some text..</p>
      </div>
      <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
      <div id="Demo2" class="w3-hide w3-container">
        <p>Some other text..</p>
      </div>
      <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
      <div id="Demo3" class="w3-hide w3-container">
     <div class="w3-row-padding">
     <br>
       <div class="w3-half">
         <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
       <div class="w3-half">
         <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
       <div class="w3-half">
         <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
       <div class="w3-half">
         <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
       <div class="w3-half">
         <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
       <div class="w3-half">
         <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
       </div>
     </div>
      </div>
    </div>
  </div>
  <br>

  <!-- Interests -->
  <div class="w3-card w3-round w3-white w3-hide-small">
    <div class="w3-container">
      <p>Likes</p>
      <p>
        <span class="w3-tag w3-small w3-theme-d5">DB.interesting_Tutoring.tutoringID.title</span>
      </p>
    </div>
  </div>
  <br>

  <!-- Alert Box -->
  <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
      <i class="fas fa-times"></i>
    </span>
    <p><strong>DB.Notice.title</strong></p>
    <p>Alert Box입니다. 가장 최신 공지같은거 여기에 띄우면 될 듯 싶은데 </p>
  </div>

<!-- End Left Column -->
</div>
