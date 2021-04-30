<?php

/**
 * @file plugins/generic/listener/ListenerPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class ListenerPlugin
 * @ingroup plugins_generic_listener
 *
 * @brief Class for Listener plugin
 */

import('lib.pkp.classes.plugins.GenericPlugin');
import('plugins.generic.listener.DatabaseUpdate');

use PKP\observers\events\PublishedEvent;
use Illuminate\Support\Facades\Event;

class ListenerPlugin extends GenericPlugin {
	/**
	 * @copydoc LazyLoadPlugin::register()
	 */
	function register($category, $path, $mainContextId = null) {
		if (parent::register($category, $path, $mainContextId)) {
			if ($this->getEnabled()) {
				$this->addListener();
			}
			return true;
		}
		return false;
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.generic.listener.displayName');
	}

	/**
	 * Get a description of the plugin.
	 * @return String
	 */
	function getDescription() {
		return __('plugins.generic.listener.description');
	}

	/**
	 * Adds a listener to the published event
	 * @return void
	 */
	protected function addListener() {
		Event::listen(PublishedEvent::class, DatabaseUpdate::class);
	}

	/**
	 * @copydoc Plugin::getInstallMigration()
	 */
	public function getInstallMigration()
	{
		$this->import('ListenerSchemaMigration');
		return new ListenerSchemaMigration();
	}
}

?>
