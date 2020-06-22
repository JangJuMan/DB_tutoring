<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php
  session_start();
  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // load subjects
  $sub_cnt = 0;
  $sub_list = array();
  $load_all_sub = "SELECT * FROM $_SESSION[subject_table]";
  $sub_result = $conn->query($load_all_sub);
  if($sub_result->num_rows > 0){
    while($row = $sub_result->fetch_assoc()){
      array_push($sub_list, $row);
      $sub_cnt++;
    }
  }

  // load location
  $location_cnt = 0;
  $location_list = array();
  $load_all_location = "SELECT * FROM $_SESSION[location_table]";
  $location_result = $conn->query($load_all_location);
  if($location_result->num_rows > 0){
    while($row = $location_result->fetch_assoc()){
      array_push($location_list, $row);
      $location_cnt++;
    }
  }
?>


<div class="w3-col m9">
  <div class="w3-card w3-margin-left w3-row-padding w3-col m12">

    <div class="w3-container">
      <h2>튜터/튜티 구합니다 글쓰기 페이지</h2>
    </div>

    <form method="post" action="../dbConnection/dbConnection_tutor.php">
      <input type="hidden" name="writeType" value="tutorWriting">
      <input type="hidden" name="return_location" value="../pages/tutoring.php">
      <!-- <label>제목을 입력해주세요</label>
  <input class="w3-input" type="text"> -->

      <!-- <textarea rows="2" cols="55" name="contents">제목을 입력해 주세요. </textarea> -->

      <input name="title" class="comment-input form-element" type="text" placeholder="제목을 입력해주세요."> </input>

      <div class="filter">
        <div class="w3-col m12">
          <div class="w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Filter to Find</h6>
              <div class="check-box-container">
                <div>
                  <label class="check-box-label">월 </label> <input name="mon" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">화 </label> <input name="tue" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">수 </label> <input name="wed" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">목 </label> <input name="thr" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">금 </label> <input name="fri" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">토 </label> <input name="sat" class="check-box" type="checkbox" value="1" checked>
                  <label class="check-box-label">일 </label> <input name="sun" class="check-box" type="checkbox" value="1" checked>
                </div>
                <div class="check-box-container">
                  <label class="check-box-label">튜터링 종류: </label>

                  <select name="to_find_tutor" class="dropdown">
                    <option value="1" selected?>튜터를 구합니다.</option>
                    <option value="0">튜티를 구합니다.</option>
                  </select>

                  <label class="check-box-label">수업 과목: </label>

                  <select name="subject_name" class="dropdown" name="subject">
                    <!-- <option value=0 <?php if($_SESSION['subject'] == 0){echo "selected";}?>>상관없음</option> -->
                    <?php
                      for($i = 0; $i < $sub_cnt; $i++){
                      ?>
                    <option value=<?php echo $sub_list[$i]['sub_id'];?> <?php if($_SESSION['subject'] == $i+1){echo "selected";}?>><?php echo $sub_list[$i]['sub_name'];?>.</option>
                    <?php } ?>

                  </select>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--
  <div class="w3-container w3-card w3-round w3-margin review-user-info">
    <img src="<?php echo $_SESSION['user_img']?>" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity"> </span>
    <h4> 정한결</h4><br>
    <hr class="w3-clear">
    <div class="user-info">
      <li> 아래에 글을 입력해 주세요 </li>
      <li> 수능 영어 전문 과외 </li>
      <li> 영어 과외 경력 다수 (5회 이상) </li>
      <li> 즐겁게 영어 배우고 싶다면, 영어와 친해지고 싶다면 환영 </li>
    </div> -->


      <!-- <textarea rows="10" cols="60" name="contents">제목을 입력해 주세요.</textarea> -->

      <!-- <textarea rows="2" cols="35" name="contents">과외 시간을 입력해주세요. /1주일</textarea>
<textarea rows="2" cols="35" name="contents">과외 비용을 입력해주세요. /1시간</textarea> -->

      <input name="tutor_time" style="margin-top: 0.5em;" type="text" placeholder="과외 시간을 입력해주세요. /1주일." class="form-element" val/ue=""> </input>
      <input name="tutor_amount" type="text" placeholder="과외 비용을 입력해주세요. /1시간." class="form-element" val/ue=""> </input>

      <select name=location_name class="dropdown form-element" name="location">
        <?php
        for($i = 0; $i < $location_cnt; $i++){
        ?>
        <option value=<?php echo $location_list[$i]['l_id'];?>><?php echo $location_list[$i]['location'];?></option>
        <?php
        }?>

      </select>

      <input name="user_id" value="<?=$_SESSION['user_id']?>" type="hidden" />

      <!-- //글쓰기페이지 -->

      <textarea name="content" class="form-element" type="text" rows="13" cols="60"></textarea>



      <input type="submit" class="w3-button w3-border form-btn" value="글쓰기">
      <!-- <button class="w3-button w3-border form-btn">글 수정하기</button> -->
      <!-- <button class="w3-button w3-border form-btn">글 삭제하기</button> -->
      <button type="button" class="w3-button w3-border form-btn" onclick="location.href = '../pages/tutoring.php'">돌아가기</button>
    </form>
  </div>

</div>
<?php $conn->close();?>
