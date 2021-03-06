<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<body>
  <?php
  session_start();

  // for test
  // echo "<h1>type = ".$_POST['crudType_insert'];
  // echo "<h1>type = ".$_POST['crudType'];

  // POST로 넘어온 crudType에 따라 다르게 행동하기
  if($_POST['crudType'] == "comment_update"){
    // Post로 넘어온 form 값 저장하기
    $comment_input = $_POST['comment'];
    $comment_id = $_POST['comment_id'];
    $return_location = $_POST['return_location'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "UPDATE $_SESSION[comment_table] SET content='$comment_input', modify_time=CURRENT_TIMESTAMP WHERE comment_id=$comment_id";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('수정이 완료되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
      echo "<h1>commentinput : ".$comment_input."</h1>";
      echo "<h1>commentinput : ".$comment_id."</h1>";
      echo "<h1>commentinput : ".$return_location."</h1>";
    }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['crudType'] == "comment_delete"){
    // Post로 넘어온 form 값 저장하기
    $comment_id = $_POST['comment_id'];
    $return_location = $_POST['return_location'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "UPDATE $_SESSION[comment_table] SET modify_time=CURRENT_TIMESTAMP, state=-1 WHERE comment_id=$comment_id";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('삭제가 완료되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
      echo "<h1>commentinput : ".$comment_id."</h1>";
      echo "<h1>commentinput : ".$return_location."</h1>";
    }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['crudType_insert'] == "comment_insert"){
    // Post로 넘어온 form 값 저장하기
    $bbs_id = $_POST['bbs_id'];
    $return_location = $_POST['return_location'];
    $comment_input = $_POST['comment_input'];
    $user_id = $_POST['user_id'];
    $state = 1;

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "INSERT INTO $_SESSION[comment_table] (bbs_id, upload_time, modify_time, user_id, content, state) VALUES ($bbs_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, $user_id, '$comment_input', $state)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('댓글이 등록되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['crudType_like'] == "tutoring_like_on"){
    $bbs_id = $_POST['bbs_id'];
    $user_id = $_POST['user_id'];
    $return_location = $_POST['return_location'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "INSERT INTO $_SESSION[mypage_table] (user_id, interesting_tutoring, state, modify_time) VALUES($user_id, $bbs_id, 1, CURRENT_TIMESTAMP)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('관심 게시글에 추가되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['crudType_like'] == "tutoring_like_off"){
    $bbs_id = $_POST['bbs_id'];
    $user_id = $_POST['user_id'];
    $return_location = $_POST['return_location'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "DELETE FROM $_SESSION[mypage_table] WHERE user_id=$user_id AND interesting_tutoring=$bbs_id";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('관심 게시글에서 삭제되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['writeType'] == "tutorWriting"){
    $return_location = $_POST['return_location'];
    $_POST['mon'] == 'on' ? $mon = 1 : $mon = 0;
    $_POST['tue'] == 'on' ? $tue = 1 : $tue = 0;
    $_POST['wed'] == 'on' ? $wed = 1 : $wed = 0;
    $_POST['thr'] == 'on' ? $thur = 1 : $thur = 0;
    $_POST['fri'] == 'on' ? $fri = 1 : $fri = 0;
    $_POST['sat'] == 'on' ? $sat = 1 : $sat = 0;
    $_POST['sun'] == 'on' ? $sun = 1 : $sun = 0;
    $to_find_tutor = $_POST['to_find_tutor'];
    $location = $_POST['location'];
    $content = $_POST['content'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // TODO: SQL 날리기 (정섭이형 SQl 햇던거대로 날려주세요. 위에 정보 다 저장해놨으어요. 유저아이디는 세션에 있는거 쓰면 될거에요)

    // $update_sql = "DELETE FROM $_SESSION[mypage_table] WHERE user_id=$user_id AND interesting_tutoring=$bbs_id";
    // if($conn->query($update_sql) === TRUE){
    //   echo "<script charset=utf-8>alert('관심 게시글에서 삭제되었습니다.')</script>";
    //   echo "<script>location.href='".$return_location."'</script>";
    // }
    // else{
    //   echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    // }

    // DB 연결 종료
    $conn->close();
  }
  else if($_POST['wanseo'] == "wanseoTest"){
    $return_location = $_POST['return_location'];
    $name= $_POST['modify_name'];
    $gender = $_POST['gender'];
    $birth = $_POST['birth_name'];
    if($_POST['is_korean']=='내국인'){
      $korean = 1;
    }else{
      $korean =0;
    }
    // if($_POST['is_tutor']=='튜터'){
    //   $tutor = 1;
    // }else{
    //   $tutor =0;
    // }
    $address = $_POST['address_name'];
    $phone = $_POST['phone'];
    $email= $_POST['email_name'];
    if($_POST['is_tutor']=='튜터'){
      $tutor = 1;
    }else if($_POST['is_tutor']=='튜티'){
      $tutor =0;
    }
    // echo "<h1>wanseo : ".$_POST['wanseo']."</h1>";
    // echo "<h1>return_location : ".$_POST['return_location']."</h1>";
    // echo "<h1>name : ".$_POST['modify_name']."</h1>";
    // echo "<h1>gender : ".$_POST['gender']."</h1>";
    // echo "<h1>birth : ".$_POST['birth_name']."</h1>";
    // echo "<h1>korean : ".$_POST['is_korean']."</h1>";
    // echo "<h1>tutor : ".$_POST['is_tutor']."</h1>";
    // echo "<h1>address : ".$_POST['address_name']."</h1>";
    // echo "<h1>phone : ".$_POST['phone']."</h1>";
    // echo "<h1>email : ".$_POST['email_name']."</h1>";

    if($tutor==1){
      $school= $_POST['school'];
      $major= $_POST['major'];
      $certificate = $_POST['certificate'];
      $tutoring_level= $_POST['tutoring_level'];
      $specialty= $_POST['specialty'];
      $introduce= $_POST['introduce'];

      // echo "<h1>major : ".$_POST['major']."</h1>";
      // echo "<h1>tutoring_level: ".$_POST['tutoring_level']."</h1>";
      // echo "<h1>specialty : ".$_POST['specialty']."</h1>";
      // echo "<h1>introduce : ".$_POST['introduce']."</h1>";
      // echo "<h1>school : ".$_POST['school']."</h1>";

    } else if($tutor==0){

      $school= $_POST['school'];
      // echo "<h1>school : ".$_POST['school']."</h1>";
    }
    // echo "<script>location.href='".$return_location."'</script>";

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "UPDATE $_SESSION[user_table] SET name='$name', gender='$gender', birth_year='$birth', is_korean = $korean, is_tutor = $tutor, address= '$address', phone= '$phone', email='$email' WHERE user_id= $_SESSION[user_id]";

    if($conn->query($update_sql) === TRUE){
      // echo $update_sql;
      //echo "<script charset=utf-8>alert('수정되었습니다.')</script>";
      //echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

        if($tutor==1){

          $update_sql = "UPDATE Tutor SET school='$school', major='$major', tutoring_level='$tutoring_level', specialty = '$specialty', introduce = '$introduce' WHERE user_id= $_SESSION[user_id]";

              if($conn->query($update_sql) === TRUE){
                // echo $update_sql;
                //echo "<script charset=utf-8>alert('수정되었습니다.')</script>";
                //echo "<script>location.href='".$return_location."'</script>";
              }
              else{
                echo "ERROR: " . $update_sql . "<br>" . $conn->error;
              }

            }else if($tutor==0){

                $update_sql = "UPDATE Tutee SET school='$school' WHERE user_id= $_SESSION[user_id]";

                if($conn->query($update_sql) === TRUE){
                  // echo $update_sql;
                  //echo "<script charset=utf-8>alert('수정되었습니다.')</script>";
                  //echo "<script>location.href='".$return_location."'</script>";
                }
                else{
                  echo "ERROR: " . $update_sql . "<br>" . $conn->error;
                }

              }

    if($conn->query($update_sql) === TRUE){
      // echo $update_sql;
      echo "<script charset=utf-8>alert('수정되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();

  }
  else{
    $comment_input = $_POST['comment'];
    $comment_id = $_POST['comment_id'];
    $return_location = $_POST['return_location'];
    echo "ERROR";
    echo "<h1>bbs_id : ".$bbs_id."</h1>";
    echo "<h1>return_location : ".$return_location."</h1>";
    echo "<h1>comment_input : ".$comment_input."</h1>";
    echo "<h1>user_id : ".$user_id."</h1>";
  }


  ?>

</body>
</html>
