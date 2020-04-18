<?php 
	
	include_once('../config/config.php');

	if ($polaczenie->connect_error){
			die('Failed: '. $polaczenie->connect_error);
	}

	$dark_mode = "SELECT default_case_color, case_color, night_mode FROM user WHERE username = '".$_SESSION['user']."'";
    $dark_mode_res = mysqli_query($polaczenie, $dark_mode);
    $dark = mysqli_fetch_assoc($dark_mode_res);

    $dark_style = 'style="background-image: linear-gradient(to right, '.$dark['case_color'].', rgba(255,0,0,0));"';
    $dark_style_default = 'style="background-image: linear-gradient(to right, '.$dark['default_case_color'].', rgba(255,0,0,0));"';

		$zapytanie  = "SELECT * FROM ticket_list";
		$result = mysqli_query($polaczenie, $zapytanie);
		$rows = mysqli_num_rows($result);
		$i = 1;
		while($row = $result->fetch_assoc()) {
			$_SESSION['id'] = $row['id'];
			preg_match('@([0-9]++):([0-9]++):@Usmi',$row['data'],$data);
			?>
			<div class="ticket-box-inside w-100 <?php if ($row['typ_sprawy'] == '1' && $dark['case_color'] == 'LightGrey'){ echo 'fast_case';} ?>" <?php if ($row['typ_sprawy'] == '1' && $dark['case_color'] != 'LightGrey') { echo $dark_style; } ?> <?php if ($dark['default_case_color'] == 'transparent') { }else{ echo $dark_style_default; } ?> id="case_<?php echo $row['id']; ?>">
				<div class="ticket-item-counter">
					<?php echo $i; ?>
				</div>
				<div class="ticket-item-username"> 
					<?php echo $row['uzytkownik']; ?>
				</div>
				<div class="ticket-irem-sprawa">
					<?php echo $row['sprawa']; ?>
				</div>
				<?php 
					if ($_SESSION['permision'] == '1'){
						echo '<div class="ticket-item-hour-admin">'.$data[1].':'.$data[2].'</div>';
						echo '<div class="ticket-item-delete"><a href="?usun=tak&id='.$row['id'].'"><i class="fas fa-times"></i></a></div>';
					} elseif($_SESSION['permision'] == '0'){
						echo '<div class="ticket-item-hour">'.$data[1].':'.$data[2].'</div>';
					}
				?>
			</div>
				<div class="ticket-description" id="description_<?php echo $row['id']; ?>"></div>
				<script type="text/javascript">
					var id_ = '<?php echo $_SESSION['id']; ?>';
					var description = '<?php echo $row['description']; ?>';
					var cBtn = new CaseBtn(id_, description);
				</script>
		<?php 
		$i++;	
	}

	mysqli_close($polaczenie);
?>