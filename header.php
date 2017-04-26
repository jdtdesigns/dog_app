<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.4.1/css/bulma.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="container">

    	<header class="row split">

    		<a href="/">
    			<h2 class="logo">Dog App</h2>
    		</a>

    		<nav>
    			<?php if ( $page_title == 'Login' || $page_title == 'Register' ) {

    				echo $page_title == 'Login' ? '<a href="/register.php">Register</a>' : '<a href="/login.php">Login</a>';    			

    			 } else { ?>

    			 	<div class="nav-controls row y-center">
    			 		<?php if ( $page_title == 'Add Dog' ) : ?>
    			 			<a class="button is-primary" href="/">Dashboard</a>
    			 		<?php else : ?>
    			 			<a class="button is-primary" href="/add-dog.php">Add Dog</a>
    			 		<?php endif; ?>

	    				<div class="drop">
	    					<span class="title is-6">Welcome, <?php echo $_SESSION['username']; ?></span>
	    					<nav>
	    						<a href="/logout.php" class="button is-dark">Logout</a>
	    					</nav>
	    				</div>
    			 	</div>

    			<?php } ?>
    		</nav>

    	</header>