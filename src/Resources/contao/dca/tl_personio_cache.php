<?php

use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_personio_cache'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'key' => 'index'
            ]
        ]
    ],
    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ],
        'key' => [
            'sql' => "varchar(128) NOT NULL default ''"
        ],
        'value' => [
            'sql' => "blob NULL"
        ]
    ]
];