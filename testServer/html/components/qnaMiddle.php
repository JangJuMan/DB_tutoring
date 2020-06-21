<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // 모든 게시글 불러오기 --> list 로 저장.
  $bbs_cnt = 0;
  $bbs_list = array();
  if($_SESSION['search_title'] != null){

    // title 검색  + payment 검색
    $title = $_SESSION['search_title'];

    $load_all_bbs = "SELECT * FROM Bbs WHERE state = 2 AND title LIKE '%$title%'";

    // ORDER BY (맨 마지막에 추가할 것)
    $load_all_bbs = $load_all_bbs . " ORDER BY bbs_Id DESC";
    $_SESSION['sql'] = $load_all_bbs;
  }
  else{
    $load_all_bbs = "SELECT * FROM $_SESSION[bbs_table] WHERE state = 2 ORDER BY bbs_Id DESC";
  }
  $result = $conn->query($load_all_bbs);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($bbs_list, $row);
      $bbs_cnt++;
    }
  }

?>

<!-- <div class="w3-col m7"> -->
<div class="w3-col m9">
  <form name="search_form" method="post" action="">
    <div class="w3-row-padding filter">
      <div class="w3-col m12">
        <div class="w3-card w3-round w3-white">
          <div class="w3-container w3-padding">
            <h6 class="w3-opacity">Filter to Find</h6>
            <div class="check-box-container">
              <?php if($_SESSION['now'] == "tutoring"){ ?>
                <label class="check-box-label">월  </label> <input name="mon" class="check-box" type="checkbox" <?php if($_SESSION['mon'] != 0){echo "checked";}?> >
                <label class="check-box-label">화  </label> <input name="tue" class="check-box" type="checkbox" <?php if($_SESSION['tue'] != 0){echo "checked";}?> >
                <label class="check-box-label">수  </label> <input name="wed" class="check-box" type="checkbox" <?php if($_SESSION['wed'] != 0){echo "checked";}?> >
                <label class="check-box-label">목  </label> <input name="thr" class="check-box" type="checkbox" <?php if($_SESSION['thr'] != 0){echo "checked";}?> >
                <label class="check-box-label">금  </label> <input name="fri" class="check-box" type="checkbox" <?php if($_SESSION['fri'] != 0){echo "checked";}?> >
                <label class="check-box-label">토  </label> <input name="sat" class="check-box" type="checkbox" <?php if($_SESSION['sat'] != 0){echo "checked";}?> >
                <label class="check-box-label">일  </label> <input name="sun" class="check-box" type="checkbox" <?php if($_SESSION['sun'] != 0){echo "checked";}?> >
              </div>
              <div class="check-box-container">
                <label class="check-box-label">튜터링 종류: </label>
                <select class="dropdown" name="is_tutee">
                  <option value=0 <?php if($_SESSION['is_tutee'] == 0){echo "selected";}?> >상관없음</option>
                  <option value=1 <?php if($_SESSION['is_tutee'] == 1){echo "selected";}?> >튜터를 구합니다.</option>
                  <option value=2 <?php if($_SESSION['is_tutee'] == 2){echo "selected";}?> >튜티를 구합니다.</option>
                </select>
                <label class="check-box-label">수업 과목: </label>
                <select class="dropdown" name="subject">
                  <option value=0 <?php if($_SESSION['subject'] == 0){echo "selected";}?>>상관없음</option>
                  <?php
                  for($i = 0; $i < $sub_cnt; $i++){
                  ?>
                    <option value=<?php echo $sub_list[$i]['sub_id'];?> <?php if($_SESSION['subject'] == $i+1){echo "selected";}?> ><?php echo $sub_list[$i]['sub_name'];?>.</option>
                  <?php
                  }?>
                </select>
                <label class="check-box-label">1시간당 과외비: </label>
                <select class="dropdown" name="payment">
                  <option value=0 <?php if($_SESSION['payment'] == 0){echo "selected";}?> >상관없음</option>
                  <option value=1 <?php if($_SESSION['payment'] == 1){echo "selected";}?> > ~ ₩20,000</option>
                  <option value=2 <?php if($_SESSION['payment'] == 2){echo "selected";}?> >₩20,000 ~ ₩50,000</option>
                  <option value=3 <?php if($_SESSION['payment'] == 3){echo "selected";}?> >₩50,000 ~ </option>
                </select>
              <?php } ?>
              <input name="search_title" placeholder="검색할 게시글의 제목을 입력해주세요." type="text" class="search-input" value="<?php echo $_SESSION['search_title']; ?>">
              <button type="submit" class="w3-button w3-theme write-btn" value="검색하기"><i class="fas fa-search"></i> 검색하기</button>
              <?php
              if($_SESSION['now'] == "tutoring"){
                echo '<button type="button" class="w3-button w3-theme write-btn" onclick="location.href=\'TutorWant.php\'"><i class="fas fa-pencil-alt"></i> 글쓰기</button>';
              }
              else if($_SESSION['now'] == "notice"){
                echo '<button type="button" class="w3-button w3-theme write-btn" onclick="location.href=\'testWriting.php\'"><i class="fas fa-pencil-alt"></i> 글쓰기</button>';
              }
              else if($_SESSION['now'] == "qna"){
                echo '<button type="button" class="w3-button w3-theme write-btn" onclick="location.href=\'qna_jungsup.php\'"><i class="fas fa-pencil-alt"></i> 글쓰기</button>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- 게시글 조회 -->

    <?php
    // 게시글이 하나 이상 있을 때,
    if($bbs_cnt != 0){
      for($i = 0; $i < $bbs_cnt; $i++){
        // 삭제된 게시글이 아닐 때 화면에 띄운다.
        if($bbs_list[$i]['state'] != -1){
          // 게시글 작성자 id로부터 유저정보 가져오기 : 단품으로 가져오기
          $writer_id = $bbs_list[$i]['user_id'];
          $get_writer_info = "SELECT * FROM $_SESSION[user_table] WHERE user_id='$writer_id'";
          $result = mysqli_query($conn, $get_writer_info);
          $writer_info = mysqli_fetch_assoc($result);

          // 해당 게시글의 모든 댓글 불러오기 --> list 로 저장. ($comment_list)
          $bbs_id = $bbs_list[$i]['bbs_Id'];
          $comment_cnt = 0;
          $comment_list = array();
          $load_all_comment = "SELECT * FROM $_SESSION[comment_table] WHERE bbs_id=$bbs_id AND state != -1";
          $comment_result = $conn->query($load_all_comment);
          if($comment_result->num_rows > 0){
            while($row = $comment_result->fetch_assoc()){
              array_push($comment_list, $row);
              // echo "LIST: ".$comment_cnt ." > " . $comment_list[$comment_cnt]['comment_id'];
              $comment_cnt++;
            }
          }else{
            // echo "comment list --> ". $comment_cnt ." result";
          }

          echo '
          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <form id="go_lookup_'.$i.'" name="go_lookup" method="post" action="lookup.php">
              <input name="user_id" type="hidden" value="'.$writer_info['user_id'].'" >
            </form>
            <img src="'. $writer_info['image'] .'" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:50px; cursor:pointer" onclick="document.getElementById(\'go_lookup_'.$i.'\').submit();">
            <span class="w3-right w3-opacity">'. $bbs_list[$i]['modify_time'] .'</span>';
            if($writer_info['is_tutor'] == 1){
              echo '<h4>'.$writer_info['name'].' (튜터)</h4><br>';
            }
            else if($writer_info['is_tutor'] == -1){
              echo '<h4>'.$writer_info['name'].' (관리자)</h4><br>';
            }
            else{
              echo '<h4>'.$writer_info['name'].' (튜티)</h4><br>';
            }

            echo '
            <h4>'. $bbs_list[$i]['title'] .'</h4>
            <hr class="w3-clear">
            <p>'. $bbs_list[$i]['content'] .'</p>
              <div class="w3-row-padding" style="margin:0 -16px">
                <div class="w3-half">
                </div>
                <div class="w3-half">
              </div>
            </div>
            <div id="bbs_additional-'.$i.'" class="w3-container w3-round bbs-comment" style="display:none">
              <hr>';
              for($j=0; $j < $comment_cnt; $j++){
                // 댓글 작성자 id로부터 유저정보 가져오기 : 단품으로 가져오기
                $comment_writer_id = $comment_list[$j]['user_id'];
                $get_comment_writer_info = "SELECT * FROM $_SESSION[user_table] WHERE user_id='$comment_writer_id'";
                $comment_writer_result = mysqli_query($conn, $get_comment_writer_info);
                $comment_writer_info = mysqli_fetch_assoc($comment_writer_result);
                echo '
                  <div class="comment-container">
                    <img src="'. $comment_writer_info["image"] .'" alt="Avatar" class="w3-left w3-circle w3-margin-right comment-img" style="width:30px">
                    <p class="comment-writer">';
                    if($comment_writer_info['is_tutor'] == 1){
                      echo $comment_writer_info['name'].' (튜터)</p><br>';
                    }
                    else if($writer_info['is_tutor'] == -1){
                      echo $comment_writer_info['name'].' (관리자)</p><br>';
                    }
                    else{
                      echo $comment_writer_info['name'].' (튜티)</p><br>';
                    }
                    // 자신의 댓글이면 수정 및 삭제하기 활성화
                    if($_SESSION['user_id'] == $comment_list[$j]['user_id']){
                      echo '
                        <form id="modify_comment_form_'.$i.'_'.$j.'"  method="post" action="../dbConnection/dbConnection.php">
                          <textarea name="comment" class="comment-text-input" >'.$comment_list[$j]['content'].'</textarea>
                          <p class="comment-time">'.$comment_list[$j]['modify_time'].'</p>
                          <div class="comment-control">
                            <input id="crudType_'.$i.'_'.$j.'" name="crudType" type="hidden" value=""/>
                            <input name="return_location" type="hidden" value="../pages/notice.php"/>
                            <input name="comment_id" value="'.$comment_list[$j]['comment_id'].'" type="hidden"/>
                            <input type="button" class="comment-modify" value="수정하기" onclick="mySubmit(\'modify_comment_form_'.$i.'_'.$j.'\', \'modify\', \'crudType_'.$i.'_'.$j.'\')"/>
                            <input type="button" class="comment-delete" value="삭제하기" onclick="mySubmit(\'modify_comment_form_'.$i.'_'.$j.'\', \'delete\', \'crudType_'.$i.'_'.$j.'\')"/>
                          </div>
                        </form>
                      ';
                    }
                    else{
                      echo '
                      <p class="comment-text-input">'.$comment_list[$j]['content'].'</p>
                      <p class="comment-time">'.$comment_list[$j]['modify_time'].'</p>';
                    }
                    echo '
                  </div>
                ';
              }
            echo '
              <div>
                <form id="comment_insert_'.$i.'_'.$j.'" method="post" action="../dbConnection/dbConnection.php">
                  <input name="crudType_insert" type="hidden" value="comment_insert"/>
                  <input name="return_location" type="hidden" value="../pages/notice.php"/>
                  <input name="bbs_id" value="'.$bbs_id.'" type="hidden"/>
                  <input name="user_id" value="'.$_SESSION['user_id'].'" type="hidden"/>
                  <input name="comment_input" class="comment-input" type="text" placeholder="댓글을 입력해주세요" value="">
                  <input class="comment-submit" type="button" value="댓글 등록" onclick="mySubmit(\'comment_insert_'.$i.'_'.$j.'\', \'insert\', 1)"/>
                </form>
              </div>
            </div>';
            // Tutroing의 경우에만 LIKE 허용.
            if($bbs_list[$i]['state'] == 3){
              // 모든 interest 불러오기 --> list 로 저장.
              $interest_cnt = 0;
              $interest_list = array();
              $load_all_interest = "SELECT * FROM $_SESSION[mypage_table] WHERE user_id=$_SESSION[user_id] AND state != -1";
              $interest_result = $conn->query($load_all_interest);
              if($interest_result->num_rows > 0){
                while($row = $interest_result->fetch_assoc()){
                  array_push($interest_list, $row);
                  $interest_cnt++;
                }
              }

              $interest_check = 0;
              for($k=0; $k<$interest_cnt; $k++){
                if($bbs_list[$i]['bbs_Id'] == $interest_list[$k]['interesting_tutoring']){
                  $interest_check = 1;
                  break;
                }
              }

              // 내가 좋아요한 게시글이라면.
              if($interest_check == 1){
                echo '
                  <form id="like_go_false_'.$i.'_'.$j.'" method="post" action="../dbConnection/dbConnection.php">
                    <input name="crudType_like" type="hidden" value="tutoring_like_off"/>
                    <input name="bbs_id" type="hidden" value="'.$bbs_list[$i]['bbs_Id'].'"/>
                    <input name="user_id" type="hidden" value="'.$_SESSION['user_id'].'"/>
                    <input name="return_location" type="hidden" value="../pages/notice.php"/>
                    <button id="bbs_like-'.$i.'" class="w3-button w3-theme-l3 w3-margin-bottom"><i class="fa fa-thumbs-down"></i>  UnLike</button>
                  </form>
                ';
              }
              else{
                echo '
                  <form id="like_go_true_'.$i.'_'.$j.'" method="post" action="../dbConnection/dbConnection.php">
                    <input name="crudType_like" type="hidden" value="tutoring_like_on"/>
                    <input name="bbs_id" type="hidden" value="'.$bbs_list[$i]['bbs_Id'].'"/>
                    <input name="user_id" type="hidden" value="'.$_SESSION['user_id'].'"/>
                    <input name="return_location" type="hidden" value="../pages/notice.php"/>
                    <button id="bbs_like-'.$i.'" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
                  </form>
                ';
              }
            }
            echo'
            <button id="bbs_comment-'.$i.'" class="w3-button w3-theme-d2 w3-margin-bottom" onclick="openComment(\'bbs_additional-'.$i.'\', \'bbs_comment-'.$i.'\')"><i class="fa fa-comment"></i>  Comment</button>
          </div>
          ';
        }
      }
    }
    // 게시글이 하나도 없을 때,
    else{
      echo '
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <h1 class="no-data">게시글이 없습니다.</h1>"
      </div>
      ';
    }
    ?>

<!-- End Middle Column -->
</div>

<?php $conn->close(); ?>
