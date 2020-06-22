<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php session_start();

echo '

  <div class="w3-col m9">


  <div class="w3-card-4">


  <div class="w3-container w3-white">
    <h2>문의 종류를 선택하고 글을 작성해 주세요</h2>
  </div>

  <form class="w3-container">




  <form method="post" action="../dbConnection/dbConnection.php">


      <div class="comment-control">

      <input name="return_location" type="hidden" value="../pages/testWriting.php"/>

      <input name="title" class="comment-input" type="text" placeholder="제목을 입력해주세요" value="">

      <textarea name="content" class="comment-input" type = "text" rows="20" cols="60" name="contents"></textarea>
      <input type="submit" class="comment-modify"  />

  </form>
</div>

';



?>
<?php $conn->close(); ?>
