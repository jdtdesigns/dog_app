<?php 
	$page_title = 'Add Dog';
	session_start();
	$error = false;

	if ( isset($_POST['add'] ) ) {

		$name = $_POST['name'];
		$weight = $_POST['weight'];
		$color = $_POST['color'];
		$breed = $_POST['breed'];

		if ( !$name || !$weight || !$color || !$breed ) $error =  true;

		if ( !$error ) {

			$path = 'dog_data/dogs.xml';
			$xml = simplexml_load_file($path);
			$dogs = $xml->dogs;
			
			$dog = $dogs->addChild('dog');
			$dog->addChild('name', $name);
			$dog->addChild('weight', $weight);
			$dog->addChild('color', $color);
			$dog->addChild('breed', $breed);

			$xml->asXML($path);

			header('Location: index.php');
		}

	}
?>

<?php include_once 'header.php'; ?>

<div class="columns">
	<div class="column is-4 is-offset-4">
		<form id="login" method="post">

			<h1 class="title is-3 has-text-centered">Add Dog</h1>			

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