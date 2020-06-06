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
  $load_all_bbs = "SELECT * FROM $_SESSION[bbs_table] WHERE state != -1";
  $result = $conn->query($load_all_bbs);
  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      array_push($bbs_list, $row);
      $bbs_cnt++;
    }
  }else{
    echo "bbs list --> 0 result";
  }



?>

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
          $load_all_comment = "SELECT * FROM $_SESSION[comment_table] WHERE bbs_id=$bbs_id";
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
            <img src="'. $writer_info['image'] .'" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:50px; cursor:pointer" onclick="location.href=\'review.php\'">
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
                    echo '
                    <p class="comment-text">'.$comment_list[$j]['content'].'</p>
                    <p class="comment-time">'.$comment_list[$j]['modify_time'].'</p>';
                    // 자신의 댓글이면 수정 및 삭제하기 활성화
                    if($_SESSION['user_id'] == $comment_list[$j]['user_id']){
                      echo '
                        <div class="comment-control">
                          <a class="comment-modify">수정하기</a>
                          <a class="comment-delete">삭제하기</a>
                        </div>
                      ';
                    }
                    echo '
                  </div>
                ';
              }
            echo '
              <div>
                <input class="comment-input" type="text" placeholder="댓글을 입력해주세요">
                <input class="comment-submit" type="submit" value="댓글 등록">
              </div>
            </div>
            <button id="bbs_like-'.$i.'" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
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
