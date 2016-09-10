<?php
	function betolt_adat($fajlnev) {
		$s = file_get_contents($fajlnev);
		return json_decode($s, true);
	}

	function fajlba_mentes($fajlnev, $adat) {
		$s = json_encode($adat);
		return file_put_contents($fajlnev, $s, LOCK_EX);
	}
?>