<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<?php session_start(); ?>

<!-- <div class="w3-col m7"> -->
<div class="w3-col m9">

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

  <!-- 게시글 1번  -->
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:50px">
    <span class="w3-right w3-opacity">DB.Bbs.modifyTime</span>
    <h4><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></h4><br>
    <h4>DB.Bbs.Title</h4>
    <hr class="w3-clear">
    <p>DB.Bbs.content</p>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half">
        </div>
        <div class="w3-half">
      </div>
    </div>
    <div id="bbs1_additional" class="w3-container w3-round bbs-comment" style="display:none">
      <hr>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohell ohellohellohellohellohellohellohellohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohllohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohelloheohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
    </div>
    <button id="bbs1_like" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
    <button id="bbs1_comment" type="button" class="w3-button w3-theme-d2 w3-margin-bottom" onclick="openComment('bbs1_additional', 'bbs1_comment')"><i class="fa fa-comment"></i>  Comment</button>
  </div>

  <!-- 게시글 2번  -->
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:50px">
    <span class="w3-right w3-opacity">DB.Bbs.modifyTime</span>
    <h4><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></h4><br>
    <h4>DB.Bbs.Title</h4>
    <hr class="w3-clear">
    <p>DB.Bbs.content</p>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half">
        </div>
        <div class="w3-half">
      </div>
    </div>
    <div id="bbs2_additional" class="w3-container w3-round bbs-comment" style="display:none">
      <hr>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohell ohellohellohellohellohellohellohellohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohllohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohelloheohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
    </div>
    <button id="bbs2_like" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
    <button id="bbs2_comment" type="button" class="w3-button w3-theme-d2 w3-margin-bottom" onclick="openComment('bbs2_additional', 'bbs2_comment')"><i class="fa fa-comment"></i>  Comment</button>
  </div>

  <!-- 게시물 3번  -->
  <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
    <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:50px">
    <span class="w3-right w3-opacity">DB.Bbs.modifyTime</span>
    <h4><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></h4><br>
    <h4>DB.Bbs.Title</h4>
    <hr class="w3-clear">
    <p>DB.Bbs.content</p>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half">
        </div>
        <div class="w3-half">
      </div>
    </div>
    <div id="bbs3_additional" class="w3-container w3-round bbs-comment" style="display:none">
      <hr>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohellohell ohellohellohellohellohellohellohellohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohellohellohellohellohllohellohellohellohellohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
      <div class="comment-container">
        <img src="<?php echo $_SESSION['user_img']?>" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
        <p class="comment-writer"><?php echo $_SESSION['user_name']; if(1 == 1){echo "(튜터)";}else{echo "(튜티)";}?></p>
        <p class="comment-text">hellohellohellohellohellohelloheohello</p>
        <p class="comment-time">18:04</p>
        <div class="comment-control">
          <a class="comment-modify">수정하기</a>
          <a class="comment-delete">삭제하기</a>
        </div>
      </div>
    </div>
    <button id="bbs3_like" type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
    <button id="bbs3_comment" type="button" class="w3-button w3-theme-d2 w3-margin-bottom" onclick="openComment('bbs3_additional', 'bbs3_comment')"><i class="fa fa-comment"></i>  Comment</button>
  </div>

<!-- End Middle Column -->
</div>

<!-- Right Column (Not used) -->
<!-- <div class="w3-col m2">
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

[ End Right Column ]
</div> --->
