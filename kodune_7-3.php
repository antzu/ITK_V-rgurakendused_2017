<?php
$isikud= array( 
		array('nimi'=>'Miisu', 'vanus'=>23, 'hobi'=> 'suusatamine', 'lemmiktoit'=> 'kapsas'), 
		array('nimi'=>'Tom', 'vanus'=>12, 'hobi'=> 'suusatamine', 'lemmiktoit'=> 'kartul'),
		array('nimi'=>'Tuule', 'vanus'=>21, 'hobi'=> 'söömine', 'lemmiktoit'=> 'k6ik toidud')
	);
foreach ($isikud as $isik) {
	include 'kodune_7-3.html';
}
?>