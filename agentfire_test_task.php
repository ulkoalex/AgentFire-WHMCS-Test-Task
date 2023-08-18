<?php
/**
 * AgentFire Test Task
 *
 * @package    WHMCS
 * @author     Alex Ulko <alex@agentfire.com>
 * @copyright  Copyright (c) AgentFire 2023
 * @link      https://agentfire.com
 */

if (!defined('WHMCS')) {
    die('This file cannot be accessed directly');
}

use WHMCS\Database\Capsule;

require_once __DIR__ . '/init.php';

function agentfire_test_task_config() {
	$configarray = [
		'name'        => 'AgentFire Test Task',
		'description' => 'AgentFire Test Task',
		'version'     => AGENTFIRE_TEST_TASK_VERSION,
		'author'      => '',
		'language'    => 'english',
		'fields'      => [
			'api_key'       => [
				'FriendlyName' => 'API Key',
				'Type'         => 'text',
				'Size'         => '100',
				'Description'  => 'AgentFire API server key',
				'Default'      => '',
			],
			'slack_channel' => [
				'FriendlyName' => 'Slack Channel',
				'Type'         => 'text',
				'Size'         => '100',
				'Description'  => 'Channel Name or ID',
				'Default'      => '#test',
			],
		],
	];
	return $configarray;
}

function agentfire_test_task_activate() {
	if (!Capsule::schema()->hasTable('mod_agentfire_test_task_cron')) {
		Capsule::schema()->create('mod_agentfire_test_task_cron', function($table) {
			$table->increments('id');
			// all fields
		});
	}
}

function agentfire_test_task_deactivate() {
	Capsule::schema()->dropIfExists('mod_agentfire_test_task_cron');
}

function agentfire_test_task_output($vars) {
	global $CONFIG;
    AgentFire\Test_Task::get_instance()->set_config($CONFIG);
    AgentFire\Test_Task\Admin::get_instance()->output($vars);
}
