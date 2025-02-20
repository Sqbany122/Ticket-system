<?php 
	include_once('header.php'); 
	include_once('class/all_classes.php');
	$settingsClass = new Settings($default_db);
?>

<div class="header_div mt-4 p-2">
	<h1 class="display-3">Ustawienia</h1>
</div>

<div class="mt-4">
	<form method="post">
		<div class="settings">
			<span class="crit-name">Kolor zwykłej sparwy ( przeźroczysty "transparent" )</span>
			<input class="color-code" type="text" name="defaultColorCode" value="<?php $settingsClass->printDefaultColor(); ?>" />
		</div>
		<div class="settings">
			<span class="crit-name">Kolor sprawy krytycznej ( domyślny "#494949" )</span>
			<input class="color-code" type="text" name="colorCode" value="<?php $settingsClass->printCaseColor(); ?>" />
		</div>
		<div class="settings">
			<span class="crit-name">Tryb nocny</span>
			<div class="wrapper">
			<div class="switch_box box_3">
				<div class="toggle_switch">
					<input type="checkbox" class="switch_3" name="nightMode" value="tak" <?php $settingsClass->nightModeChecked(); ?>>
					<svg class="checkbox" xmlns="http://www.w3.org/2000/svg" style="isolation:isolate" viewBox="0 0 168 80">
					   <path class="outer-ring" d="M41.534 9h88.932c17.51 0 31.724 13.658 31.724 30.482 0 16.823-14.215 30.48-31.724 30.48H41.534c-17.51 0-31.724-13.657-31.724-30.48C9.81 22.658 24.025 9 41.534 9z" fill="none" stroke="#233043" stroke-width="3" stroke-linecap="square" stroke-miterlimit="3"/>
					   <path class="is_checked" d="M132.77 22.348c7.705 10.695 5.286 25.617-5.417 33.327-2.567 1.85-5.38 3.116-8.288 3.812 7.977 5.03 18.54 5.024 26.668-.83 10.695-7.706 13.122-22.634 5.418-33.33-5.855-8.127-15.88-11.474-25.04-9.23 2.538 1.582 4.806 3.676 6.66 6.25z"/>
						<path class="is_unchecked" d="M17 39.482c0-12.694 10.306-23 23-23s23 10.306 23 23-10.306 23-23 23-23-10.306-23-23z"/>
					</svg>
				  </div>
				</div>
			</div>
		</div>
		<input class="submit-btn" type="submit" name="submitBtn" value="Zapisz ustawienia" />
	</form>
</div>

<?php 
	
	if (isset($_POST['submitBtn'])){
		if ($_POST['nightMode'] == 'tak'){
			$nightMode = 1;
		}else {
			$nightMode = 0;
		}
	
		$zap = "UPDATE user SET default_case_color = '" . $_POST['defaultColorCode'] . "', case_color = '".$_POST['colorCode']."', night_mode = '$nightMode' WHERE username = '".$_SESSION['user']."'";
		mysqli_query($polaczenie, $zap);
		?>
		<script>
			window.location.href = "/ticket/settings.php";
		</script>
		<?php
	}

	include_once('footer.php');

?>