<?php

use Contao\ArrayUtil;
use Alnv\ContaoPersonioBundle\API\Cache;
use Alnv\ContaoPersonioBundle\Hooks\Form;
use Alnv\ContaoPersonioBundle\Elements\ContentPersonioReader;

$GLOBALS['TL_CRON']['hourly'][] = [Cache::class, 'clearCache'];
$GLOBALS['TL_HOOKS']['processFormData'][] = [Form::class, 'processFormData'];

ArrayUtil::arrayInsert($GLOBALS['TL_CTE'], 4, [
    'personio' => [
        'personio_reader' => ContentPersonioReader::class
    ]
]);