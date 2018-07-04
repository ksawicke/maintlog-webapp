<?php

$rootDir = '/var/www/html';
$appDir = '/maintlog';
$uploadsInspectionImagesDir = '/assets/img/inspections';

$filepath = $rootDir . $appDir . $uploadsInspectionImagesDir . "/" .
	'ABCD-EFGH-1234-5678';

echo 'Attempting to create directory ' . $filepath . '<br /><br />';

try {
	if (!file_exists($filepath)) {
		mkdir($filepath, 0755, true);
	}
} catch (\Exception $ex) {
	echo 'ERROR in trying to create directory ' . $filepath . '<br /><br />>';

	echo '<pre>';
	var_dump($ex);
	echo '</pre>';
}
