<?php

/**
 * @file plugins/generic/solr/SettingsForm.inc.php
 *
 * Copyright (c) 2014-2017 Simon Fraser University
 * Copyright (c) 2003-2017 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class SettingsForm
 * @ingroup plugins_generic_solr
 *
 * @brief Form for managers to modify web feeds plugin settings
 */

import('lib.pkp.classes.form.Form');

class SettingsForm extends Form {

	/** @var int Associated context ID */
	private $_contextId;

	/** @var SolrPlugin */
	private $_plugin;

	/**
	 * Constructor
	 * @param $plugin SolrPlugin
	 * @param $contextId int Context ID
	 */
	function __construct($plugin, $contextId) {
		$this->_contextId = $contextId;
		$this->_plugin = $plugin;

		parent::__construct($plugin->getTemplatePath() . 'settingsForm.tpl');
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCSRF($this));
	}

	/**
	 * Initialize form data.
	 */
	function initData() {
		$contextId = $this->_contextId;
		$plugin = $this->_plugin;

		$this->setData('searchEndpoint', $plugin->getSetting($contextId, 'searchEndpoint'));
		$this->setData('username', $plugin->getSetting($contextId, 'username'));
		$this->setData('password', $plugin->getSetting($contextId, 'password'));
		$this->setData('autosuggest', $plugin->getSetting($contextId, 'autosuggest'));
		$this->setData('highlighting', $plugin->getSetting($contextId, 'highlighting'));
	}

	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array('searchEndpoint','username','password', 'autosuggest', 'highlighting'));
	}

	/**
	 * Fetch the form.
	 * @copydoc Form::fetch()
	 */
	function fetch($request) {
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->assign('pluginName', $this->_plugin->getName());
		return parent::fetch($request);
	}

	/**
	 * Save settings. 
	 */
	function execute() {
		$plugin = $this->_plugin;
		$contextId = $this->_contextId;

		$plugin->updateSetting($contextId, 'searchEndpoint', $this->getData('searchEndpoint'));
		$plugin->updateSetting($contextId, 'username', $this->getData('username'));
		$plugin->updateSetting($contextId, 'password', $this->getData('password'));
		$plugin->updateSetting($contextId, 'autosuggest', $this->getData('autosuggest'));
		$plugin->updateSetting($contextId, 'highlighting', $this->getData('highlighting'));
	}
}

?>
