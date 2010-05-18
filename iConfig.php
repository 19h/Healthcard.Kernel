<?php
	/*
	 * Temporary example database for use in the /IntellectualCommons/Healthcard/ Project..
	 * (c) Kenan Sulayman. ( Portions (c) Thorben B.; Dictaion )
	 */
	final class iDB {
		private $idb = array( // ID =!?= =|= &/@ Pos_or_st_at|of_array()-1
			"Bronchitis",
			"Grippe",
			"Muskelzerrung Schulter",
			"Bruch r. Fuß",
			"Klappenvitium",
			"Innenhautentzündung",
			"Bindehautentzündung",
			"Spastmus",
			"Mittelohrentzündung",
			"Eppilepsie",
			"ALS",
			"ADS",
			"ADHS",
			"Bruch r. Arm",
			"AIDS",
			"SARS",
			"Apallsches Syndrom",
			"Schlaganfall",
			"Herzinfarkt",
			"Trombose",
			"Gespräch"
		);
		private $lastAcc = null;
		
		public function __toString (  ) {
			if ( $this->lastAcc != null ) {
				return isset($this->idb[$this->lastAcc])?$this->idb[$this->lastAcc]:false;
			} else {
				// flag ? | Doesn't occur when called via @Application && Desg.php
				return false;
			}
		}
		
		public function getiDB ( $id ) {
			if ( isset($this->idb[$id-1]) ){
				$this->lastAcc = $id-1;
				return $this->idb[$id-1];
			} else {
				return false;
			}
		}
	}
?>