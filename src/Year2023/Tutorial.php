<?php
declare(strict_types=1);

namespace FCC\Year2023;

class Tutorial extends BaseFunctions
{
    /** @var string[] */
    private array $keymakerOrderedArray;

	public function __construct()
	{
        $this->keymakerOrderedArray = $this->getSimpleFileArray($this->filepath . '01_keymaker_ordered.txt');

        echo 'The perfect ordered key in Puzzle 1: ' . $this->puzzleOne() . "\n";
        echo 'The perfect ordered key in Puzzle 1: ' . $this->puzzleTwo() . "\n";
        echo 'The perfect ordered key in Puzzle 1: ' . $this->puzzleThree() . "\n";
	}

    private function puzzleOne(): string
    {
        $orderedMap = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4,
            'e' => 5,
            'f' => 6,
        ];

        foreach ($this->keymakerOrderedArray as $key => $string) {
            $prevCharOrderedNumber = 0;
            foreach (str_split($string, 1) as $char) {
                if ($orderedMap[$char] < $prevCharOrderedNumber) {
                    continue 2;
                }
                $prevCharOrderedNumber = $orderedMap[$char];
            }

            return $string;
        }

        return '';
    }

    private function puzzleTwo(): string
    {
        return '';
    }

    private function puzzleThree(): int
    {
        // todo wip
        $this->getTrapLogs();

        $deactivatedTrap = ['inactive', 'disabled', 'quiet', 'standby', 'idle'];
        $activatedTrap = ['live', 'armed', 'ready', 'primed', 'active'];
        $changedTrap = ['flipped', 'toggled', 'reversed', 'inverted', 'switched'];

        $safedTrapsKeys = [];
        foreach ($this->trapLogs as $key => $states) {
            $intersectDeactivatedTrap = array_intersect($deactivatedTrap, $states);
            if (count($intersectDeactivatedTrap) > 0) {
                continue;
            }

            $numbersActivatedStates = 0;
            $numbersChangedStates = 0;
            foreach ($states as $state) {
                if (in_array($state, $changedTrap, true)) {
                    $numbersChangedStates++;
                }
                if (in_array($state, $activatedTrap, true)) {
                    $numbersActivatedStates++;
                }
            }

            if ($numbersChangedStates !== $numbersActivatedStates) {
                continue;
            }

            $safedTrapsKeys[] = $key;
        }

        return array_sum($safedTrapsKeys);
    }
}