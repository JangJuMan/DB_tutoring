<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // 모든 게시글 불러오기 --> list 로 저장.
  $interesting_cnt = 0;
  $interesting_list = array();
  $load_all_interest = "SELECT * FROM $_SESSION[mypage_table] WHERE state != -1 AND user_id=$_SESSION[user_id] ORDER BY modify_time ";
  $result = $conn->query($load_all_interest);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($interesting_list, $row);
      $interesting_cnt++;
    }
  }
?>

<div class="w3-col m3">
  <!-- Profile -->
  <div class="w3-card w3-round w3-white">
    <div class="w3-container">
     <h4 class="w3-center">My Profile</h4>
     <p class="w3-center"><img src="<?php echo $_SESSION['user_img']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
     <hr>
     <p><i class="fas fa-pencil-alt fa-fw w3-margin-right w3-text-theme"></i><?php echo $_SESSION['user_name']?></p>
     <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['address']?></p>
     <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo $_SESSION['birth_year']?></p>
    </div>
  </div>
  <br>

  <!-- Accordion -->
  <div class="w3-card w3-round">
    <div class="w3-white">
      <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-thumbs-up w3-margin-right"></i> Likes</button>
      <div id="Demo1" class="w3-hide w3-container">
        <?php
        for($i=0; $i<$interesting_cnt; $i++){
          $j = $i+1;
          $interest_bbs_id = $interesting_list[$i]['interesting_tutoring'];
          $get_likes_info = "SELECT * FROM $_SESSION[bbs_table] WHERE bbs_Id=$interest_bbs_id AND state != -1";
          $likes_result = mysqli_query($conn, $get_likes_info);
          $like_info = mysqli_fetch_assoc($likes_result);
          echo '
          <p>'.$j.'. '.$like_info['title'].'</p>
          <hr>
          ';
        }
        ?>
      </div>

    </div>
  </div>
  <br>

  <!-- Alert Box -->
  <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
    <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
      <i class="fas fa-times"></i>
    </span>
    <?php
    // 모든 공지글 불러오기 --> list 로 저장.
    $notice_cnt = 0;
    $notice_list = array();
    $get_recent_notice = "SELECT * FROM $_SESSION[bbs_table] WHERE state = 1 ORDER BY bbs_Id";
    $notice_result = $conn->query($get_recent_notice);
    if($notice_result->num_rows > 0){
      while($row = $notice_result->fetch_assoc()){
        array_push($notice_list, $row);
        $notice_cnt++;
      }
    }
    ?>

    <p><strong><?php echo $notice_list[0]['title'] ?></strong></p>
    <p><?php echo $notice_list[0]['content'] ?></p>
  </div>

<!-- End Left Column -->
</div>

<?php $conn->close(); ?>
