<!-- 세션 정보 쓰려면 꼭 session_start() 해줘야함. -->
<?php
  session_start();

  // DB 연결
  $conn = new mysqli($_SESSION['DB_host'], $_SESSION['DB_id'], $_SESSION['DB_pw'], $_SESSION['DB_db']);
  if($conn->connect_error){
    die("CONNECTION FAILED! : ". $conn->connect_error);
  }

  // 모든 리뷰글 저장 --> list 로 저장.
  $review_num = 0;
  $review_list = array();
  $load_all_review = "SELECT * FROM Review WHERE state != -1";
  $result = $conn->query($load_all_review);
  if($result->num_rows > 0){ //7개니까 작동은 할텐
    while($row = $result->fetch_assoc()){
      array_push($review_list, $row);
      $review_num++;
    }
  }
  else{
    // echo "review list --> 0 result";
  }


?>

<?php
// 리뷰가 하나 이상 있을 때,
//////////////몇개의 그 튜터나 튜티에 관한 리뷰가 몇개 있는지 알기위해서 ///////////////
  if($review_num != 0){
    for($i = 0; $i < $review_num; $i++){
      $r_id = $review_list[$i]['receiver_id'];
      $get_r_info = "SELECT * FROM User
                    WHERE user_id = '$r_id'";
      $r_result = mysqli_query($conn, $get_r_info);
      $r_info = mysqli_fetch_assoc($r_result);// error why
      //리뷰 적은 writer의 정보 가져오기
      $w_id = $review_list[$i]['writer_id'];
      $get_w_info = "SELECT * FROM User
                    Join Review as R
                    ON R.writer_id = User.user_id
                    WHERE user_id='$w_id'";
      $w_result = mysqli_query($conn, $get_w_info);
      $w_info = mysqli_fetch_assoc($w_result);
      $list_of_w[$i] = $w_info['receiver_id']; //writer들의 리스트 //위에서 꼭 Review 를 조인해줘야지 저 값을 가져 올 수 있는 이유가 뭘까..
      }

    //////// 삭제된 게시글이 아닐 때 화면에 띄운다.///////////////
      if($review_list[$i]['state'] != -1){

        // 리뷰를 당하는 사용자 id로부터 유저정보 가져오기 : ///////이부분이 이제 리뷰 당하는 사람 정보////////
        $r_id = $_SESSION['lookup_id']; //임시로 //이부분 post?
        $get_r_info = "SELECT * FROM User
                        WHERE user_id = '$r_id'";
        $r_result = mysqli_query($conn, $get_r_info);
        $r_info = mysqli_fetch_assoc($r_result);//

        //user의 자걱증 점수 정보
        $get_r_cer_info = "SELECT * FROM Certificate
                          WHERE user_id = '$r_id'";
        $r_cer_result = mysqli_query($conn, $get_r_cer_info);
        $r_cer_info = mysqli_fetch_assoc($r_cer_result);

        //user의 자기소개 정보
        $get_info = "SELECT * FROM Tutor
                          WHERE user_id = '$r_id'";
        $info_result = mysqli_query($conn, $get_info);
        $info = mysqli_fetch_assoc($info_result);
        //writer의 정보
        $w_cnt = 0;
        $w_list = array();
        $load_all_w= "SELECT * FROM User
                      Join Review as R
                      ON R.writer_id = User.user_id
                      WHERE receiver_id=$r_id";
        $writer_result = $conn->query($load_all_w);
        if($writer_result->num_rows > 0){
          while($row = $writer_result->fetch_assoc()){
            array_push($w_list, $row);
            $w_cnt++;
          }
        }
        // else
          // echo "writer list --> ". $cw_cnt ." result";
      }

    }

echo'<div class="w3-col m9">
  <div class="w3-container w3-card w3-round w3-margin review-user-info">
    <img src="'.$r_info['image'].'" class="w3-left w3-circle w3-margin-right" style="width:60px;">
    <span class="w3-right w3-opacity"> </span>
    <h4>' .$r_info['name'];
      if($r_info['is_tutor'] ==1 )echo' Tutor </h4>';
      else echo' Tutee </h4>';
    echo'
    <br>
    <hr class="w3-clear">
      <div class="user-info">';

      if($r_info['is_tutor'] == 1){
        if($r_cer_info['TOEIC'] != NULL)
          echo' <li> TOEIC = '. $r_cer_info['TOEIC'].' </li>';
        if($r_cer_info['TOEFL'] != NULL)
          echo' <li> TOEFL = '. $r_cer_info['TOEFL'].' </li>';
        echo'
          <li> '.$info['specialty'].' </li>';
      }
      else if($r_info['is_tutor'] ==0){
        echo '학생입니다.';
      }
    echo'
      </div>
  </div>';

      echo '<h2> <pre> <strong> 리뷰글 </strong> </pre> </h2>';
  for($i=0; $i< $w_cnt; $i++){
    if($w_list[$i]['state'] != -1){
    if($list_of_w[$i] = $r_id){
      /*
      echo '
      <div class="w3-margin"><br>
        <div class= "w3-round">
          <div class="w3-row-padding">
            <div class="w3-col m12">
              <span class="w3-right w3-opacity comment-time">'.$w_list[$i]['modify_time'].'</span>
              <div class="w3-card w3-round w3-white">
                 <div class="w3-container w3-padding">
                   <img src='.$w_list[$i]['image'].' class="w3-left w3-circle w3-margin-right" style="width:60px">
                  <h5> '.$w_list[$i]['name'].' </h5><br>
                  <p contenteditable="true" class="w3-border w3-padding">'.$w_list[$i]['content'].'</p>';
                //  <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom">수정하기</button>
                //  <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom">삭제하기 </button>
              echo'  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        ';
        */
        $id =100;
        // 자신의 댓글이면 수정 및 삭제하기 활성화 ....
          echo '
          <div class="w3-margin"><br>
            <div class= "w3-round">
              <div class="w3-row-padding">
                <div class="w3-col m12">
                  <span class="w3-right w3-opacity comment-time">'.$w_list[$i]['modify_time'].'</span>
                  <div class="w3-card w3-round w3-white">
                     <div class="w3-container w3-padding">
                       <img src='.$w_list[$i]['image'].' class="w3-left w3-circle w3-margin-right" style="width:60px">
                      <h5> '.$w_list[$i]['name'].' </h5><br>';
                      //<h5> '.$w_list[$i]['name'].' </h5><br>
                      //<p contenteditable="true" class="w3-border w3-padding">'.$w_list[$i]['content'].'</p>';
///////////////////////////
                      if($_SESSION['user_id'] == $w_list[$i]['writer_id']){
                        echo '
                        <form id="modify_review_form_'.$w_list[$i]['review_id'].'_'.$id.'"  method="post" action="../dbConnection/dbConnection_dan.php">
                            <textarea name="review" class="review-input" contenteditable="true" >'.$w_list[$i]['content'].'</textarea>
                            <div class="commment-control">
                              <input id="crudType_'.$w_list[$i]['review_id'].'_'.$id.'" name="crudType" type="hidden" value=""/>
                              <input name="return_location" type="hidden" value="../pages/review.php"/>
                              <input name="writer_id" value="'.$w_list[$i]['writer_id'].'" type="hidden"/>
                              <input name="review_id" value="'.$w_list[$i]['review_id'].'" type="hidden"/>
                              <input type="button" class="review-modify" value="수정하기" onclick="mySubmit(\'modify_review_form_'.$w_list[$i]['review_id'].'_'.$id.'\', \'modify\', \'crudType_'.$w_list[$i]['review_id'].'_'.$id.'\')"/>
                              <input type="button" class="review-delete" value="삭제하기" onclick="mySubmit(\'modify_review_form_'.$w_list[$i]['review_id'].'_'.$id.'\', \'delete\', \'crudType_'.$w_list[$i]['review_id'].'_'.$id.'\')"/>
                            </div>
                          </form>
                        ';
                      }
                      else{
                        echo'
                        <p contenteditable="true" class="review-input">'.$w_list[$i]['content'].'</p>';
                      }
                    //<p contenteditable="true" class="w3-border w3-padding">'.$w_list[$i]['content'].'</p>';

                    //  <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom">수정하기</button>
                    //  <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom">삭제하기 </button>
                  echo'  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            ';


    }
  }
}
$i = 1;
//review insert
echo '
<hr>
<div class="w3-container w3-card w3-white w3-round w3-margin" style="padding-bottom: 1em;"><br>
 <h5>과외는 어땠나요?</h5>
  <hr class="w3-clear">
  <div class=" w3-round w3-white">
    <form id="review_insert_'.$_SESSION['user_id'].'_'.$i.'" method="post" action="../dbConnection/dbConnection_dan.php">
      <input name="crudType_insert" type="hidden" value="review_insert"/>
      <input name="return_location" type="hidden" value="../pages/review.php"/>
      <input name="receiver_id" value="'.$r_id.'" type="hidden"/>
      <input name="writer_id" value="'.$_SESSION['user_id'].'" type="hidden"/>
      <input name="review_input" class="comment-input" type="text" placeholder="리뷰를 남겨주세요." value="">
      <input class="comment-submit" type="button" value="리뷰 남기기" onclick="mySubmit(\'review_insert_'.$_SESSION['user_id'].'_'.$i.'\', \'insert\', 1)"/>
    </form>
  </div>
</div>

      </div>
    </div>
  </div>';

?>



<?php $conn->close(); ?>
