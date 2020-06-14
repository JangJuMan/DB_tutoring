<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<!-- dan 수정 -->
<?php session_start(); ?>

<div class="w3-col m9">

  <div class="w3-container w3-card w3-round w3-margin review-user-info">
    <img src="<?php echo $_SESSION['user_img']?>" class="w3-left w3-circle w3-margin-right" style="width:60px">
    <span class="w3-right w3-opacity"> </span>
    <h4> 정한결</h4><br>
    <hr class="w3-clear">
    <div class="user-info">
      <li> 토익 950 점 </li>
      <li> 수능 영어 전문 과외 </li>
      <li> 영어 과외 경력 다수 (5회 이상) </li>
      <li> 즐겁게 영어 배우고 싶다면, 영어와 친해지고 싶다면 환영 </li>
    </div>
  </div>



<h2> <pre> <strong> 리뷰글 (최신순) </strong> </pre> </h2>
<!-- 추가한 부분 -->
<div class= "w3-round">
<div class="w3-row-padding">
  <div class="w3-col m12">
    <span class="w3-right w3-opacity comment-time">16 min</span>
    <div class="w3-card w3-round w3-white">
       <div class="w3-container w3-padding">
         <img src=<?php echo $_SESSION['user_img']?> class="w3-left w3-circle w3-margin-right" style="width:60px">
        <h5>최보름</h5><br>
        <p contenteditable="true" class="w3-border w3-padding">이분 과외 괜찮게 하시더라구요 좋습니다.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><!-- <i class="fa fa-thumbs-up"></i> -->수정하기</button>
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><!-- <i class="fa fa-comment"></i>--> 삭제하기 </button>
      </div>
    </div>
  </div>
</div>
</div>

<div class= "w3-round"><br>
<div class="w3-row-padding">
  <div class="w3-col m12">
    <span class="w3-right w3-opacity comment-time">1 hr </span>
    <div class="w3-card w3-round w3-white">
      <div class="w3-container w3-padding">
        <img src=<?php echo $_SESSION['user_img']?> class="w3-left w3-circle w3-margin-right" style="width:60px">
        <h5>김하람</h5><br>
        <p contenteditable="true" class="w3-border w3-padding"> 영어 공부를 정말 재밌게 가르치세요 너무 재밌게 배웠어요.</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom">수정하기</button>
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom">삭제하기 </button>
      </div>
    </div>
  </div>
</div>
</div>
<!-- 수정해보기 -->


  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <p>과외는 어땠나요?</p>
    <hr class="w3-clear">
    <div class=" w3-round w3-white">
        <p contenteditable="true" class="w3-border w3-padding"> 리뷰를 남겨주세요.</p>
        <button type="button" class="w3-right w3-opacity w3-button w3-theme-d1 w3-margin-bottom"> 리뷰 남기기</button>
  </div>
<!-- End Middle Column -->
</div>
</div>

<!-- Right Column -->
<!--
<div class="w3-col m2">
  <div class="w3-card w3-round w3-white w3-center">
    <div class="w3-container">
      <p>Upcoming Events:</p>
      <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
      <p><strong>Holiday</strong></p>
      <p>Friday 15:00</p>
      <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
    </div>
  </div>
  <br>

  <div class="w3-card w3-round w3-white w3-center">
    <div class="w3-container">
      <p>Friend Request</p>
      <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
      <span>Jane Doe</span>
      <div class="w3-row w3-opacity">
        <div class="w3-half">
          <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
        </div>
        <div class="w3-half">
          <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
        </div>
      </div>
    </div>
  </div>
  <br>

  <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
    <p>ADS</p>
  </div>
  <br>

  <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
    <p><i class="fa fa-bug w3-xxlarge"></i></p>
  </div>
-->
<!-- End Right Column -->
</div>
