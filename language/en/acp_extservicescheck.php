<?php
/**
*
* @package Ext Services Check Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
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
	'EXTENSION_NAME'				=> 'Extension name',
	'EXT_SERVICES_CHECK'			=> 'Extension Services File Syntax Check',
	'EXT_SERVICES_CHECK_EXPLAIN'	=> 'This extension will check the syntax of the <em>services.yml</em> file in all of the enabled extensions on this board for compatibility with phpBB 3.3.<br><br>It does <strong>NOT</strong> guarantee that the extension is compatible in any other way with phpBB 3.3 nor does it guarantee that there are no other issues with the <em>services.yml</em> file.',

	'NEW_VERSION'					=> 'New Version',
	'NEW_VERSION_EXPLAIN'			=> 'There is a newer version of this extension available.',
	'NO_SERVICES_FILE'				=> 'This extension does not use a <em>services.yml</em> file',

	'ROUTING_FILE_FAIL'				=> '<strong>»» The <em>routing.yml</em> file is incompatible</strong>',

	'SERVICES_FILE_FAIL'			=> '<strong>»» The <em>services.yml</em> file is incompatible</strong>',
	'SERVICES_FILE_PASS'			=> 'The <em>services.yml</em> file is compatible',
	'STATUS'						=> 'Status',

	'VERSION'						=> 'Version',
));

// Donate
$lang = array_merge($lang, array(
	'DONATE'					=> 'Donate',
	'DONATE_EXTENSIONS'			=> 'Donate to my extensions',
	'DONATE_EXTENSIONS_EXPLAIN'	=> 'This extension, as with all of my extensions, is totally free of charge. If you have benefited from using it then please consider making a donation by clicking the PayPal donation button opposite - I would appreciate it. I promise that there will be no spam nor requests for further donations, although they would always be welcome.',

	'PAYPAL_BUTTON'				=> 'Donate with PayPal button',
	'PAYPAL_TITLE'				=> 'PayPal - The safer, easier way to pay online!',
));
