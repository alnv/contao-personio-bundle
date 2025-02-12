<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{personio_settings},personioToken,personioCompanyId,personioUrl,personioHost';

$GLOBALS['TL_DCA']['tl_settings']['fields']['personioToken'] = [
    'inputType' => 'text',
    'eval' => [
        'tl_class' => 'w50'
    ]
];
$GLOBALS['TL_DCA']['tl_settings']['fields']['personioCompanyId'] = [
    'inputType' => 'text',
    'eval' => [
        'tl_class' => 'w50'
    ]
];
$GLOBALS['TL_DCA']['tl_settings']['fields']['personioUrl'] = [
    'inputType' => 'text',
    'eval' => [
        'tl_class' => 'w50'
    ]
];
$GLOBALS['TL_DCA']['tl_settings']['fields']['personioHost'] = [
    'inputType' => 'text',
    'eval' => [
        'tl_class' => 'w50'
    ]
];