<?php 
	
	class UsersInTeam {

		public $userID;
		public $singleUser;
		public $selectName;
		public $userTeamID;

		public $teamID;
		public $teamName;
		public $teamNamePlaceholder;

		public function __construct($db){
			$result = $db->query("SELECT id, username, team FROM user");
			$resultTeams = $db->query("SELECT id, team_name  FROM teams");
			$resultUserName = $db->query("SELECT team_name FROM teams INNER JOIN user ON teams.id = user.team");

			// POBIERANIE DO ZMIENCYCH ID, NAZWY UŻYTKOWNIKA ORAZ ID TEAMU Z TABELI users.
			foreach ($result as $key => $value) {
				$this->userID[$key] = $value['id'];
				$this->singleUser[$key] = $value['username'];
				$this->userTeamID[$key] = $value['team'];
			}
			
			// POBIERANIE DO ZMIENNEJ ID ORAZ NAZWY TEAMU Z TABELI teams.
			foreach ($resultTeams as $key => $value) {
				$this->teamID[$key] = $value['id'];
				$this->teamName[$key] = $value['team_name']; 
			}

			// POBIERANIE DO ZMIENNEJ ID UŻYTKOWNIKA, KTÓRE POSŁUŻY DO ZRÓŻNICOWANIA NAZW LIST W FORMULARZU.
			foreach ($this->userID as $key => $value){
				$this->selectName[$key] = "teamList_".$this->userID[$key]."";	
			}

			// WYSYŁANIE DO BAZY ZAPYTANIA, KTÓRE UPDATUJE ZESPÓŁ DO JAKIEGO PRZYPISANY JEST DANY UŻYTKOWNIK.
			foreach ($this->selectName as $key => $value){
				if ($_POST[$this->selectName[$key]]){
					$db->query("UPDATE user SET team = '" . $_POST[$this->selectName[$key]] . "' WHERE username = '" . $this->singleUser[$key] . "'");
					?>
						<script>
							window.location.href = "/ticket/users_teams.php";
						</script>
					<?php 
				}
			}

			// POBIERANIE NAZWY TEAMU DO WYŚWIETLENIA JAKO PLACEHOLDER W LIŚCIE.
			foreach ($resultUserName as $key => $value) {
				$this->teamNamePlaceholder[$key] = $value['team_name'];
			}

		}

		public function showSingleUser() {

			$singleUserVar = "";

			$singleUserVar .= "<form method='post'>";

			foreach ($this->singleUser as $key => $value) {
				$singleUserVar .= "<div class='single-user'>
					<span class='team-name'>" . $this->singleUser[$key] . "</span>
					<span>
						<select class='team-select-list' name='". $this->selectName[$key] ."'>";

						if ($this->userTeamID[$key] == 0) {
							$singleUserVar .= "<option value='' disabled selected hidden>Wybierz team</option>";
						} else {
							$singleUserVar .= "<option value='' disabled selected hidden>".$this->teamNamePlaceholder[$key]."</option>";
						}
													
						foreach ($this->teamName as $key => $value) {				
							$singleUserVar .= "<option value='" . $this->teamID[$key] . "'>" . $this->teamName[$key] . "</option>";
						}
				$singleUserVar .= "</select>
					</span>
				</div>";

			}

			$singleUserVar .= "<input class='submit-btn' type='submit' name='submitBtn' value='Zmień przypisanie użytkowników' /></form>";

		
		echo $singleUserVar;
		}
	}

?>