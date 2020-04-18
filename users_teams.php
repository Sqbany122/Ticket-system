<?php 
	include_once('header.php');  
	include_once('class/all_classes.php');
?>

<div class="header_div mt-4 p-2">
	<h1 class="display-3">Użytkownicy</h1>
</div>

<div class="mt-4">
	<?php 
		$showUsers = new UsersInTeam($default_db);
		$showUsers->showSingleUser();
	?>
	
</div>

<?php include_once('footer.php'); ?>