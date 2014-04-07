<?php
$_POST['userid'] = 1379161644;
$o = '1379161644';

echo hash('sha512', $_POST['userid'].'$_POST');
echo '<br/>';
echo hash('sha512', $o.'$_POST');


?>