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


//user
$writer_id = $_SESSION['user_id'];
$get_writer_info = "SELECT * FROM $_SESSION[user_table] WHERE user_id='$writer_id'";
$result = mysqli_query($conn, $get_writer_info);  // 쿼리 날려서 담아
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

<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }
?>

<div class="w3-col m9">
  <div class="w3-container w3-card w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"><br>
    <div class="w3-container w3-padding">
      <div class="w3-col m12">
        <form method="post" action="../dbConnection/dbConnection.php">
          <input name="return_location" type="hidden" value="../pages/modify.php" />
          <input name="wanseo" type="hidden" value="wanseoTest">
          <div style="text-align: center;">
            <h4 class="w3-center">Profile</h4>
            <img src="<?php echo $_SESSION['user_img']?>" class="w3-circle w3" style="height:106px;width:106px" alt="Avatar">
          </div>

          <?php if($writer_info['is_tutor']==1){?>

            <div style="text-align: center;">
              <h5 style="display: inline-block">이름 : </h5>
              <input type="text" name="modify_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['name']; ?>" readonly>
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> 성별 : </h5>
              <div class="check-box-container">
                <label class="check-box-label">male</label> <input name="gender" class="check-box" type="radio" value="male" <?php if("male" == $writer_info['gender']){echo "checked";}?>>
                <label class="check-box-label">female</label> <input name="gender" class="check-box" type="radio" value="female" <?php if("female" == $writer_info['gender']){echo "checked";}?>>
              </div>
            </div>

              <div style="text-align: center;">
                <h5 style="display: inline-block"> 생년월일 : </h5>
                <input type="text" name="birth_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['birth_year']; ?>">
              </div>

              <?php if ($writer_info['is_korean']==1){ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 내/외국인: </h5>
                  <input type="text" name="is_korean" class="comment-input" style="width: 30%;" value="<?php echo '내국인'; ?>">
                </div>
              <?php }else{ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 내/외국인: </h5>
                  <input type="text" name="is_korean" class="comment-input" style="width: 30%;" value="<?php echo '외국인'; ?>">
                </div>
              <?php } ?>

              <?php if ($writer_info['is_tutor']==1){ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 튜터/튜티: </h5>
                  <input type="text" name="is_tutor" class="comment-input" style="width: 30%;" value="<?php echo '튜터'; ?>">
                </div>
              <?php }else{ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 튜터/튜티: </h5>
                  <input type="text" name="is_tutor" class="comment-input" style="width: 30%;" value="<?php echo '튜티'; ?>">
                </div>
              <?php } ?>

            <div style="text-align: center;">
              <h5 style="display: inline-block"> 주소 : </h5>
              <input type="text" name="address_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['address']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> email : </h5>
              <input type="text" name="email_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['email']; ?>" readonly>
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">번호 : </h5>
              <input type="text" name="phone" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['phone']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> 학교 : </h5>
              <input type="text" name="school" class="comment-input" style="width: 30%;" value="<?php echo $tutor_info['school']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> 전공 : </h5>
              <input type="text" name="major" class="comment-input" style="width: 30%;" value="<?php echo $tutor_info['major']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">자격증(토익) : </h5>
              <input type="text" name="certificate" class="comment-input" style="width: 30%;" value="<?php echo $certi_info['TOEIC']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">과외 경력 : </h5>
              <input type="text" name="tutoring_level" class="comment-input" style="width: 30%;" value="<?php echo $tutor_info['tutoring_level']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">특기 : </h5>
              <input type="text" name="specialty" class="comment-input" style="width: 30%;" value="<?php echo $tutor_info['specialty']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">소개 : </h5>
              <input type="text" name="introduce" class="comment-input" style="width: 30%;" value="<?php echo $tutor_info['introduce']; ?>">
            </div>


          <?php }else if($writer_info['is_tutor']==0){ ?>


            <div style="text-align: center;">
              <h5 style="display: inline-block">이름 : </h5>
              <input type="text" name="modify_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['name']; ?>"readonly>
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> 성별 : </h5>
              <div class="check-box-container">
                <label class="check-box-label">male</label> <input name="gender" class="check-box" type="radio" value="male" <?php if("male" == $writer_info['gender']){echo "checked";}?>>
                <label class="check-box-label">female</label> <input name="gender" class="check-box" type="radio" value="female" <?php if("female" == $writer_info['gender']){echo "checked";}?>>
              </div>
            </div>

              <div style="text-align: center;">
                <h5 style="display: inline-block"> 생년월일 : </h5>
                <input type="text" name="birth_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['birth_year']; ?>">
              </div>

              <?php if ($writer_info['is_korean']==1){ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 내/외국인: </h5>
                  <input type="text" name="is_korean" class="comment-input" style="width: 30%;" value="내국인">
                </div>
              <?php }else{ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 내/외국인: </h5>
                  <input type="text" name="is_korean" class="comment-input" style="width: 30%;" value="외국인">
                </div>
              <?php } ?>

              <?php if ($writer_info['is_tutor']==1){ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 튜터/튜티: </h5>
                  <input type="text" name="is_tutor" class="comment-input" style="width: 30%;" value="튜터">
                </div>
              <?php }else if($writer_info['is_tutor']==0){ ?>
                <div style="text-align: center;">
                  <h5 style="display: inline-block"> 튜터/튜티: </h5>
                  <input type="text" name="is_tutor" class="comment-input" style="width: 30%;" value="튜티">
                </div>
              <?php } ?>

            <div style="text-align: center;">
              <h5 style="display: inline-block"> 주소 : </h5>
              <input type="text" name="address_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['address']; ?>">
            </div>

            <div style="text-align: center;">
              <h5 style="display: inline-block"> email : </h5>
              <input type="text" name="email_name" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['email']; ?>" readonly>
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block">번호 : </h5>
              <input type="text" name="phone" class="comment-input" style="width: 30%;" value="<?php echo $writer_info['phone']; ?>">
            </div>
            <div style="text-align: center;">
              <h5 style="display: inline-block"> 학교 : </h5>
              <input type="text" name="school" class="comment-input" style="width: 30%;" value="<?php echo $tutee_info['school']; ?>">
            </div>

          <?php } ?>

          <h5 class="w3-center">
            <input type="submit" class="comment-modify" value="수정완료" />
          </h5>

        </form>
      </div>
    </div>
  </div>
</div>
