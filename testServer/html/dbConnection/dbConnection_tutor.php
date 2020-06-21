<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<body>
  <?php
  session_start();
    // Post로 넘어온 form 값 저장하기
    $return_location = $_POST['return_location'];
    $title = $_POST['title'];

    $user_id = $_POST['user_id'];
//    $user_id = 999;

    $content = $_POST['content'];

//    $state = 999;

// this is used in dbcon_jungsup
//    $kind_of = (int)$_POST['state'];


    $kind_of = $_POST['state_category'];

    $is_qna = (int)$_POST['state_qna'];







    $state = 2;
    $read_num = 0;
    $is_faq = 0;
    $answer_for = 1;





    $bbs_id = 9999;

    // DB 연결
    $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
    if($conn->connect_error){
      die("CONNECTION FAILED! : ". $conn->connect_error);
    }


    $bbs_cnt = 0;
    $bbs_list = array();
    $load_all_bbs = "SELECT * FROM $_SESSION[bbs_table] WHERE state != -1";
    $result = $conn->query($load_all_bbs);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        array_push($bbs_list, $row);
        $bbs_cnt++;
      }
    }else{
      echo "bbs list --> 0 result";
    }

    $bbs_id = $bbs_cnt+2;


    $category_cnt = 0;
    $category_list = array();
    $load_all_category = "SELECT * FROM $_SESSION[category_table] WHERE state != -1";
    $result = $conn->query($load_all_category);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        array_push($category_list, $row);
        $category_cnt++;
      }
    }else{
      echo "category list --> 0 result";
    }

    $category_id = $category_cnt+2;




    // $update_sql = "INSERT INTO $_SESSION[notice_table] (bbs_id, kind_of) VALUES ($bbs_id, $kind_of)";
    // if($conn->query($update_sql) === TRUE){
    //   echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
    //   echo "<script>location.href='".$return_location."'</script>";
    // }
    // else{
    //   echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    // }


    $update_sql = "INSERT INTO $_SESSION[category_table] (name, modify_time) VALUES ('{$kind_of}', CURRENT_TIMESTAMP)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }



    $update_sql = "INSERT INTO $_SESSION[qna_table] (bbs_id, is_qna, is_faq, category_id, answer_for) VALUES ($bbs_id, $is_qna, $is_faq, $category_id, $answer_for)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }




    $state = 2;

    $update_sql = "INSERT INTO $_SESSION[bbs_table] (title, user_id, upload_time, modify_time, state, content, read_num) VALUES ('{$title}', $user_id, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, $state, '{$content}', $read_num)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
      echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    // DB 연결 종료
    $conn->close();


  ?>

</body>
</html>
