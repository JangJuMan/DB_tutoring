<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php session_start(); ?>


<div class="w3-col m9">


  <div class="w3-card-4">

  <div class="w3-container w3-white">
    <h2>튜터/튜티 구합니다 글쓰기 페이지</h2>
  </div>

  <form class="w3-container">

  <!-- <label>제목을 입력해주세요</label>
  <input class="w3-input" type="text"> -->

  <!-- <textarea rows="2" cols="55" name="contents">제목을 입력해 주세요. </textarea> -->

<input type="text" placeholder="제목을 입력해주세요."> </input>

  <div class="w3-row-padding filter" style="display:<?php if(1 == 1){echo 'block';}else{echo 'none';}?>">
    <div class="w3-col m12">
      <div class="w3-card w3-round w3-white">
        <div class="w3-container w3-padding">
          <h6 class="w3-opacity">Filter to Find</h6>
          <div class="check-box-container">
            <label class="check-box-label">월  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">화  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">수  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">목  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">금  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">토  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">일  </label> <input class="check-box" type="checkbox" checked>
            <label class="check-box-label">과외 : </label>
            <select class="dropdown" name="subject">
              <option value=0>튜터를 구합니다.</option>
              <option value=1>튜티를 구합니다.</option>
            </select>
            <button type="button" class="w3-button w3-theme write-btn"><i class="fas fa-pencil-alt"></i> 글쓰기</button>
          </div>
          <div class="check-box-container">
            <label class="check-box-label">수업 과목: </label>
            <select class="dropdown" name="subject">
              <option>DB.subject1</option>
              <option>DB.subject2</option>
              <option>DB.subject3</option>
              <option>DB.subject4</option>
              <option>DB.subject5</option>
            </select>
            <label class="check-box-label">1시간당 과외비: </label>
            <select class="dropdown" name="subject">
              <option value=0>₩0 ~ ₩20,000</option>
              <option value=2>₩20,000 ~ ₩50,000</option>
              <option value=5>₩50,000 ~ ₩100,000</option>
            </select>
            <button type="button" class="w3-button w3-theme write-btn"><i class="fas fa-search"></i> 검색하기</button>
          </div>
        </div>
      </div>
    </div>
  </div>

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







<!-- <textarea rows="10" cols="60" name="contents">제목을 입력해 주세요.</textarea> -->

<!-- <textarea rows="2" cols="35" name="contents">과외 시간을 입력해주세요. /1주일</textarea>
<textarea rows="2" cols="35" name="contents">과외 비용을 입력해주세요. /1시간</textarea> -->

<input type="text" placeholder="과외 시간을 입력해주세요. /1주일."> </input>
<input type="text" placeholder="과외 비용을 입력해주세요. /1시간."> </input>

<select class="w3-select w3-border" name="option">
  <option value="" disabled selected>장소</option>
  <option value="1">육거리</option>
  <option value="2">양덕</option>
  <option value="3">환호동</option>
</select>










<!-- //글쓰기페이지 -->

<textarea rows="20" cols="60" name="contents"></textarea>

</form>




<button class="w3-button w3-border w3-xlarge">글 쓰기</button>
<button class="w3-button w3-border w3-xlarge">글 수정하기</button>
<button class="w3-button w3-border w3-xlarge">글 삭제하기</button>
<button class="w3-button w3-border w3-xlarge">돌아가기</button>



</div>




  </div>
