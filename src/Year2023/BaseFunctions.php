<?php
declare(strict_types=1);

namespace FCC\Year2023;

use FCC\Traits\FileReader;

require '../../vendor/autoload.php';

class BaseFunctions
{
    use FileReader;

    protected string $filepath = __DIR__ . '/files/';

    /** @var array<int, string[]>  */
    protected array $trapLogs = [];

    protected function getTrapLogs(): void
    {
        $array = $this->getSimpleFileArray($this->filepath . '03_trap_logs.txt');
//        $array = $this->getSimpleFileArray($this->filepath . 'traped_files_test.txt');
        foreach ($array as $entry) {
            [$key, $value] = explode(': ', $entry);
            $this->trapLogs[trim($key)] = explode(' ', $value);
        }
    }
}