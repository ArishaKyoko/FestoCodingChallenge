<?php
declare(strict_types=1);

namespace FCC\Traits;

trait FileReader
{
    /**
     * @param string $filename
     * @return string[]
     */
    public function getSimpleFileArray(string $filename): array
    {
        $file = file($filename);

        if (!is_array($file)) {
            return [];
        }

        $array = [];
        foreach ($file as $iValue) {
            $array[] = str_replace("\n", '', $iValue);
        }

        return $array;
    }
}