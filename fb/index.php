<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Demo Facebook Login Javascript</title>
</head>
<body>
    <script>
        // Init application
        window.fbAsyncInit = function () {
            FB.init({
                appId: '554020094959929', // Đổi App ID của bạn ở đây
                cookie: true,
                xfbml: true,
                version: 'v2.5'
            });
            // Kiểm tra trạng thái hiện tại
        };
        
         function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
            }
        

        // Xử lý trạng thái đăng nhập
        function statusChangeCallback(response) {
            // Người dùng đã đăng nhập FB và đã đăng nhập vào ứng dụng
            if (response.status === 'connected') {
                ShowWelcome();
            }
            // Người dùng đã đăng nhập FB nhưng chưa đăng nhập ứng dụng
            else if (response.status === 'not_authorized') {
                ShowLoginButton();
            }
            // Người dùng chưa đăng nhập FB
            else {
                ShowLoginButton();
            }
        }

        // Gửi yêu cầu đăng nhập tới FB
        function RequestLoginFB() {
            window.location = 'http://graph.facebook.com/oauth/authorize?' + 'client_id=554020094959929&scopes=' + // Đổi App ID của bạn ở đây
'public_profile,email,user_likes&redirect_uri=http://heartofdarknessbrewery.com/';
        }

        // Hiển thị nút đăng nhập
        function ShowLoginButton() {
            document.getElementById('btb').setAttribute('style', 'display:block');
            document.getElementById('lbl').setAttribute('style', 'display:none');
        }

        // Chào mừng người dùng đã đăng nhập
        function ShowWelcome() {
            document.getElementById('btb').setAttribute('style', 'display:none');            
            FB.api('/me', function (response) {
                var name = response.name;
                var id = response.id;
                var email = response.email;
                createCookie('fb_acc', id, 24);
                document.getElementById('lbl').innerHTML = 
				'<h4>You are logged with:</h4>Name: ' + name + ' <br/>Facebook ID: ' + id + ' <br/>Facebook ID: ' + email;
                document.getElementById('lbl').setAttribute('style', 'display:block');
            });
        }

    </script>
    <div id="fb-root"></div>
    <script>
    // Load facebook SDK
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&"
 + "version=v2.7&appId=554020094959929"; // Đổi App ID của bạn ở đây
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    

    <!-- Nút đăng nhập -->
    <!--\\<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button> !-->
    
    <input id="btb" type="button" value="Login with Facebook" onclick="checkLoginState()" >
    <p id="lbl">BẠN ĐÃ ĐĂNG NHẬP FB rồi</p>
    
    <script type="text/javascript" src="http://heartofdarknessbrewery.com/common/js/cookies.js"></script>
</body>
</html>