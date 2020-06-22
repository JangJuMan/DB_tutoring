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



//    $mon = $_POST['mon'];


    $mon = (int)$_POST['mon'];
    $tue = (int)$_POST['tue'];
    $wed = (int)$_POST['wed'];
    $thr = (int)$_POST['thr'];
    $fri = (int)$_POST['fri'];
    $sat = (int)$_POST['sat'];
    $sun = (int)$_POST['sun'];


    if($mon != 1)
    {
      $mon = 0;
    }

    if($tue != 1)
    {
      $tue = 0;
    }

    if($wed != 1)
    {
      $wed = 0;
    }

    if($thr != 1)
    {
      $thr = 0;
    }

    if($fri != 1)
    {
      $fri = 0;
    }

    if($sat != 1)
    {
      $sat = 0;
    }

    if($sun != 1)
    {
      $sun = 0;
    }

    $to_find_tutor = (int)$_POST['to_find_tutor'];

    $subject_name = (int)$_POST['subject_name'];


    if($subject_name == 1)
    {
      $subject_name = 'Math';
    }



    $tutor_time = (int)$_POST['tutor_time'];
    $tutor_amount = (int)$_POST['tutor_amount'];
    $location_name = (int)$_POST['location_name'];



    $distance = 30;
    $read_num = 0;
    $answer_for = 1;





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
      // echo "bbs list --> 0 result";
    }

    $bbs_id = $bbs_cnt+2;


    $category_cnt = 0;
    $category_list = array();
    $load_all_category = "SELECT * FROM $_SESSION[category_table]";
    $result = $conn->query($load_all_category);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        array_push($category_list, $row);
        $category_cnt++;
      }
    }else{
      // echo "category list --> 0 result";
    }

    $category_id = $category_cnt+2;


    $tutoring_cnt = 0;
    $tutoring_list = array();
    $load_all_tutor = "SELECT * FROM $_SESSION[tutoring_table] ";
    $result = $conn->query($load_all_tutor);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        array_push($tutoring_list, $row);
        $tutoring_cnt++;
      }
    }else{
      // echo "tutor list --> 0 result";
    }

    $tutoring_id = $tutoring_cnt+2;




    $sub_id = 99;
    $l_id = 99;


    // $update_sql = "INSERT INTO $_SESSION[notice_table] (bbs_id, kind_of) VALUES ($bbs_id, $kind_of)";
    // if($conn->query($update_sql) === TRUE){
    //   echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
    //   echo "<script>location.href='".$return_location."'</script>";
    // }
    // else{
    //   echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    // }




    $update_sql = "INSERT INTO $_SESSION[tutoring_table] (sub_id, tutoring_time, payment, l_id, bbs_id, to_find_tutor) VALUES ($subject_name, $tutor_time, $tutor_amount, $location_name, $bbs_id, $to_find_tutor)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
      // echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }

    $update_sql = "INSERT INTO $_SESSION[tutoring_day_table] (tutoring_id, mon, tue, wed, thur, fri, sat, sun) VALUES ($tutoring_id, $mon, $tue, $wed, $thr, $fri, $sat, $sun)";
    if($conn->query($update_sql) === TRUE){
      echo "<script charset=utf-8>alert('게시글이 등록되었습니다.')</script>";
      // echo "<script>location.href='".$return_location."'</script>";
    }
    else{
      echo "ERROR: " . $update_sql . "<br>" . $conn->error;
    }






    $state = 3;

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
