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
	'CONFIG_FILE_FAIL'				=> '<strong>»» The <em>%s</em> file is incompatible</strong>',
	'CONFIG_FILE_PASS'				=> 'The <em>%s</em> file is compatible',

	'DISABLED'						=> 'Disabled',
	'DORMANT'						=> 'Dormant',

	'ENABLED'						=> 'Enabled',
	'EXTENSION_NAME'				=> 'Extension name',
	'EXT_SERVICES_CHECK'			=> 'Extensions .yml File Syntax Check',
	'EXT_SERVICES_CHECK_EXPLAIN'	=> 'This extension will check the syntax of the <em>services.yml</em> file, for all of the extensions on this board, for compatibility with phpBB 3.3. If the <em>services.yml</em> file is found to be compatible then it will check if there is a <em>routing.yml</em> file for the extension and if it also has valid phpBB 3.3 syntax.<br><br>The results from this extension will <strong>NOT</strong> guarantee that the extension is compatible in any other way with phpBB 3.3 nor does it guarantee that there are no other issues with the <em>services.yml</em> and/or <em>routing.yml</em> files.<br><br>Note: A “”',
	'EXT_SERVICES_CHECK_EXPLAIN'	=> 'This extension will check the syntax of the <em>services.yml</em> file, for all of the extensions on this board, for compatibility with phpBB 3.3. If the <em>services.yml</em> file is found to be compatible then it will check if there is a <em>routing.yml</em> file for the extension and if it also has valid phpBB 3.3 syntax.<br><br>The results from this extension will <strong>NOT</strong> guarantee that the extension is compatible in any other way with phpBB 3.3 nor does it guarantee that there are no other issues with the <em>services.yml</em> and/or <em>routing.yml</em> files.<br><br>Note: A “Dormant” extension is one that is in the <em>ext</em> folder but is neither Enabled nor disabled.',
	'EXT_STATUS'					=> 'Extension status',

	'NEW_VERSION'					=> 'New Version',
	'NEW_VERSION_EXPLAIN'			=> 'There is a newer version of this extension available.',
	'NO_CONFIG_FILES'				=> 'This extension does not have any config files',

	'STATUS'						=> '.yml File Status',

	'VENDOR'						=> 'Vendor',
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
