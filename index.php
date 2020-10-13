<?php
require "login.php";
?>
<link rel="stylesheet" type="text/css" href="login.css">
<main>
	<section>
		<?php  
			if(isset($_SESSION['userid'])){
				echo '<p class="success">You are logged in </p>';
			}else{
				#echo '<p class="success">You are logged out</p>';
			}
		?>
		
	</section>
</main>