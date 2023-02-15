<?php
declare(strict_types=1);

namespace FCC\Year2022;

require '../../vendor/autoload.php';

class BaseFunctions
{
	/** @var array<int, array{'username': string, 'id': int, 'access_key': int, 'first_login_time': string}>  */
	protected array $officeDatabaseArray = [];

	public function getOfficeDatabaseArray(): void
	{
		$people_file = file(__DIR__ . '/files/office_database.txt');

		if (!is_array($people_file)) {
			return;
		}

		foreach ($people_file as $iValue) {
			/** @var array $explode */
			$explode = explode(', ', $iValue);
			$this->officeDatabaseArray[$explode[1]] = [
				'username' => trim($explode[0]),
				'id' => (int) $explode[1],
				'access_key' => (int) $explode[2],
				'first_login_time' => str_replace("\n", '', $explode[3]),
			];
		}
	}
}