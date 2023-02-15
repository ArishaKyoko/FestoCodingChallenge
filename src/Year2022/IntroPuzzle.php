<?php
declare(strict_types=1);

namespace FCC\Year2022;

class IntroPuzzle extends BaseFunctions
{
	private array $puzzle1 = [];
	private array $puzzle2 = [];
	private array $puzzle3 = [];

	private string $thieve = '';

	public function __construct()
	{
		$this->getOfficeDatabaseArray();

		$this->_getPuzzle1();
		echo 'The sum of ID numbers in Puzzle 1: ' . array_sum($this->puzzle1) . "\n";

		$this->_getPuzzle2();
		echo 'The sum of ID numbers in Puzzle 2: ' . array_sum($this->puzzle2) . "\n";

		$this->_getPuzzle3();
		echo 'The sum of ID numbers in Puzzle 3: ' . array_sum($this->puzzle3) . "\n";

		$this->_getThieve();
		echo 'The thiev is: ' . $this->thieve;
	}

	private function _getPuzzle1(): void
	{
		foreach ($this->officeDatabaseArray as $data) {
			if (strpos((string) $data['id'], '814') !== false) {
				$this->puzzle1[] = $data['id'];
			}
		}
	}

	private function _getPuzzle2(): void
	{
		foreach ($this->officeDatabaseArray as $data) {
			$bin = str_pad(decbin($data['access_key']), 8, '0', STR_PAD_LEFT);
			if ($bin[4] === '1') {
				$this->puzzle2[] = $data['id'];
			}
		}
	}

	private function _getPuzzle3(): void
	{
		foreach ($this->officeDatabaseArray as $data) {
			if ($data['first_login_time'] <= '07:14') {
				$this->puzzle3[] = $data['id'];
			}
		}
	}

	private function _getThieve(): void
	{
		$result = array_intersect($this->puzzle1, $this->puzzle2, $this->puzzle3);
		if (count($result) > 1) {
			return;
		}
		$thieveID = array_values($result)[0];
		$thieveData = $this->officeDatabaseArray[$thieveID];
		$this->thieve = $thieveData['username'];
	}
}