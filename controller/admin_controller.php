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
use david63\extservicescheck\core\yml_formatter;

class admin_controller implements admin_interface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \david63\extservicescheck\core\functions */
	protected $functions;

	/** @var \david63\extservicescheck\core\yml_formatter */
	protected $yml_formatter;

	/** @var string */
	protected $ext_root_path;

	/**
	* Constructor for admin_controller
	*
	* @param \phpbb\template\template						$template			Template object
	* @param \phpbb\language\language						$language			Language object
	* @param \david63\extservicescheck\core\functions		functions			Functions for the extension
	* @param \david63\extservicescheck\core\yml_formatter	yml_formatter		yml_formatter for the extension
	* @param string											$ext_root_path		Path to this extension's root
	*
	* @return \david63\extservicescheck\controller\admin_controller
	* @access public
	*/
	public function __construct(template $template, language $language, functions $functions, yml_formatter $yml_formatter, $ext_images_path)
	{
		$this->template				= $template;
		$this->language				= $language;
		$this->functions			= $functions;
		$this->yml_formatter		= $yml_formatter;
		$this->ext_images_path		= $ext_images_path;
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
			$config_dir	= $block_vars['LOCATION'] . 'config/';
			$ext_name	= $block_vars['META_NAME'];

			$this->template->assign_block_vars('ext_row', array(
				'DISPLAY_NAME'	=> $block_vars['META_DISPLAY_NAME'],

				'EXT_STATUS'	=> $block_vars['EXT_STATUS'],

				'VENDOR'		=> $block_vars['VENDOR'],
				'VERSION'		=> $block_vars['META_VERSION'],
			));

			if (is_dir($config_dir))
			{
				$config_files	= array();
				$status 		= '';
				$files 			= array_diff(scandir($config_dir), array('..', '.'));

				// Create an array of all config folder(s) & files
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
					// Check the namespace
					if (!preg_match('/^[a-zA-Z0-9\/]+$/', $ext_name) // Check for non alphnumeric characters
						|| !ctype_alpha($ext_name[0])) // Check first character is alpha
					{
						$this->template->assign_block_vars('ext_row.file_data', array(
							'STATUS' 		=> $this->language->lang('INVALID_CHRACTERS', $ext_name),
							'STATUS_IMAGE'	=> 'query',
						));
					}

					// Check that the file is accessible
					if (!is_readable($filename))
					{
						$this->template->assign_block_vars('ext_row.file_data', array(
							'STATUS' 		=> $this->language->lang('FILE_NOT_READABLE', $yml_file),
							'STATUS_IMAGE'	=> 'query',
						));
					}
					else if (!$file_contents = file_get_contents($filename))
					{
						if (!empty($file_contents))
						{
							$this->template->assign_block_vars('ext_row.file_data', array(
								'STATUS' 		=> $this->language->lang('FILE_NOT_ACCESSIBLE', $yml_file),
								'STATUS_IMAGE'	=> 'query',
							));
						}
						else
						{
							$this->template->assign_block_vars('ext_row.file_data', array(
								'STATUS' 		=> $this->language->lang('FILE_EMPTY', $yml_file),
								'STATUS_IMAGE'	=> 'query',
							));
						}
					}
					else if (preg_match('/\-\ \@|\-\ \%|\[\@|\[\%|\:\ \%/', $file_contents) // Check for quotes
						|| strstr($file_contents, 'pattern:') // Check for "path" not "pattern"
						|| strstr($file_contents, 'scope: prototype') // Check the "scope"
						|| strstr($file_contents, 'scope: container')
						|| strstr($file_contents, 'scope: request'))
					{
						$this->template->assign_block_vars('ext_row.file_data', array(
							// Create a unique key for the js script
							'FILE_KEY'		=> rand(),

							'NEW_FILE'		=> $this->yml_formatter->yaml_format($filename),
							'NEW_FILE_KEY'	=> rand(),

							'OLD_FILE'		=> file_get_contents($filename),

							'STATUS'		=> $this->language->lang('CONFIG_FILE_FAIL', $yml_file),
							'STATUS_IMAGE'	=> 'error',
						));
					}
					else
					{
						$this->template->assign_block_vars('ext_row.file_data', array(
							'STATUS' 		=> $this->language->lang('CONFIG_FILE_PASS', $yml_file),
							'STATUS_IMAGE'	=> 'ok',
						));
					};
				}
			}
			else
			{
				$this->template->assign_block_vars('ext_row.file_data', array(
					'STATUS' 		=> $this->language->lang('NO_CONFIG_FILES'),
					'STATUS_IMAGE'	=> 'ok',
				));
			}
		}

		$this->template->assign_var('EXT_IMAGE_PATH', $this->ext_images_path);

		// Template vars for header panel
		$this->template->assign_vars(array(
			'ERROR_EXPLAIN'			=> '<img src="' . $this->ext_images_path . '/error.png" /> ' . $this->language->lang('ERROR_EXPLAIN'),

			'FILE_EXPLAIN'			=> '<img src="' . $this->ext_images_path . '/files.png" /> ' . $this->language->lang('FILE_EXPLAIN'),
			'FILE_OPEN_EXPLAIN'		=> '<img src="' . $this->ext_images_path . '/files_open.png" /> ' . $this->language->lang('FILE_OPEN_EXPLAIN'),
			'FILE_QUERY_EXPLAIN'	=> '<img src="' . $this->ext_images_path . '/query.png" /> ' . $this->language->lang('FILE_QUERY_EXPLAIN'),

			'HEAD_TITLE'			=> $this->language->lang('EXT_SERVICES_CHECK'),
			'HEAD_DESCRIPTION'		=> $this->language->lang('EXT_SERVICES_CHECK_EXPLAIN'),

			'NAMESPACE'				=> $this->functions->get_ext_namespace('twig'),

			'OK_EXPLAIN'			=> '<img src="' . $this->ext_images_path . '/ok.png" /> ' . $this->language->lang('OK_EXPLAIN'),

			'S_VERSION_CHECK'		=> $this->functions->version_check(),

			'VERSION_NUMBER'		=> $this->functions->get_this_version(),
		));
	}
}
