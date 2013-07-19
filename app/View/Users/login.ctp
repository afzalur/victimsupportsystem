<?php
/*********************************************************************
 * Copyright (C) 2013 TerraTech Limited (www.terratech.com.bd)
 *
 * This file is part of victimDb project.
 *
 * victimDb can not be copied and/or distributed without the express
 * permission of TerraTech Limited
**********************************************************************/

?>

<!-- FACEBOOK LOGIN -->
<div id="fb-root"></div>
<script>
function fblogin(){
	FB.init({
      appId      : '214690735348256',                        // App ID from the app dashboard
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
  });
	FB.login(function(response) {
      	console.log(response);
      	var access_token = response.authResponse.accessToken;
		window.location.replace('<?php echo Router::url('/', true); ?>users/oauth2/fb/?token=' + access_token);
 }, {scope: 'email'});
}

function fbout(){
	FB.init({		
		appId      : '214690735348256',                        // App ID from the app dashboard
		status     : true,                                 // Check Facebook Login status
		xfbml      : true,  
	});
	FB.getLoginStatus(function(response) {
	    FB.logout();
	});
}


</script>


<!-- GOOGLE LOGIN -->
<script type="text/javascript">
function signinCallback(authResult) {
	if (authResult['access_token']) {
		document.getElementById('signinButton').setAttribute('style', 'display: none');

		window.location.replace('<?php echo Router::url('/', true); ?>users/oauth2/google/?token=' + authResult['access_token']);

	}
}
</script>



<form action="index.php" method="post">

	<h1 align="center" style="font-family:arial; color:#555">ADMIN PANEL</h1>		
	
	<div class="login-fields">
		
		<p>Sign in using your registered account:</p>
		<p></p>
		<div class="field">
			<label for="username">Email:</label>
			<input type="text" id="username" name="login" value="" placeholder="Email" class="login username-field" />
		</div> <!-- /field -->
		
		<div class="field">
			<label for="password">Password:</label>
			<input type="password" id="password" name="pass" value="" placeholder="Password" class="login password-field"/>
		</div> <!-- /password -->
		
	</div> <!-- /login-fields -->
	
	<div class="login-actions">		
							
		<button type="submit" name="submit" class="button btn btn-secondary btn-large">Sign In</button>
		
	</div>
	
	<div style="width:; margin-top:3px; height:px;"></div>
	<br><br>

	<a href="#" onClick="fblogin()"><img src="/img/facebook.png" style="float:left; margin-left:0px; width:96px; height:22px" title="facebook"/></a>


	<a href="#" onClick="fbout()"><img src="/img/yahoo.png" style="float:left; margin-left:24px; width:80px; height:22px" title="yahoo"/></a>


	<span id="signinButton"
	  	style="float:left; margin-left:24px; width:80px; height:22px;">
	  <span
	    class="g-signin"
	    data-callback="signinCallback"
	    data-clientid="928543426576.apps.googleusercontent.com"
	    data-cookiepolicy="single_host_origin"
	    data-requestvisibleactions="http://schemas.google.com/AddActivity"
	    data-scope="https://www.googleapis.com/auth/userinfo.email">
	  </span>
	</span>			

</form>

<!--
<a href="#" onClick="disconnectUser()" >Revoke</a>
-->
