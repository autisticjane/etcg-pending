# etcg-pending
This mod gathers a list of your pending cards for use with other mods.

I'm hosting EasyTCG mods on my Github & crediting the source, because too often TCG mod sites go down (entire forums of contributed code have gone down) & that code is lost forever unless the Internet Archive happened to save a copy.

## Credit
Created by [Dite](https://web.archive.org/web/20220522093431/https://tcg.dite-hart.net/) and tweaked by [Kriss](https://web.archive.org/web/20220522093431/https://krissasaur.magical-me.net/tcg/post/etcgmods.php#getcatagory).

## Before installing ANY etcg mods

Open your `func.php` file & scroll all the way to the bottom. Before the last line, put `include('mods.php');`.

Create a new file named `mods.php` in the **same directory** as `func.php` & put the following:

```
<?php {

} ?>
```

### Alternative route if you're not familiar with code
You can create a `mods.php` file & `mods` folder so your mods file will essentially look like this with each mod you have:

```
<?php {

	include('mods/mod-name.php');

} ?>
```

This will help you troubleshoot, too, as you can just rename each file to have a `1` after if you need to deduce which code is causing your problems. That said, this isn't flawless & you still need to upload the mod files to the `mods` directory if you go this route.

## Troubleshooting
* If you have **ETCG 1.0.1**, your mods will use ***mysql***.
* If you have **ETCG 1.1.0**, your mods will use ***mysqli***.
* Make sure you do not have the same mod in your `mods.php` file twice.
* Please double check these things if you have a problem!

### Display errors
If your post is broken or showing a blank page, try adding the following to your header:

```
ini_set("display_errors", "1");error_reporting(E_ALL);
```

* This may show us an error code that will help deduce what is wrong.
* You can remove this when you are done.

## Installation
Open `mods.php` and paste the following between the php tags:

### ETCG 1.0.1

```
// PENDING MOD BY DITE
function pending($tcg, $card){
	$database = new Database;
	$sanitize = new Sanitize;
	$tcg = $sanitize->for_db($tcg);
	
	$tcginfo = $database->get_assoc("SELECT * FROM `tcgs` WHERE `name`='$tcg' LIMIT 1");
	$tcgid = $tcginfo['id'];
	$pending = $database->num_rows("SELECT * FROM `trades` WHERE `tcg`='$tcgid' AND `receiving` LIKE '%$card%'");
	return $pending;
}
```

### ETCG 1.1.0

```
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
```
