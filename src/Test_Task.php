<?php

declare( strict_types=1 );

namespace AgentFire;

use AgentFire\Test_Task\Traits\Singleton;
use AgentFire\Test_Task\Admin;
use AgentFire\Test_Task\Cron;
use AgentFire\Test_Task\Slack;

/**
 * @package AgentFire\Test_Task
 */
class Test_Task {
	use Singleton;

    public $config = null;

	var $addon_actions = [
		'AddonAdd',
		'AddonEdit',
		'AddonUnsuspended',
		'AddonActivated',
		'AddonSuspended',
		'AddonTerminated',
		'AddonCancelled'
	];

	public function __construct() {
		Admin::get_instance();
	}

    public function set_config($config) {
        $this->config = $config;
    }

	public function add_hooks() {
		foreach ($this->addon_actions as $addon_action) {
			add_hook($addon_action, 1, [$this, 'addon_edited']);
		}
		add_hook('AddonDeleted', 1, [$this, 'addon_deleted']);
	}

	/**
	 * @param array $vars
	 */
	public function addon_edited($vars) {
		Cron::get_instance()->queue([
			// ...
		]);
	}

	/**
	 * @param array $vars
	 */
	public function addon_deleted($vars) {
		Cron::get_instance()->queue([
			// ...
		]);

		// Set $channel, $username, $title, $icon, $attachments

		Slack::get_instance()->send( $channel, $username, $title, $icon, $attachments );
	}
}
