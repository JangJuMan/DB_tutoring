<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // 모든 게시글 불러오기 --> list 로 저장.
  $user_cnt = 0;
  $user_list = array();  // 배열 이름 ( 배열 접근 시 사용 )= 배열 생성
  $load_all_user = "SELECT * FROM $_SESSION[user_table] WHERE is_tutor != -1"; // 모든 컬럼 조회
  $result = $conn->query($load_all_user);  // (sql) 쿼리 날리는 방법
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){ // mysqli_fetch_assoc 함수는 mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
      array_push($user_list, $row); // 어레이에 넣어주는 함수
      $user_cnt++; // 어레이에 있는 숫자 만큼 count 를 해줌
    }
  }else{
    echo "user list --> 0 result";
  }

?>

<!-- 여기까지 유저 정보 리스트에 저장 -->
<?php

$writer_id = 3;
$get_writer_info = "SELECT * FROM $_SESSION[user_table] WHERE user_id='$writer_id'";
$result = mysqli_query($conn, $get_writer_info);  // 쿼리 날려서 담아
$writer_info = mysqli_fetch_assoc($result); //  mysqli_fetch_assoc 함수는 mysqli_query 를 통해 얻은 리절트 셋(result set)에서 레코드를 1개씩 리턴해주는 함수입니다.
// 여기서는 writer id 를 가진 애의정보만 넣어 주겠지



?>


<div class="w3-col m9">
  <div class="w3-container w3-card w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"><br>
    <div class="w3-container w3-padding">
      <div class="w3-col m12">
        <p style= "text-align: right">

          <button type="button" class="w3-button w3-theme write-btn" onclick="location.href=">수정하기</button>
          <h4 class="w3-center"><b>Profile</b></h4>
        </p>
        <p class="w3-center"><img src="<?php echo $_SESSION['user_img']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>

        <hr class="two">
        <p style= "text-align: left">
          <div style="padding:40px;">
            <div class="w3-container w3-padding">
              <div class="w3-container w3-padding">

                <p><option value=1> 이름: <?php echo $writer_info['name']; ?> </option></p>
                <p><option value=1> <b>성별:</b> <?php echo $writer_info['gender']; ?></option></p>
                <p><option value=2> <b>나이:</b> <?php echo $writer_info['birth_year']; ?></option></p>
                <!-- <p><option value=3> <b>과외경력:</b>  echo $user_list[1]['name']; ?></option></p> -->
                <p><option value=4> <b>학교:</b> <?php echo $writer_info['address']; ?> </option></p>
                <p><option value=5> <b>토플/토익 점수:</b>  </option></p>
                <p><option value=6> <b>e-mail:</b> <?php echo $writer_info['email']; ?> </option></p>

              </div>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>



<!— End Middle Column —>
</div>
