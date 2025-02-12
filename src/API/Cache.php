<?php

namespace Alnv\ContaoPersonioBundle\API;

use Contao\Database;
use Contao\StringUtil;

class Cache
{

    public function set($strName, $varValue): void
    {

        $objCache = Database::getInstance()->prepare('SELECT * FROM tl_personio_cache WHERE `key`=?')->limit(1)->execute($strName);

        if ($objCache->numRows) {
            return;
        }

        /*
        $objDatabase->prepare('INSERT INTO tl_personio_cache %s')->set([
            'tstamp' => time(),
            'key' => $strName,
            'value' => $varValue
        ])->execute();
        */
    }

    public function get($strName)
    {

        $objCache = Database::getInstance()->prepare('SELECT * FROM tl_personio_cache WHERE `key`=?')->limit(1)->execute($strName);

        if (!$objCache->numRows) {
            return false;
        }

        return StringUtil::deserialize($objCache->value, true);
    }

    public function clearCache(): void
    {
        Database::getInstance()->prepare('DELETE FROM tl_personio_cache')->execute();
    }
}