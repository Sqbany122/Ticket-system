<?php include_once('header.php'); ?>

	<div class="header_div mt-4 p-2">
		<h1 class="display-3">Dodaj ticket</h1>
	</div>

	<form method="post">
		<div class="add-ticket-box mt-4 p-2">
			<h3 class="h3-header display-3 mt-2">Wybierz temat ticket'u</h3>
				<select class="case-list" name="cars">
				  <option value="Sprawa techniczna">Sprawa techniczna</option>
				  <option value="Kwas">Kwas</option>
				  <option value="Inna">Inna</option>
				</select>
			<div style="clear: both;"></div>
			<textarea  class="add-ticket-texarea" name="description"></textarea>
			<div style="clear: both;"></div>
			<div class="fast-case-checkbox">
				<input type="checkbox" id="cbx" name="kryt" style="display: none;">
					<label for="cbx" class="check">
					  <svg width="30px" height="30px" viewBox="0 0 18 18">
					    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
					    <polyline points="1 9 7 14 15 4"></polyline>
					  </svg>
					</label>Sprawa szybka
			</div>	
			<div style="clear: both;"></div>

			<input type="submit" name="submit_btn" value="Dodaj" class="submit_button mt-2 mb-3" />
		</div>
	</form>
	<?php 

	if (isset($_POST['submit_btn'])){
		$sprawa = $_POST['cars'];
		$user = $_SESSION['user'];
		$description = nl2br($_POST['description']);
		if (isset($_POST['kryt'])){
			$zapytanie = "INSERT INTO ticket_list (id, uzytkownik, sprawa, description ,typ_sprawy ,data) VALUES ('','$user','$sprawa', '$description' ,'1',NOW())";
		}else{
			$zapytanie = "INSERT INTO ticket_list (id, uzytkownik, sprawa, description ,data) VALUES ('','$user','$sprawa', '$description' ,NOW())";
		}
		mysqli_query($polaczenie, $zapytanie);
		?>
		<script>
			window.location.href = "/ticket/";
		</script>
		<?php 	
	}
	?>

<?php include_once('footer.php') ?>