<?php 
	$page_title = 'Login';
	$error = false;
	session_start();

	// If logged in, redirect to dashboard
	if ( $_SESSION['username'] ) header('Location: index.php');

	// If login form submitted, try login
	if ( isset($_POST['login']) ) {

		// Secure input values
		$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
		$password = htmlspecialchars($_POST['password']);

		// If user file exists, fire log in
		if ( file_exists('users/' . $username . '.xml') ) {
			
			// Set user file path
			$path = 'users/' . $username . '.xml';
			
			// Get user file
			$xml = new SimpleXMLElement($path, 0, true);
			
			// Verify password
			if ( password_verify($password, $xml->password) ) {
				session_start();
				// Save username to session for route binding and dashboard use
				$_SESSION['username'] = $username;
				// Redirect to dashboard
				header('Location: index.php');
				// Stop code processing and exit
				die;

				// If any input errors, show error
			} else $error = true;
		}
	}

	
?>

<?php include_once 'header.php'; ?>

<div class="columns">
	<div class="column is-4 is-offset-4">
		<form id="login" method="post">

			<h1 class="title is-3 has-text-centered">Login</h1>
			
			<?php // Show error ?>
			<?php if ($error) : ?>
				<p class="error">Invalid Credentials</p>
			<?php endif; ?>			

			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="text" placeholder="Username" name="username">
			    <span class="icon is-small is-left">
			      <i class="fa fa-envelope"></i>
			    </span>
			  </p>
			</div>
			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="password" placeholder="Password" name="password">
			    <span class="icon is-small is-left">
			      <i class="fa fa-lock"></i>
			    </span>
			  </p>
			</div>
			<div class="field">
			  <p class="control">
			    <button class="button is-success is-fullwidth is-medium" type="submit" name="login">
			      Login
			    </button>
			  </p>
			</div>
		</form>
	</div>
</div>
	
<?php include_once 'footer.php'; ?>