<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php session_start(); ?>


<div class="w3-col m9">
<!--
  <div class="w3-container w3-card w3-round w3-margin review-user-info">
    <img src="<?php echo $_SESSION['user_img']?>" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity"> </span>
    <h4> 정한결</h4><br>
    <hr class="w3-clear">
    <div class="user-info">
      <li> 아래에 글을 입력해 주세요 </li>
      <li> 수능 영어 전문 과외 </li>
      <li> 영어 과외 경력 다수 (5회 이상) </li>
      <li> 즐겁게 영어 배우고 싶다면, 영어와 친해지고 싶다면 환영 </li>
    </div> -->





<div class="w3-card-4">

<div class="w3-container w3-white">
  <h2>문의 종류를 선택하고 글을 작성해 주세요</h2>
</div>

<form class="w3-container">

<!-- <label>제목을 입력해주세요</label>
<input class="w3-input" type="text"> -->
<textarea rows="2" cols="55" name="contents">제목을 입력해 주세요. </textarea>
<input type="text" placeholder="제목을 입력해주세요."> </input>

<!-- <textarea rows="10" cols="60" name="contents">제목을 입력해 주세요.</textarea> -->

<select class="w3-select w3-border" name="option">
  <option value="" disabled selected>문의종류</option>
  <option value="1">결제 문의</option>
  <option value="2">일반 문의</option>
  <option value="3">기타 문의</option>
</select>


<textarea rows="20" cols="60" name="contents"></textarea>

</form>




<button class="w3-button w3-border w3-xlarge">글쓰기</button>
<button class="w3-button w3-border w3-xlarge">돌아가기</button>



</div>




  </div>
