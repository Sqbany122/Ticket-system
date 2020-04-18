<?php 

	class Ticket{

		public $id;
		public $user;
		public $case;
		public $date;
		public $content;

		public function __construct($db){
			$result = $db->query("SELECT * FROM ticket_list ORDER BY data DESC");
			$this->id = $result['id'];
			$this->user = $result['uzytkownik'];
			$this->case = $result['sprawa'];
			$this->date = $result['data'];

			foreach ($result as $row){
				$ticket = "";
				$ticket .= "<div class='w-100' style='height: 40px; display: block; margin-top: 10px;'>
				<div class='p-2' style='width: 220px; height: 40px; float: left; background-color: #e9ecef; border-radius: 5px; margin-right: 2px; text-align: center;'>
					$this->user
				</div>
				<div class='p-2' style='width: 220px; height: 40px; float: left; background-color: #e9ecef; border-radius: 5px; margin-right: 2px; text-align: center;'>
					$this->case
				</div>
				<div class='p-2' style='width: 220px; height: 40px; float: left; background-color: #e9ecef; border-radius: 5px; margin-right: 2px; text-align: center;'>
					$this->date
				</div>";
				$ticket .= "<form method='post'>
					<div style='width: 40px; height: 40px; float: left; border-radius: 5px; text-align: center; background-color: #007bff;'>
						<button name='delete_ticket' style='background: none; border: none; width: 40px; height: 40px; padding: 8px 5px;'><i class='fas fa-times' style='color: white; font-size: 24px;'></i></button>
					</div>
				</form>";
				$ticket .= "</div>";

			$this->content = $ticket;
			}			
		}

		public function print_ticket($print=TRUE){
		
		$ticket = "";

		$ticket .= "$this->content";
		
		
		if($print) 
			echo $ticket;
        else 
        	return $ticket;
		}

	}

?>