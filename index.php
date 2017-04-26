<?php 

	$page_title = 'Dashboard';
	session_start();
	
	// Check if user is logged in. If not, redirect to login
	$user_logged_in = file_exists('users/' . $_SESSION['username'] . '.xml');
	if ( !$user_logged_in ) header('Location: login.php');

	// Load dogs file and get all data from file 
	$dogs = [];
	$path = 'dog_data/dogs.xml';
	$xml = simplexml_load_file($path);

	// Push all dogs into $dogs array and reverse
	foreach ( $xml->dogs->dog as $dog ) $dogs[] = $dog;
	$dogs = array_reverse($dogs);
?>

<?php include_once 'header.php'; ?>

<div class="tabs">
  <ul>
    <li class="is-active"><a>Dogs Listing</a></li>
  </ul>
</div>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Weight</th>
      <th>Color</th>
      <th>Breed</th>
    </tr>
  </thead>
  <tbody>
		
		<?php // If no dogs are in data, show this message ?>
  	<?php if ( !count($dogs) ) : ?>
  		<tr colspan="4">
	      <td>No Dogs Have Been Added</td>
	    </tr>
	  <?php endif; ?>
		
		<?php // Loop through all dogs and create table row for each ?>
		<?php foreach ( $dogs as $dog ) : ?>
	    <tr>
	      <td><?php echo (string)$dog->name; ?></td>
	      <td><?php echo (string)$dog->weight; ?></td>
	      <td><?php echo (string)$dog->color; ?></td>
	      <td><?php echo (string)$dog->breed; ?></td>
	    </tr>
  	<?php endforeach; ?>
  </tbody>
</table>

<?php include_once 'footer.php'; ?>

