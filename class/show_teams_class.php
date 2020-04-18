<?php 

	class ShowTeams {

		public $teamID = array();
		public $teamName = array();
		public $count_members;

		public $username = array();
		public $team = array();

		public function __construct($db){
			$result = $db->query("SELECT * FROM teams");

			// zespoły
			foreach ($result as $key => $value) {
				$this->teamID[$key] = $value['id'];
				$this->teamName[$key] = $value['team_name'];
			}

			// liczenie ilości użytkowników z każdego zespołu
			foreach ($this->teamID as $key => $value) {
				$result_members[$key] = $db->query("SELECT count(*) as total FROM user WHERE team = '". $this->teamID[$key] ."'");
			}

			foreach ($result_members as $key => $value) {
				$this->count_members[$key] = $value['total'];
			}

		}

		public function showTeams(){

			$teams = "";

			foreach ($this->teamName as $key => $value) {
				$teams .= "<div class='single-team'><span class='team-name'>".$this->teamName[$key]."</span><span class='count-members'>Liczba członków: ".$this->count_members[$key]."</span></div>";
			}
		
		echo $teams;	
		}			

	}

?>