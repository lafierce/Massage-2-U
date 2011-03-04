<?php
// PROGRAMMER Joshua La Force http://www.laforce.com/ 866-691-6794 josh@laforce.com
// get variables out of superglobals and set back to original names

$ArrayList = array($_SERVER,$_COOKIE,$_POST,$_GET,$_FILES);
for ($zZz=0;$zZz<count($ArrayList);$zZz++) {
	if (isset($ArrayList[$zZz])) {
		extract($ArrayList[$zZz],EXTR_OVERWRITE);
	}
}

?>
