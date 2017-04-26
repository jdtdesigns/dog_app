<?php 
	$page_title = 'Add Dog';
	session_start();
	$error = false;

	// If not logged in, redirect to login
	if ( !isset($_SESSION['username']) ) header('Location: /login.php');

	// If add form submitted, add a dog to data
	if ( isset($_POST['add'] ) ) {

		// Escape all input received
		$name = htmlspecialchars($_POST['name']);
		$weight = htmlspecialchars($_POST['weight']);
		$color = htmlspecialchars($_POST['color']);
		$breed = htmlspecialchars($_POST['breed']);

		// Check all inputs for values. If no value, throw error
		if ( !$name || !$weight || !$color || !$breed ) $error =  true;

		if ( !$error ) {
			// Pull in the dog data file
			$path = 'dog_data/dogs.xml';
			$xml = simplexml_load_file($path);
			$dogs = $xml->dogs;
			
			// Create new dog in data file based on user input
			$dog = $dogs->addChild('dog');
			$dog->addChild('name', $name);
			$dog->addChild('weight', $weight);
			$dog->addChild('color', $color);
			$dog->addChild('breed', $breed);

			// Save data file
			$xml->asXML($path);

			// Redirect to dashboard
			header('Location: /index.php');
		}

	}
?>

<?php include_once 'header.php'; ?>

<div class="columns">
	<div class="column is-4 is-offset-4">
		<form id="login" method="post">

			<h1 class="title is-3 has-text-centered">Add Dog</h1>			
			<?php // Show error if any inputs were empty ?>
			<?php if ($error) : ?>
				<p class="error">Please fill out all fields</p>
			<?php endif; ?>			

			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="text" placeholder="Name" name="name">
			    <span class="icon is-small is-left">
			      <i class="fa fa-square-o"></i>
			    </span>
			  </p>
			</div>

			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="text" placeholder="Weight" name="weight">
			    <span class="icon is-small is-left">
			      <i class="fa fa-square-o"></i>
			    </span>
			  </p>
			</div>

			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="text" placeholder="Color" name="color">
			    <span class="icon is-small is-left">
			      <i class="fa fa-square-o"></i>
			    </span>
			  </p>
			</div>

			<div class="field">
			  <p class="control has-icons-left">
			    <input class="input" type="text" placeholder="Breed" name="breed">
			    <span class="icon is-small is-left">
			      <i class="fa fa-square-o"></i>
			    </span>
			  </p>
			</div>

			<div class="field">
			  <p class="control">
			    <button class="button is-success is-fullwidth is-medium" type="submit" name="add">
			      Submit
			    </button>
			  </p>
			</div>

		</form>
	</div>
</div>

<?php include_once 'footer.php'; ?>