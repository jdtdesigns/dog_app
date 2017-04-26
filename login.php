<?php 
	$page_title = 'Login';
	$error = false;

	if ( isset($_POST['login']) ) {

		$username = preg_replace('/[^A-Za-z]/', '', $_POST['username']);
		$password = $_POST['password'];

		if ( file_exists('users/' . $username . '.xml') ) {

			$path = 'users/' . $username . '.xml';

			$xml = new SimpleXMLElement($path, 0, true);
			

			if ( password_verify($password, $xml->password) ) {
				echo 'yep';
				session_start();
				$_SESSION['username'] = $username;
				header('Location: index.php');
				die;

			} else $error = true;
		}
	}

	
?>

<?php include_once 'header.php'; ?>

<div class="columns">
	<div class="column is-4 is-offset-4">
		<form id="login" method="post">

			<h1 class="title is-3 has-text-centered">Login</h1>

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