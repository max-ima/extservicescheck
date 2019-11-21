<?php
/**
*
* @package Extension .yml Check Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\extservicescheck\core;

use phpbb\language\language;
use david63\extservicescheck\core\functions;

/**
* yml_formatter
*/
class yml_formatter
{
	/** @var \phpbb\language\language */
	protected $language;

	/** @var \david63\extservicescheck\core\functions */
	protected $functions;

	/**
	* Constructor for 33extcheck
	*
	* @param \phpbb\language\language					$language	Language object
	* @param \david63\extservicescheck\core\functions	functions	Functions for the extension
	*
	* @access public
	*/
	public function __construct(language $language, functions $functions)
	{
		$this->language		= $language;
		$this->functions	= $functions;
	}

	/**
	* Format the .yml file for phpBB
	*
	* @return null
	* @access public
	*/
	public function yaml_format($original_file)
	{
		// Add the language file
		$this->language->add_lang('acp_extservicescheck', $this->functions->get_ext_namespace());

		$formatted_file	= '';
		$handle 		= fopen($original_file, "r");

		if ($handle)
		{
			while (($line = fgets($handle)) !== false)
			{
				$length	= strlen($line);

				if (preg_match("/\-\ \@/", $line))
				{
					$temp_line		 =  substr_replace(preg_replace("/\-\ \@/", "- '@", $line), "'", $length , 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (preg_match("/\-\ \%/", $line))
				{
					$temp_line 		 = substr_replace(preg_replace("/\-\ \%/", "- '%", $line), "'", $length , 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (preg_match("/\:\ \%/", $line))
				{
					$temp_line 		 = substr_replace(preg_replace("/\:\ \%/", ": '%", $line), "'", $length , 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (preg_match("/\[\@/", $line))
				{
					$temp_line 		 = substr_replace(preg_replace("/\[\@/", "['@", $line), "'", ($length - 2) , 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (preg_match("/\[\%/", $line))
				{
					$temp_line 		 = substr_replace(preg_replace("/\[\%/", "['%", $line), "'", ($length - 2) , 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (strstr($line, 'pattern:'))
				{
					$temp_line 		 = preg_replace('/pattern/', 'path', $line);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (strstr($line, 'scope: prototype'))
				{
					$temp_line 		 = preg_replace('/scope: prototype/', 'shared: false', $line);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (strstr($line, 'scope: container'))
				{
					$temp_line 		 = preg_replace('/scope: container/', 'shared: true', $line);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else if (strstr($line, 'scope: request'))
				{
					$temp_line 		 = substr_replace($line, $this->language->lang('REQUIRES_ATTENTION'), ($length - 1), 0);
					$formatted_file .= '<span class="compare-highlight">' . $temp_line . '</span>';
				}
				else
				{
					$formatted_file .= $line;
				}
			}
			fclose($handle);

			return $formatted_file;
		}
	}
}
