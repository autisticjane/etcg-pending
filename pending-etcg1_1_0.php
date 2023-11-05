// PENDING MOD BY DITE
function pending_check($tcg, $card){
	$database = new Database;
	$sanitize = new Sanitize;
	$tcg = $sanitize->for_db($tcg);
	
	$tcginfo = $database->get_assoc("SELECT * FROM `tcgs` WHERE `name`='$tcg' LIMIT 1");
	$tcgid = $tcginfo['id'];
	$pending = $database->num_rows("SELECT * FROM `trades` WHERE `tcg`='$tcgid' AND `receiving` LIKE '%$card%'");
	$pending = ($pending === 0 ? false : true);
	return $pending;
}
