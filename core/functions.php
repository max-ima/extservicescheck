<?php
/**
*
* @package Ext Services Check Extension
* @copyright (c) 2019 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\extservicescheck\core;

use phpbb\extension\manager;
use phpbb\user;
use phpbb\language\language;
use phpbb\log\log;

/**
* functions
*/
class functions
{
	/** @var \phpbb\extension\manager */
	protected $phpbb_extension_manager;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\log\log */
	protected $log;

	/**
	* Constructor for functions
	*
	* @param \phpbb\extension\manager		$phpbb_extension_manager	Extension manager
	*@param \phpbb\user						$user						User object
	* @param \phpbb\language\language		$language					Language object
	* @param \phpbb\log\log					$log						Log object
	*
	* @access public
	*/
	public function __construct(manager $phpbb_extension_manager, user $user, language $language, log $log)
	{
		$this->ext_manager	= $phpbb_extension_manager;
		$this->user			= $user;
		$this->language		= $language;
		$this->log			= $log;

		$this->namespace	= __NAMESPACE__;
	}

	/**
	* Get the extension's namespace
	*
	* @return $extension_name
	* @access public
	*/
	public function get_ext_namespace($mode = 'php')
	{
		// Let's extract the extension name from the namespace
		$extension_name = substr($this->namespace, 0, -(strlen($this->namespace) - strrpos($this->namespace, '\\')));

		// Now format the extension name
		switch ($mode)
		{
			case 'php':
				$extension_name = str_replace('\\', '/', $extension_name);
			break;

			case 'twig':
				$extension_name = str_replace('\\', '_', $extension_name);
			break;
		}

		return $extension_name;
	}

	/**
	* Check if there is an updated version of the extension
	*
	* @return $new_version
	* @access public
	*/
	public function version_check()
	{
		$md_manager 	= $this->ext_manager->create_extension_metadata_manager($this->get_ext_namespace());
		$versions 		= $this->ext_manager->version_check($md_manager);
		$new_version	= (array_key_exists('current', $versions) ? $versions['current'] : false);

		return $new_version;
	}

	/**
	* Get the version number of this extension
	*
	* @return $meta_data
	* @access public
	*/
	public function get_this_version()
	{
		$md_manager = $this->ext_manager->create_extension_metadata_manager($this->get_ext_namespace());
		$meta_data	= $md_manager->get_metadata('version');

		return $meta_data;
	}

	/**
	* Get the meta data for the extensions
	*
	* @return $extension_meta_data
	* @access public
	*/
	public function extension_meta_data()
	{
		$extension_meta_data = array();

		foreach ($this->ext_manager->all_available() as $name => $location)
		{
			$md_manager = $this->ext_manager->create_extension_metadata_manager($name);
			$meta_data	= $md_manager->get_metadata('all');

			$ext_status = ($this->ext_manager->is_enabled($name)) ? $this->language->lang('ENABLED') : '';
			$ext_status = ($this->ext_manager->is_disabled($name)) ? $this->language->lang('DISABLED') : $ext_status;
			$ext_status = ($this->ext_manager->is_configured($name)) ? $ext_status : $this->language->lang('DORMANT');

			$extension_meta_data[$name] = array(
				'EXT_ENABLED'		=> $this->ext_manager->is_enabled($name),
				'EXT_STATUS'		=> $ext_status,
				'LOCATION'			=> $location,
				'META_DISPLAY_NAME'	=> $meta_data['extra']['display-name'],
				'META_NAME'			=> $meta_data['name'],
				'META_VERSION' 		=> $meta_data['version'],
				'VENDOR'			=> strtok($meta_data['name'], '/'),
			);
		}

		return $extension_meta_data;
	}

	/**
	* Disable an extension
	*
	* @return null
	* @access public
	*/
	public function extension_disable($ext_name)
	{
		while ($this->ext_manager->disable_step($ext_name));

		// Add disable action to the admin log
		$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_EXTN_DISABLE', time(), array($ext_name));
	}

	/**
	* Sort helper for the table containing the metadata about the extensions.
	*/
	public function sort_extension_meta_data_table($val1, $val2)
	{
		return strnatcasecmp($val1['META_DISPLAY_NAME'], $val2['META_DISPLAY_NAME']);
	}
}
