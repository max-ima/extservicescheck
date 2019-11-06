<?php
/**
*
* @package Ext Services Check Extension
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

	/** @var string */
	protected $ext_root_path;

	/**
	* Constructor for admin_controller
	*
	* @param \phpbb\template\template					$template		Template object
	* @param \phpbb\language\language					$language		Language object
	* @param \david63\extservicescheck\core\functions	functions		Functions for the extension
	* @param string										$ext_root_path	Path to this extension's root

	*
	* @return \david63\extservicescheck\controller\admin_controller
	* @access public
	*/
	public function __construct(template $template, language $language, functions $functions, $ext_images_path)
	{
		$this->template			= $template;
		$this->language			= $language;
		$this->functions		= $functions;
		$this->ext_images_path	= $ext_images_path;
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

		// Get an array of the extensions and sort into alphbetical order
		$extension_meta_data = $this->functions->extension_meta_data();
		uasort($extension_meta_data, array($this->functions, 'sort_extension_meta_data_table'));

		// Display the extensions
		foreach ($extension_meta_data as $block_vars)
		{
			$config_dir = $block_vars['LOCATION'] . 'config/';
			$status_img	= false;

			if (is_dir($config_dir))
			{
				$config_files	= array();
				$status 		= '';

				$files 			= array_diff(scandir($config_dir), array('..', '.'));

				// Create an array of all config folder(s) files
				foreach ($files as $filename)
				{
					// Is this a file or dir?
					if (strpos($filename, '.'))
					{
						$config_files[$filename] = $config_dir . $filename;
					}
					else
					{
						$sub_files = array_diff(scandir($config_dir . $filename), array('..', '.'));

						foreach ($sub_files as $sub_filename)
						{
							$config_files[$sub_filename] = $config_dir . $filename . '/' . $sub_filename;
						}
					}
				}

				// Now we can check the files
				foreach ($config_files as $yml_file => $filename)
				{
					if (preg_match("/\-\ \@|\-\ \%|\[\@|\[\%|\:\ \%/", file_get_contents($filename)) || strstr(file_get_contents($filename), 'pattern:'))
					{
						$status 	.= $this->language->lang('CONFIG_FILE_FAIL', $yml_file);
						$status_img = true;
					}
					else
					{
						$status 	.= $this->language->lang('CONFIG_FILE_PASS', $yml_file);
						$status_img = ($status_img) ? true: false;
					}
					$status = $status . '<br>';
				}
			}
			else
			{
				$status = $this->language->lang('NO_CONFIG_FILES');
			}

			$this->template->assign_block_vars('ext_row', array(
				'DISPLAY_NAME'	=> $block_vars['META_DISPLAY_NAME'],

				'EXT_STATUS'	=> $block_vars['EXT_STATUS'],

				'STATUS'		=> $status,
				'STATUS_IMG'	=> $status_img,

				'VENDOR'		=> $block_vars['VENDOR'],
				'VERSION'		=> $block_vars['META_VERSION'],
			));
		}

		$this->template->assign_var('EXT_IMAGE_PATH', $this->ext_images_path);

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
