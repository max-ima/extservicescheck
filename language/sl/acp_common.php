<?php
/**
*
* @package Extension .yml Check Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
* Slovenian Translation - Marko K.(max, max-ima,...)
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//


$lang = array_merge($lang, array(
	'DONATE'					=> 'Donirajte',
	'DONATE_EXTENSIONS'			=> 'Donirajte mojim razširitvam',
	'DONATE_EXTENSIONS_EXPLAIN'	=> 'Ta razširitev je, tako kot vse moje razširitve, popolnoma brezplačna. Če ste ga uporabili, razmislite o donaciji s klikom na gumb za donacijo PayPal nasproti – hvaležen bi bil. Obljubim, da ne bo neželene pošte ali prošenj za nadaljnje donacije, čeprav bi bile vedno dobrodošle.',

	'NEW_VERSION'				=> 'Nova različica - %s',
	'NEW_VERSION_EXPLAIN'		=> 'Različica %1$s te razširitve je zdaj na voljo za prenos.<br>%2$s',
	'NEW_VERSION_LINK'			=> 'Prenesite tukaj',
	'NO_VERSION_EXPLAIN'		=> 'Informacije o posodobitvi različice niso na voljo.',

	'PAYPAL_BUTTON'				=> 'Donirajte s PayPal gumbom',
	'PAYPAL_TITLE'				=> 'PayPal – Varnejši in enostavnejši način spletnega plačevanja!',

	'VERSION'					=> 'Verzija',
));
