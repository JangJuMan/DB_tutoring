<!DOCTYPE html>
<html>
<title>Tutoring Matching System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
<link rel="stylesheet" href="../../css/main.css">
<script src="../../js/includeHTML.js"></script>
<script src="../../js/includeRouter.js"></script>
<style>
  body,h1,h2,h3,h4,h5,h6, p{font-family: "Raleway", sans-serif}
</style>
<body class="w3-theme-l5">
  <?php
  // 세션 설정 (이건 좀 야매임. 굉장히 보안적으로 취약함. 근데 귀찮으니까 이렇게 한 것일 뿐..)
  session_start();
  $_SESSION['DB_host'] = "localhost";
  $_SESSION['DB_id'] = "itp40001";
  $_SESSION['DB_pw'] = "hgudba11*";
  $_SESSION['DB_db'] = "itp40001";

  // 디비 테이블 이름을 세션으로 저장해서 사용.
  //  왜냐고 물으면 변수 왜 사용해요? 랑 비슷한 느낌 (테이블 이름 바뀌면 이거만 바꿔서 해결 가능)
  $_SESSION['user_table'] = "User";
  $_SESSION['bbs_table'] = "Bbs";
  $_SESSION['comment_table'] = "Comment";
  $_SESSION['mypage_table'] = "Mypage";
  $_SESSION['subject_table'] = "Subject";
  $_SESSION['tutoring_table'] = "Tutoring";
  $_SESSION['tutoring_day_table'] = "Tutoring_Day";
  $_SESSION['loction_table'] = "Location";



  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // Login page에서 넘어온 정보 저장하기
  if($_POST['user_name'] != NULL){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_img = $_POST['user_img'];
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_img'] = $user_img;


    // DB에 새로운 유저라면 정보 넣기 (INSERT 하기)
    $enroll_new_user = "INSERT INTO $_SESSION[user_table] (email, image, name) SELECT '$user_email', '$user_img', '$user_name' FROM dual
                          WHERE NOT EXISTS (SELECT * FROM $_SESSION[user_table] WHERE email='$user_email')";

    if($conn->query($enroll_new_user) === TRUE){
      // echo "<h1>new user record created successfully</h1>";
    }
    else{
      echo "ERROR: " . $enroll_new_user . "<br>" . $conn->error;
    }

    // DB에서 유저정보 가져오고 저장하기 (SELECT 하기)
    $to_get_user_info = "SELECT * FROM $_SESSION[user_table] WHERE email='$user_email'";
    $result = mysqli_query($conn, $to_get_user_info);
    $user_info = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user_info['user_id'];
    $_SESSION['gender'] = $user_info['gender'];
    $_SESSION['phone'] = $user_info['phone'];
    $_SESSION['birth_year'] = $user_info['birth_year'];
    $_SESSION['address'] = $user_info['address'];
    $_SESSION['recent_log'] = $user_info['recent_login_log'];
    $_SESSION['is_korean'] = $user_info['is_korean'];
    $_SESSION['modify_time'] = $user_info['modify_time'];
    $_SESSION['is_tutor'] = $user_info['is_tutor'];
  }

  // Filter
  if($_POST['is_tutee'] != 0 || $_POST['subject'] != 0 || $_POST['payment'] != 0 || $_POST['search_title'] != null
      || $_POST['mon'] != null || $_POST['tue'] != null || $_POST['wed'] != null || $_POST['thr'] != null
      || $_POST['fri'] != null || $_POST['sat'] != null || $_POST['sun'] != null ){
    $_SESSION['is_tutee'] = $_POST['is_tutee'];
    $_SESSION['subject'] = $_POST['subject'];
    $_SESSION['payment'] = $_POST['payment'];
    $_SESSION['search_title'] = $_POST['search_title'];
    $_POST['mon'] == "on" ? $_SESSION['mon'] = 1 : $_SESSION['mon'] = 0;
    $_POST['tue'] == "on" ? $_SESSION['tue'] = 1 : $_SESSION['tue'] = 0;
    $_POST['wed'] == "on" ? $_SESSION['wed'] = 1 : $_SESSION['wed'] = 0;
    $_POST['thr'] == "on" ? $_SESSION['thr'] = 1 : $_SESSION['thr'] = 0;
    $_POST['fri'] == "on" ? $_SESSION['fri'] = 1 : $_SESSION['fri'] = 0;
    $_POST['sat'] == "on" ? $_SESSION['sat'] = 1 : $_SESSION['sat'] = 0;
    $_POST['sun'] == "on" ? $_SESSION['sun'] = 1 : $_SESSION['sun'] = 0;
    // echo "<script>alert('post value is.')</script>";
  }
  else{
    $_SESSION['is_tutee'] = null;
    $_SESSION['subject'] = null;
    $_SESSION['payment'] = null;
    $_SESSION['search_title'] = null;
    $_SESSION['mon'] = 1;
    $_SESSION['tue'] = 1;
    $_SESSION['wed'] = 1;
    $_SESSION['thr'] = 1;
    $_SESSION['fri'] = 1;
    $_SESSION['sat'] = 1;
    $_SESSION['sun'] = 1;
    // echo "<script>alert('post value is not.')</script>";
  }

  // 비 정상적인 접근 차단
  if($_SESSION['user_name'] == NULL && $_SESSION['user_email'] == NULL &&
    $_SESSION['user_img'] == NULL && $_SESSION['user_id'] == NULL){
    echo "<script>alert('잘못된 접근입니다.')</script>";
    echo "<script>location.href='login.php'</script>";
  }

  // 현재 페이지 정보 기록
  $_SESSION['now'] = "main";

  // DB연결 종료
  $conn->close();
?>

  <!-- Navbar -->
  <Navbar include-html="../components/navBar.php"></Navbar>
  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <LeftColumn include-html="../components/leftColumn.php"></LeftColumn>
      <!-- Middle Column -->
      <MiddleColumn include-html="../components/middleColumn.php"><MiddleColumn>
    <!-- End Grid -->
    </div>
  <!-- End Page Container -->
  </div>
  <br>
  <!-- Footer -->
  <Footer include-html="../components/footer.php"></Footer>



  <script>
  // Accordion
  function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-theme-d1";
    } else {
      x.className = x.className.replace("w3-show", "");
      x.previousElementSibling.className =
      x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
  }

  // Used to toggle the menu on smaller screens when clicking on the menu button
  function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else {
      x.className = x.className.replace(" w3-show", "");
    }
  }

  // 댓글 보기
  function openComment(id, id2){
    if(document.getElementById(id).style.display == "none"){
      // alert('now : none -> block');
      document.getElementById(id).style.display = "block";
      document.getElementById(id2).innerHTML = "<i class='fa fa-comment'></i> &nbsp Close";
    }
    else{
      // alert('now : block -> none');
      document.getElementById(id).style.display = 'none';
      document.getElementById(id2).innerHTML = "<i class='fa fa-comment'></i> Comment";
    }
  }

  // form DB 연결하기
  function mySubmit(form_id, operation, crud_id){
    if(operation == "modify"){
      var input_modify = confirm("글을 수정하시겠습니까?");
      if(input_modify){
        document.getElementById(crud_id).value = "comment_update";
        document.getElementById(form_id).submit();
      }
    }
    else if(operation == "delete"){
      var input_delete = confirm("글을 삭제하시겠습니까?");
      if(input_delete){
        document.getElementById(crud_id).value = "comment_delete";
        document.getElementById(form_id).submit();
      }
    }
    else if(operation == "insert"){
      document.getElementById(form_id).submit();
    }
    else{
      alert("error");
    }
  }

  // file decomposition
  includeHTML(function(){
    includeRouter(function(){
      // do something in the future.
    });
  });
  </script>
</body>
</html>
