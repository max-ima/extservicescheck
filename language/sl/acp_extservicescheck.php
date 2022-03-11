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

/// DEVELOPERS PLEASE NOTE
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
	'COMMON_ERRORS'					=> 'Pogoste napake',
	'COMMON_ERRORS_EXPLAIN'			=> 'Nekateri pogosti razlogi za napake, o katerih so poročali zgoraj, so lahko posledica naslednjih razlogov, vendar ne omejeni nanje:<hr>– manjka en narekovaj, če je pred znakom “@” ali “%”<br>- “pattern” je bil nadomeščen s “path”<br>- “scope: prototype” je postal “shared: false”<br>- “scope: container” je postal “shared: true”<br>- “scope: request” je prav tako je bilo spremenjeno, vendar je treba dodatno preveriti, kaj je zamenjava.«<br>- Imenski prostor razširitve bo zabeležen kot neveljaven, če vsebuje podčrtaj.<hr>Če ste v dvomih, kaj spremeniti ali kako spremeniti, potem najprej preverite, ali je na voljo posodobljena različica razširitve, in če ne, se obrnite na razvijalca razširitve v temi podpore za razširitev.',
	'CONFIG_FILE_FAIL'				=> '<strong>Datoteka <em>%s</em> ni veljavna</strong>',
	'CONFIG_FILE_PASS'				=> 'Datoteka <em>%s</em> je veljavna',
	'COPY_CLIPBOARD'				=> 'Kopiraj v odložišče',

	'DISABLED'						=> 'Onemogočeno',
	'DISABLE_EXPLAIN'				=> 'S klikom tukaj onemogočite to razširitev.',
	'DORMANT'						=> 'V mirovanju',

	'ENABLED'						=> 'Omogočeno',
	'ERROR_EXPLAIN'					=> 'Označuje razširitev, pri kateri se zdi, da ena ali več datotek .yml vsebuje neveljavno sintakso.',
	'EXTENSION_NAME'				=> 'Ime razširitve',
	'EXTENSION_QUERY_EXPLAIN'		=> 'V tej razširitvi je poizvedba z eno ali več datotekami.',
	'EXT_SERVICES_CHECK'			=> 'Preverjanje sintakse datotek razširitev .yml',
	'EXT_SERVICES_CHECK_EXPLAIN'	=> 'Ta razširitev bo preverila skladnjo vseh datotek <em>.yml</em> za vse razširitve na tej plošči glede združljivosti s phpBB 3.3.<br>Preverjeno bo tudi imenski prostor razširitve za trenutna in prihodnja združljivost.
  <br><br>Rezultati te razširitve <strong>NE</strong> zagotavljajo, da je razširitev na kakršen koli drug način združljiva s phpBB 3.3, niti ne zagotavlja, da z datotekami <em>.yml</em> ni drugih težav. <br><br>Opomba: “Neaktivna” razširitev je tista, ki je v mapi <em>ext</em>, vendar ni niti Omogočena niti Onemogočena',
	'EXT_STATUS'					=> 'Stanje razširitve',

	'FILE_EMPTY'					=> 'Datoteka <em>%s</em> je prazna',
	'FILE_ERROR'					=> 'Naslednja napaka je bila zaznana pri dostopu do %1$s<br>Napaka: %2$s',
	'FILE_EXPLAIN'					=> 'S klikom tukaj se odpreta “pred” in “po” oblikovanja datoteke.',
	'FILE_NOT_ACCESSIBLE'			=> 'Datoteka <em>%s</em> ni dostopna',
	'FILE_NOT_READABLE'				=> 'Datoteka <em>%s</em> ni berljiva',
	'FILE_OPEN_EXPLAIN'				=> 'S klikom tukaj zaprete “pred” in “po” oblikovanja datoteke.',
	'FILE_QUERY_EXPLAIN'			=> 'Obstaja poizvedba s to datoteko.',

	'ICON_EXTN_DISABLE'				=> 'Onemogoči to razširitev',
	'ICON_EXTN_ERROR'				=> 'Videti je, da ima ta razširitev napake',
	'ICON_EXTN_OK'					=> 'Zdi se, da je ta razširitev pravilna',
	'ICON_EXTN_QUERY'				=> 'V tej razširitvi je poizvedba z eno ali več datotekami',
	'ICON_FILE_CLOSED'				=> 'Kliknite za prikaz datotek',
	'ICON_FILE_OPEN'				=> 'Kliknite, da zaprete datoteke',
	'ICON_FILE_QUERY'				=> 'Obstaja poizvedba s to datoteko',
	'INVALID_CHRACTERS'				=> 'Imenski prostor <em>%s</em> vsebuje neveljavne znake',

	'LEGEND'						=> 'Legenda',

	'NEW_FILE'						=> 'Preoblikovana datoteka',
	'NO_CONFIG_FILES'				=> 'Ta razširitev nima nobenih konfiguracijskih datotek',

	'OK_EXPLAIN'					=> 'Zdi se, da so te razširitve V REDU.',
	'ORIGINAL_FILE'					=> 'Izvirna datoteka',

	'REQUIRES_ATTENTION'			=> '&nbsp;#Ta linija zahteva pozornost',

	'STATUS'						=> 'Stanje datoteke .yml',

	'VENDOR'						=> 'Ponudnik',
));
