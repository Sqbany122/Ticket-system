

	function CaseBtn(id, description){
		var $toggle = 0;
		var case_btn = $("#case_" + id + "");

		case_btn.click(function() {
			if ($toggle == 0){
				$("#description_" + id + "").html('<div class="ticket-description-inside">' + description + '</div>');
				$toggle = 1;
			}else{
				$("#description_" + id + "").html('');
				$toggle = 0;
			}
		});
	}