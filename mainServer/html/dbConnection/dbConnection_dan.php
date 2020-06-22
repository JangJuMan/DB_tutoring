<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<body>
  <?php
  session_start();


  // POST로 넘어온 crudType에 따라 다르게 행동하기
  //update okay
  if($_POST['crudType'] == "review_update"){
    // Post로 넘어온 form 값 저장하기
    $review_input = $_POST['review'];//
    $writer_id = $_POST['writer_id'];//리뷰를 작성한 사람이니까 reciever_id는 그대로
    $review_id = $_POST['review_id'];//필요하려
    //$review_id = $_POST['review_id']; //review_id는 autoincremnet아닌가
    $return_location = $_POST['return_location'];

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기 수정완료!!!
    $update_sql = "UPDATE Review SET content='$review_input',writer_id = '$writer_id', modify_time=CURRENT_TIMESTAMP WHERE review_id=$review_id";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('수정이 완료되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
      echo "<h1>reviewinput : ".$review_input."</h1>";
      echo "<h1>reviewinput : ".$review_id."</h1>";
      echo "<h1>reviewinput : ".$return_location."</h1>";
    }

    // DB 연결 종료
    $conn->close();
  }


  else if($_POST['crudType'] == "review_delete"){
    // Post로 넘어온 form 값 저장하기
    $review_id = $_POST['review_id'];
    $writer_id = $_POST['writer_id'];
    $return_location = $_POST['return_location'];
    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "UPDATE Review SET modify_time=CURRENT_TIMESTAMP, state=-1 WHERE review_id=$review_id AND writer_id = $writer_id";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('삭제가 완료되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
      echo "<h1>commentinput : ".$review_id."</h1>";
      echo "<h1>commentinput : ".$return_location."</h1>";
    }

    // DB 연결 종료
    $conn->close();
  }

//else
  if($_POST['crudType_insert'] == "review_insert"){
    // Post로 넘어온 form 값 저장하기
    $review_input = $_POST['review_input'];//리뷰 내용 O
    $writer_id = $_POST['writer_id'];//리뷰를 작성한 사람이니까 user O
    $receiver_id = $_POST['receiver_id'];//필요하 O
  //  $review_id = $_POST['review_id']; //review_id는 autoincremnet아닌가
    $return_location = $_POST['return_location']; //O
    $state = 1;
    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }

    // SQL 날리기
    $update_sql = "INSERT INTO Review (writer_id, receiver_id, upload_time, modify_time, content, state)
    VALUES ($writer_id, $receiver_id,CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$review_input', $state)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('리뷰가 등록되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();
  }

  else{
    $review_input = $_POST['review_input'];
    $receiver_id = $_POST['receiver_id'];
    $return_location = $_POST['return_location'];
    echo "ERROR";
    echo "<h1>receiver_id : ".$receiver_id."</h1>";
    echo "<h1>return_location : ".$return_location."</h1>";
    echo "<h1>review_input : ".$review_input."</h1>";
    echo "hihih";
  }


  ?>

</body>
</html>
