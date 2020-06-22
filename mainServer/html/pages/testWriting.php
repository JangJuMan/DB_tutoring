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


  $_SESSION['user_table'] = "User";
  $_SESSION['bbs_table'] = "Bbs";
  $_SESSION['comment_table'] = "Comment";
  $_SESSION['mypage_table'] = "Mypage";
  $_SESSION['notice_table'] = "Notice";



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
  }

  // 비 정상적인 접근 차단
  if($_SESSION['user_name'] == NULL && $_SESSION['user_email'] == NULL &&
    $_SESSION['user_img'] == NULL){
    echo "<script>alert('잘못된 접근입니다.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
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
      <MiddleColumn include-html="../components/writingNotice.php"><MiddleColumn>
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

  function myWriting(form_id, crud_id){

    document.getElementById("crudType_insert").value = "text_insert";
    document.getElementById(form_id).submit();

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
