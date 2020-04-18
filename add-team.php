<?php include_once('header.php'); ?>

<div class="header_div mt-4 p-2">
	<h1 class="display-3">Dodaj zespół</h1>
</div>

<form method="post">
	<div class="add-team-box mt-4">
		<input class="add-team-input" type="text" name="teamName" placeholder="Wpisz nazwę zespołu" />
		<div style="clear: both;"></div>
		<input class="submit_button mt-2 mb-3" type="submit" name="submitTeamName" value="Stwórz zespół" />
	</div>
</form>

<?php 

	if (isset($_POST['submitTeamName'])){
		$teamName = $_POST['teamName'];

		$createTeam = "INSERT INTO teams (id, team_name, team_members) VALUES ('','$teamName', '')";
		mysqli_query($polaczenie, $createTeam);
		?>	
		<script>
			window.location.href = "/ticket/add-team.php";
		</script>
		<?php
	}
	
	include_once('footer.php');
?>