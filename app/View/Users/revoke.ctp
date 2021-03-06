

<?php echo __('Safely Logging you out'); ?>

<?php
switch ($this->Session->read('Auth.User.vendor')) {
	case 'google':
		?>
			<script type="text/javascript">

			var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=<?php echo $this->Session->read("Auth.User.token"); ?>';

			// Perform an asynchronous GET request.
			$.ajax({
				type: 'GET',
				url: revokeUrl,
				async: false,
				contentType: "application/json",
				dataType: 'jsonp',
				success: function(nullResponse) {		
					console.log('out');
					window.location.replace('<?php echo Router::url('/', true); ?>users/logout');
				},
				error: function(e) {
				}
			});

			</script>
		<?php
	break;

	case 'fb':
		?>
			<script>
				FB.init({		
					appId      : '214690735348256',                        // App ID from the app dashboard
					status     : true,                                 // Check Facebook Login status
					xfbml      : true,  
				});
				FB.getLoginStatus(function(response) {
				    FB.logout();
				});
	
				window.location.replace('<?php echo Router::url('/', true); ?>users/logout');
		    </script>
	    <?php
	break;
	
	default:

		?>
			<script>	
				window.location.replace('<?php echo Router::url('/', true); ?>users/logout');
		    </script>
	    <?php
		break;
}