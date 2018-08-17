<?php

class CSVArray
{
    private $csv_file;
    private $delimiter;

    public function __construct($file=null, $delimiter=null)
    {
        if ($file == null) {
            throw new Exception('File path cannot be null');
        }

        if (is_file($file)) {
            $this->csv_file = file($file);
        } else {
            echo $file," :Is not a valid file";
        }
        $this->delimiter = $delimiter;
    }

    public function createCSVArray()
    {
        $csv_array = [];
        $keys = str_getcsv(array_shift($this->csv_file), $this->delimiter);
        $keys = str_replace(' ', '', $keys);
        foreach ($this->csv_file as $csv_record) {
            $csv_record = str_replace(' ', '', $csv_record);
            $csv_array[] = array_combine($keys, str_getcsv($csv_record, $this->delimiter));
        }
        return $csv_array;
    }
}
