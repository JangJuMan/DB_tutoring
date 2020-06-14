<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel = "stylesheet" href = "../../css/login.css"/>
  <style>
    body,h1,h2,h3,h4,h5,h6, p{font-family: "Raleway", sans-serif}
  </style>
  <script src="https://apis.google.com/js/api:client.js"></script>
  <script>
    var googleUser = {};
    var startApp = function() {
      gapi.load('auth2', function(){
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
          client_id: '430211881257-6dt3008e7spopoglad2m906q2kf06vab.apps.googleusercontent.com',
          cookiepolicy: 'single_host_origin',
          // Request scopes in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('customBtn'));
      });
    };
    function attachSignin(element) {
      console.log(element.id);
      auth2.attachClickHandler(element, {},
          function(googleUser) {
            document.querySelector('#a').innerHTML = 'Login Successed';
            document.getElementById('name').innerText = "Signed in: "
            + "Name : " + googleUser.getBasicProfile().getName()
            + "\nEmail : " + googleUser.getBasicProfile().getEmail()
            + "\nGivenName : " + googleUser.getBasicProfile().getGivenName()
            + "\nFamilyName : " + googleUser.getBasicProfile().getFamilyName()
            + "\nImageUrl : " + googleUser.getBasicProfile().getImageUrl();
            document.getElementById("form_name").value = googleUser.getBasicProfile().getName();
            document.getElementById("form_email").value = googleUser.getBasicProfile().getEmail();
            document.getElementById("form_img").value = googleUser.getBasicProfile().getImageUrl();
            submit_btn.style.display = "";
            logout_btn.style.display = "";
          },
          function(error) {
            // 경고메시지 (로그인 팝업 열었다가 닫으면 실행됨)
            // alert(JSON.stringify(error, undefined, 2));
          });

    }
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
          console.log('User signed out.');
          document.querySelector('#a').innerHTML = 'Google Login';
      });
      auth2.disconnect();
      submit_btn.style.display = "none";
      logout_btn.style.display = "none";
    }
  </script>
</head>
<body>
  <!-- In the callback, you would hide the gSignInWrapper element on a
  successful sign in -->
  <div class="login-container">
    <div class="login-title">
      <h1>DB Tutoring Matching System</h1>
    </div>
    <div id="gSignInWrapper" class="login-btn">
      <div id="customBtn" >
          <!-- <span class="icon"></span> -->
          <span id="a" class="customGPlusSignIn" onclick="
          if(this.innerHTML ==='Login Successed') {signOut();} return false;
          "> Google Login </span>
      </div>
    </div>
    <form action="main.php" method="post">
      <input type="hidden" id="form_name" name="user_name" >
      <input type="hidden" id="form_email" name="user_email" >
      <input type="hidden" id="form_img" name="user_img" >
      <input type="submit" id="submit_btn" value="시스템 접속하기" class="submit-btn" style="display:none">
    </form>
    <input type="submit" id="logout_btn" value="로그아웃" class="submit-btn" style="display:none" onclick="signOut();">
    <div id="name"></div>
  </div>
  <script>startApp();</script>
</body>
</html>
