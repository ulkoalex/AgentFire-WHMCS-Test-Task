<?php

namespace AgentFire;

require_once __DIR__ . '/../../../cron/bootstrap.php';

set_time_limit(600);

Test_Task\Cron::get_instance()->process( [
	// ...
] );
