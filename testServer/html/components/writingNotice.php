<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php session_start();

$conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
if($conn->connect_error){
  die("CONNECTION FAILED! : ". $conn->connect_error);
}

?>

<div class="w3-col m9">

  <div class="w3-card w3-margin-left w3-row-padding w3-col m12">
    <div class="w3-container">
      <h2>문의 종류를 선택하고 글을 작성해 주세요</h2>
    </div>

    <form class="w3-container" method="post" action="../dbConnection/dbConnection_jungsup.php">
      <input name="title" class="comment-input form-element" type="text" placeholder="제목을 입력해주세요" value="">

      <select name="state" class="w3-select w3-border form-element" name="option">
        <option value="" disabled selected>공지종류</option>
        <option value="1">주요 공지</option>
        <option value="2">일반 공지</option>
      </select>


      <input name="return_location" type="hidden" value="../pages/notice.php" />



      <input name="user_id" value="<?=$_SESSION['user_id']?>" type="hidden" />

      <textarea name="content" class="comment-input form-element" type="text" rows="13" cols="60" name="contents"></textarea>
      <br>
      <button type="submit" class="w3-button w3-border form-btn">글쓰기</button>
      <button type="button" class="w3-button w3-border form-btn" onclick="location.href = '../pages/notice.php'">돌아가기</button>
    </form>
  </div>
</div>

<?php $conn->close(); ?>
