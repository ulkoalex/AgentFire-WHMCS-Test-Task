<?php

declare( strict_types=1 );

namespace AgentFire\Test_Task;

use AgentFire\Test_Task\Traits\Singleton;

use Curl\Curl;

/**
 * @package AgentFire\Test_Task
 */
class Slack {

	use Singleton;

	/**
	 * @param string $channel
	 * @param string $username
	 * @param string $title
	 * @param string $icon
	 * @param array $attachments
	 * @throws Exception
	 */
	function send($channel, $username, $title, $icon, $attachments) {
		$data = [
			'channel'     => $channel,
			'username'    => $username,
			'text'        => $title,
			'icon_emoji'  => $icon,
			'attachments' => $attachments,
		];

		$data_string = json_encode($data);

		$request = new Curl();

		$request->setHeader('Content-type', 'application/json');
		$request->setHeader('Content-Length', strlen($data_string));

		$result = $request->post('https://hooks.slack.com/services/...', $data_string);

		if ($request->error) {
			throw new Exception($request->error_message);
		}

		if ($result->response != 'ok') {
			throw new Exception($result->response);
		}

	}

}
