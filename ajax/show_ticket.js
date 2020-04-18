
	function Ticket_list(id){
		console.log(id);
		$("#delete_" + id + "").click(function(){
			$.ajax({
				url:"ajax/show_ticket.php",
				type:"post",
				data:{
					id:id,
					type:'delete',
				},
				success:function(){
					console.log(id);
				}
			});
		});
	}