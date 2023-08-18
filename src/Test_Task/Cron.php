<?php

declare( strict_types=1 );

namespace AgentFire\Test_Task;

use AgentFire\Test_Task\Traits\Singleton;

/**
 * @package AgentFire\Test_Task
 */
class Cron {
	use Singleton;

	public function queue($params) {
		// ...
	}

	public function process($params) {
		// ...
	}

	/**
	 * Get tasks from DB
	 * @return array[]
	 */
	public function get_tasks() {
		// ...
		return [
			[
				'id'    => 123,
				'title' => 'Updating addon',
			],
		];
	}

}
