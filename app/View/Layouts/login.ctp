
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>
    	<?php
    	echo $title_for_layout; 
    	?>
    	 | Victim Support
	</title>

        
    <?php
    echo $this->Html->css(
    	array(
    		'bootstarp',
    		'bootstrap-responsive',
    		'bootstrap-overrides',
    		'ui-lightness/jquery-ui-1.8.21.custom',
    		'slate',
    		'components/signin',
    		)
    	);
	//JS files
    echo $this->Html->script(
    	array(
    		'jquery-1.7.2.min',
    		'jquery-ui-1.8.18.custom.min',
    		'jquery.ui.touch-punch.min',
    		'demos/signin',
    		));
?>


<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');

?>
    <script src="//connect.facebook.net/en_US/all.js"></script>


</head>

<body>
<div style="width:100%; margin-top:; background-color:#263849; height:50px; margin-left:auto; margin-right:auto; background-image:url(img/title-2.png); background-repeat:no-repeat;"></div>


<div class="account-container login" style="">

	
	<div class="content clearfix">
		<?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <!--
		<form action="index.php" method="post">
			
			<h1 align="center" style="font-family:arial; color:#555">ADMIN PANEL</h1>		
			
			<div class="login-fields">
				
				<p>Sign in using your registered account:</p>
				<p><?php echo $con; ?></p>
				<div class="field">
					<label for="username">Username:</label>
					<input type="text" id="username" name="login" value="" placeholder="Username" class="login username-field" />
				</div> 
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="pass" value="" placeholder="Password" class="login password-field"/>
				</div> 
				
			</div> 

			<div class="login-actions">
				
				
									
				<button type="submit" name="submit" class="button btn btn-secondary btn-large">Sign In</button>
				
			</div>
			
			<div style="width:; margin-top:3px; height:px;"></div>
			<br><br><a href="http://www.facebook.com"><img src="img/facebook.png" style="float:left; margin-left:0px; width:96px; height:22px" title="facebook"/></a>
			<a href="http://www.yahoo.com"><img src="img/yahoo.png" style="float:left; margin-left:24px; width:80px; height:22px" title="yahoo"/></a>
			<a href="http://www.google.com"><img src="img/google.png" style="float:left; margin-left:24px; width:80px; height:22px" title="google"/></a>
			
					
		</form>
		-->
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box 
<div class="login-extra">
	Forgot password? <a href="#">Click here</a>
</div>--> <!-- /login-extra -->

<?php echo $this->element('sql_dump'); ?>
</body>


   <!-- Place this asynchronous JavaScript just before your </body> tag -->
    <script type="text/javascript">
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client:plusone.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
    </script>
        
</html>
