<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport"
	content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width=device-width" />
<title>API Demo - Kakao JavaScript SDK</title>
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

</head>
<body>
	<a id="kakao-login-btn"></a>
	<div class="fb-login-button" 
	 	 data-max-rows="1" 
	 	 data-size="xlarge" 
	 	 data-show-faces="false" 
	 	 data-auto-logout-link="false"
	 	 onClick="checkLoginState"></div></br>
	<img src="" id="facebook_pic"/>
	<script type='text/javascript'>
  ////////////////////////////////////////////////
  //  FACEBOOK
  ////////////////////////////////////////////////

	// This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    //console.log('statusChangeCallback');
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      facebookLogin();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '695125843996948',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ko_KR/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function facebookLogin() {
    //console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', {fields: 'picture'}, function(response) {
      //console.log('Successful login for: ' + JSON.stringify(response));
      //console.log('Successful login for: ' + response.picture.data.url);
      document.getElementById('facebook_pic').src = response.picture.data.url;
    });
  }


	//////////////////////////////////////////////// // KAKAO
	//////////////////////////////////////////////// // 키값 세팅
	Kakao.init('1c84ec542928fc148e979faf7cc968b0'); // 로그인버튼 생성
	Kakao.Auth.createLoginButton({ container: '#kakao-login-btn', success:
	function(authObj) { // 유저 정보 요청 
		Kakao.API.request({ 
			url: '/v1/user/me',
		success: function(res) { 
			var result = JSON.stringify(res); 
			result = JSON.parse(result); 
			document.writeln(result.id);
			document.writeln(result.properties.nickname); document.writeln("<img src='" + result.properties.thumbnail_image + "' />");
			document.writeln("<img src='" + result.properties.profile_image + "' />"); 
			}, 
			fail: function(error) { alert(JSON.stringify(error)); } 
			}); 
		}, 
		fail: function(err) { alert(JSON.stringify(err)); 
		} 
	});
	</script>
</body>
</html>