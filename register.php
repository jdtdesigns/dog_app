<?php 
	$page_title = 'Register';
	session_start();
	$errors = [];

	// If logged in, redirect to dashboard
	if ( $_SESSION['username'] ) header('Location: index.php');

	// If register form submitted, try register
	if ( isset($_POST['register'] ) ) {

		// Secure user input
		$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];

		// If user already exists, fire error
		if ( file_exists('users/' . $username . '.xml') ) {
			$errors[] = 'Username already exists';
		}

		// Validate inputs have a value
		if ( !$username ) $errors[] = 'Please enter a Username';

		if ( !$password || !$confirm ) $errors[] = 'Please fill in password and confirmation';

		if ( $password != $confirm ) $errors[] = 'Passwords do not match';

		// If no errors, create user
		if ( !count($errors) ) {

			// Create user element and save to user file
			$xml = new SimpleXMLElement('<user></user>');
			$xml->addChild('username', $username);
			$xml->addChild('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
			$xml->asXML('users/' . $username . '.xml');

			// Save username to session for route binding and dashboard use
			$_SESSION['username'] = $username;
			header('Location: index.php');

		}

	}
?>

<?php include_once 'header.php'; ?>

<div class="columns">
	<div class="column is-4 is-offset-4">
		<form id="login" method="post">

			<h1 class="title is-3 has-text-centered">Register</h1>			
			<?php // If any errors, loop through array and show all of them ?>
			<?php if ( count($errors) ) : ?>
				<ul>
					<?php foreach ( $errors as $error ) : ?>
						<li class="error"><?php echo $error; ?></li>
					<?php endforeach; ?>
				</ul>
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
			  <p class="control has-icons-left">
			    <input class="input" type="password" placeholder="Confirm Password" name="confirm">
			    <span class="icon is-small is-left">
			      <i class="fa fa-lock"></i>
			    </span>
			  </p>
			</div>

			<div class="field">
			  <p class="control">
			    <button class="button is-success is-fullwidth is-medium" type="submit" name="register">
			      Submit
			    </button>
			  </p>
			</div>

		</form>
	</div>
</div>

<?php include_once 'footer.php'; ?>
