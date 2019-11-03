<?php
/**
*
* @package Credits Page Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\extservicescheck\controller;

use phpbb\template\template;
use phpbb\language\language;
use david63\extservicescheck\core\functions;

class admin_controller implements admin_interface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \david63\extservicescheck\core\functions */
	protected $functions;

	/** @var string phpBB root path */
	protected $root_path;

	/**
	* Constructor for listener
	*
	* @param \phpbb\template\template					$template			Template object
	* @param \phpbb\language\language					$language			Language object
	* @param \david63\extservicescheck\core\functions	functions			Functions for the extension
	* @param string 				            		$phpbb_root_path	phpBB root path

	*
	* @return \david63\extservicescheck\controller\admin_controller
	* @access public
	*/
	public function __construct(template $template, language $language, functions $functions, $phpbb_root_path)
	{
		$this->template			= $template;
		$this->language			= $language;
		$this->functions		= $functions;
		$this->phpbb_root_path	= $phpbb_root_path;
	}

	/**
	* Display the output for this extension
	*
	* @return null
	* @access public
	*/
	public function display_output()
	{
		// Add the language file
		$this->language->add_lang('acp_extservicescheck', $this->functions->get_ext_namespace());

		$enabled_extension_meta_data = $this->functions->enabled_extension_meta_data();
		uasort($enabled_extension_meta_data, array($this->functions, 'sort_extension_meta_data_table'));

		// Display the extensions
		foreach ($enabled_extension_meta_data as $name => $block_vars)
		{
			$services_file	= $this->phpbb_root_path . 'ext/' . $block_vars['META_NAME'] . '/config/services.yml';
			$routing_file	= $this->phpbb_root_path . 'ext/' . $block_vars['META_NAME'] . '/config/routing.yml';

			if (!file_exists($services_file))
			{
				$status = $this->language->lang('NO_SERVICES_FILE');
			}
			else if (preg_match("/\-\ \@|\-\ \%/", file_get_contents($services_file)))
			{
				$status = $this->language->lang('SERVICES_FILE_FAIL');
			}
			else
			{
				$status = $this->language->lang('SERVICES_FILE_PASS');
				if (file_exists($routing_file))
				{
					if (strstr(file_get_contents($routing_file), 'pattern:'))
					{
						$status = $this->language->lang('ROUTING_FILE_FAIL');
					}
				}
			}


			$this->template->assign_block_vars('ext_row', array(
				'DISPLAY_NAME'	=> $block_vars['META_DISPLAY_NAME'],
				'STATUS'		=> $status,
				'VERSION'		=> $block_vars['META_VERSION'],
			));
		}

		// Template vars for header panel
		$this->template->assign_vars(array(
			'HEAD_TITLE'		=> $this->language->lang('EXT_SERVICES_CHECK'),
			'HEAD_DESCRIPTION'	=> $this->language->lang('EXT_SERVICES_CHECK_EXPLAIN'),

			'NAMESPACE'			=> $this->functions->get_ext_namespace('twig'),

			'S_VERSION_CHECK'	=> $this->functions->version_check(),

			'VERSION_NUMBER'	=> $this->functions->get_this_version(),
		));
	}
}
