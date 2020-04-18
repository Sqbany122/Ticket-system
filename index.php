<?php include_once('header.php'); ?>

<div class="header_div mt-4 p-2">
	<h1 class="display-3">Lista ticketów</h1>
</div>
	
	<div class="ticket_box_before mt-4 w-100">
		<div class="ticket-item-counter-static bg-black">Nr</div>
		<div class="ticket-item-username-static bg-black">Imię</div>
		<div class="ticket-irem-sprawa-static bg-black">Typ sprawy</div>
		<?php 
			if ($_SESSION['permision'] == '1'){
				echo '<div class="ticket-item-hour-admin-static bg-black">Godzina</div>';
				echo '<div class="ticket-item-delete-static bg-black"></div>';
			} elseif($_SESSION['permision'] == '0'){
				echo '<div class="ticket-item-hour-admin-static-permision bg-black">Godzina</div>';
			}
		?>
	</div>

	<div class="ticket_box w-100" id="siema">
	</div>


		<script>		
			var id = '<?php echo $_SESSION['id']; ?>';
			
			function show_ticket(){

				$(document).ready(function(){
					$.ajax({
						url:"ajax/show_ticket.php",
						type:"post",
						data:{
							type:'show',
						},
						success:function(responsedata){
							$('#siema').html(responsedata);
						}
					});
				});
				setTimeout(show_ticket, 15000);	
			}
			show_ticket();  
		</script>

		<?php
		if ($_GET['usun'] == 'tak'){
			mysqli_query($polaczenie,"DELETE FROM ticket_list WHERE id='".$_GET['id']."';");
		}
	?>
<?php include_once('footer.php') ?>