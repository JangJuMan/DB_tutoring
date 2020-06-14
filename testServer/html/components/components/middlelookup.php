<?php session_start(); ?>

<div class="w3-col m9">
  <div class="w3-container w3-card w3-white w3-round w3-margin-left w3-margin-right w3-margin-bottom"><br>
    <div class="w3-container w3-padding">
      <div class="w3-col m12">
        <p style= "text-align: right">
        
          <button type="button" class="w3-button w3-theme write-btn" onclick="location.href='review.php'">리뷰보기</button>
          <h4 class="w3-center"><b>Profile</b></h4>
        </p>
        <p class="w3-center"><img src="<?php echo $_SESSION['user_img']?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>

        <hr class="two">
        <p style= "text-align: left">
          <div style="padding:40px;">
            <div class="w3-container w3-padding">
              <div class="w3-container w3-padding">

                <p><option value=1> 이름: </option></p>
                <p><option value=1> <b>성별:</b> </option></p>
                <p><option value=2> <b>나이:</b> </option></p>
                <p><option value=3> <b>과외경력:</b> </option></p>
                <p><option value=4> <b>학교:</b> </option></p>
                <p><option value=5> <b>토플/토익 점수:</b> </option></p>
                <p><option value=6> <b>e-mail:</b> </option></p>

              </div>
            </div>
          </div>
        </p>
      </div>
    </div>
  </div>



<!— End Middle Column —>
</div>
