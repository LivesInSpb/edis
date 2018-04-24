<?php

namespace library\classes;

use library\abs\File;

class XmlReader extends File
{

    protected $typeFile = 'xml1';

    /**
     * @var array
     * fields for view.
     * If count fields need more - add more
     */
    //@formatter:off
    protected $fields = [
        'first_name'        => 'fname',
        'last_name'         => 'lname',
        'middle_name'       => 'mname',
        'birth_date'        => 'birth_date',
        'comment'           => 'comment'
    ];
    //@formatter:on
    protected $json = '';

    function __construct($file, string $typeFile)
    {
        parent::__construct($file);
        $this->typeFile = $typeFile;
    }

    function view(): string
    {

        $this->_view = $this->table_start;
        $this->_view .= '<tr> <th>FIO</th><th>Birth</th><th>Comment</th></tr>';
        $this->_view .= $this->preView($this->typeFile);
        $this->_view .= $this->table_end;

        return $this->_view;
    }

    /**
     * @return array|mixed
     */
    function readFile(): array
    {
        $xml = simplexml_load_file($this->file);
        $this->json = json_encode($xml);
        $this->fileInArray = json_decode($this->json, TRUE);

        return $this->fileInArray;
    }

    protected function preView($type)
    {
        if ( $type === 'xml1' ) {
            foreach ( $this->fileInArray['workers']['worker'] as $index => $worker ) {
                $this->_view .= sprintf('<tr> <td>%s</td><td>%s</td><td>%s</td></tr>',
                    $worker['param'][0] . ' ' . $worker['param'][1] . ' ' . $worker['param'][2], $worker['param'][3], $worker['param'][4]);
            }
        }
        else {
            foreach ( $this->fileInArray['workers']['worker'] as $index => $worker ) {
                $this->_view .= sprintf('<tr> <td>%s</td><td>%s</td><td>%s</td></tr>',
                    $worker[$this->fields['first_name']] . ' ' . $worker[$this->fields['last_name']] . ' ' . $worker[$this->fields['middle_name']], $worker[$this->fields['birth_date']], $worker[$this->fields['comment']]);
            }
        }
    }
}
