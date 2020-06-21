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
      <h2>QNA 관련 질문/답변 글을 작성해 주세요</h2>
    </div>

    <form class="w3-container" method="post" action="../dbConnection/dbConnection_qna.php">
      <input name="title" class="comment-input form-element" type="text" placeholder="제목을 입력해주세요" val/ue="">


      <select name="state_qna" class="w3-select w3-border form-element" name="option">
        <option value="" disabled selected>질문/답변</option>
        <option value="1">질문 작성</option>
        <option value="0">답변 작성</option>
      </select>


      <select name="state_category" class="w3-select w3-border form-element" name="option">
        <option value="" disabled selected>문의종류</option>
        <option value="주요 문의">주요 문의</option>
        <option value="자유 문의">자유 문의</option>
        <option value="결제 문의">결제 문의</option>
      </select>


      <input name="return_location" type="hidden" value="../pages/qna_jungsup.php" />


      <input name="user_id" value="<?=$_SESSION['user_id']?>" type="hidden" />

      <!-- <input name="user_id" value="'.$_SESSION['user_id'].'" type="hidden"/> -->
      <!-- <input name="user_id" value="<?=$_SESSION['user_id']?>" type="hidden"/> -->

      <textarea name="content" class="comment-input form-element" type="text" rows="13" cols="60" name="contents"></textarea>
      <br>
      <button type="submit" class="w3-button w3-border form-btn">글쓰기</button>
      <button type="button" class="w3-button w3-border form-btn" onclick="location.href = '../pages/main.php'">돌아가기</button>

    </form>

  </div>



</div>


<?php $conn->close(); ?>
