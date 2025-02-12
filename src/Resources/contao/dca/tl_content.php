<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['personio_reader'] = '{type_legend},type,headline;{personio_legend},form,offices;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID;{invisible_legend:hide},invisible,start,stop';

$GLOBALS['TL_DCA']['tl_content']['fields']['offices'] = [
    'inputType' => 'text',
    'eval' => [
        'maxlength' => 255,
        'tl_class' => 'w50',
    ],
    'exclude' => true,
    'sql' => "varchar(255) NOT NULL default ''"
];