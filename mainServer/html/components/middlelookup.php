<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }


?>

<!-- 여기까지 유저 정보 리스트에 저장 -->
<?php
// User
$writer_id = $_SESSION['lookup_id'];
$get_writer_info = "SELECT * FROM $_SESSION[user_table] WHERE user_id='$writer_id'";
$result = mysqli_query($conn, $get_writer_info);
$writer_info = mysqli_fetch_assoc($result);
//certificate
$get_certi_info = "SELECT * FROM $_SESSION[Certificate_table] WHERE user_id='$writer_id'";
$result_cer = mysqli_query($conn, $get_certi_info);
$certi_info = mysqli_fetch_assoc($result_cer);
// tutor
$get_tutor_info = "SELECT * FROM $_SESSION[Tutor_table] WHERE user_id='$writer_id'";
$result_tutor = mysqli_query($conn, $get_tutor_info);
$tutor_info = mysqli_fetch_assoc($result_tutor);

// tutee
$get_tutee_info = "SELECT * FROM $_SESSION[Tutee_table] WHERE user_id='$writer_id'";
$result_tutee = mysqli_query($conn, $get_tutee_info);
$tutee_info = mysqli_fetch_assoc($result_tutee);

?>


<div class="w3-col m9">
  <div class="w3-container w3-card w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"><br>
    <div class="w3-container w3-padding">
      <div class="w3-col m12">
        <p style= "text-align: right">

          <button type="button" class="w3-button w3-theme write-btn" onclick="location.href='review.php'">리뷰보기</button>
          <h4 class="w3-center"><b>Profile</b></h4>
        </p>
        <p class="w3-center"><img src="<?php echo $writer_info['image']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>

        <hr class="two">
        <p style= "text-align: left">
          <div style="padding:40px;">
            <div class="w3-container w3-padding">
              <div class="w3-container w3-padding">
                  <?php
                  if($writer_info['is_tutor'] == 1){

                    echo '
                        <p><option value=1> 이름:  '.$writer_info['name'].' </option></p>
                        <p><option value=1> 성별:  '.$writer_info['gender'].'</option></p>
                        <p><option value=1> 생년월일:  '.$writer_info['birth_year'].'</option></p>
                        <p><option value=6> 학교: '.$tutor_info['school'].' </option></p>
                        <p><option value=6> 전공: '.$tutor_info['major'].' </option></p>
                        <p><option value=1> 전화번호:  '.$writer_info['phone'].'</option></p>
                        <p><option value=1> e-mail:  '.$writer_info['email'].'</option></p>
                        <p><option value=6> 과외경력: '.$tutor_info['tutoring_level'].' </option></p>
                        <p><option value=1> 토익/토플:  '.$certi_info['TOEIC'].'/'.$certi_info['TOEFL'].' </option></p>
                        <p><option value=6> 특기사항: '.$tutor_info['specialty'].' </option></p>
                        <p><option value=6> 소개: '.$tutor_info['introduce'].' </option></p>
                        ';

                    }else if($writer_info['is_tutor'] == 0){

                      echo '
                      <p><option value=1> 이름:  '.$writer_info['name'].' </option></p>
                      <p><option value=1> 성별:  '.$writer_info['gender'].'</option></p>
                      <p><option value=1> 생년월일:  '.$writer_info['birth_year'].'</option></p>
                      <p><option value=1> 학교:  '.$tutee_info['birth_year'].'</option></p>
                      <p><option value=1> 전화번호:  '.$writer_info['phone'].'</option></p>
                      <p><option value=1> e-mail:  '.$writer_info['email'].'</option></p>
                      ';
                  } ?>

              </div>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>
</div>
