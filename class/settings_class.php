<?php 

	class Settings {

		public $defaultColor;
		public $caseColor;
		public $nightMode;

		public function __construct($db){
			$result = $db->query("SELECT default_case_color, case_color, night_mode FROM user WHERE username = '" . $_SESSION['user'] . "'");

			$this->defaultColor = $result['default_case_color'];
			$this->caseColor = $result['case_color'];
			$this->nightMode = $result['night_mode'];

		}

		public function printDefaultColor() {

			$defaultColorVar = "$this->defaultColor";

		echo $defaultColorVar;
		}

		public function printCaseColor() {
			
			$caseColorVar = "$this->caseColor";

		echo $caseColorVar;	
		}

		public function nightModeChecked() {

			if ($this->nightMode == 1){
				$nightModeChecked = "checked='checked'";
			} else {
				$nightModeChecked = NULL;
			}
			
		echo $nightModeChecked;	
		}

	}

?>