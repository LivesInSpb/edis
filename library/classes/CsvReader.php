<?php

namespace library\classes;

use library\abs\File;

class CsvReader extends File
{

    function readFile(): array
    {
        $fileLink = fopen($this->file, "r");

        while ( ($line = fgetcsv($fileLink, 0, ";")) !== FALSE ) {
            $this->fileInArray[] = $line;
        }

        fclose($fileLink);
        return $this->fileInArray;

    }

    function view(): string
    {
        $this->_view = $this->table_start;
        $this->_view .= '<tr> <th>FIO</th><th>Birth</th><th>Comment</th></tr>';

        foreach ( $this->fileInArray as $index => $item ) {
            $this->_view .= sprintf('<tr> <td>%s</td><td>%s</td><td>%s</td></tr>',
                $item[0] . ' ' . $item[1] . ' ' . $item[2], $item[3], $item[4]);
        }

        $this->_view .= $this->table_end;

        return $this->_view;
    }
}
