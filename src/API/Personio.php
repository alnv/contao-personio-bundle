<?php

namespace Alnv\ContaoPersonioBundle\API;

use Contao\Config;

class Personio
{

    protected Cache $objCache;

    public function __construct()
    {
        $this->objCache = new Cache();
    }

    public function getJobs($strOffice = '')
    {

        $varJobs = $this->objCache->get('jobs');

        if ($varJobs !== false) {
            return $varJobs;
        }

        global $objPage;

        $objJobsXml = \simplexml_load_file('https://' . Config::get('personioHost') . '.jobs.personio.de/xml?language=' . $objPage->language);
        $arrFilters = \explode(',', $strOffice);
        $arrJobs = [];

        foreach ($objJobsXml->position as $objJob) {

            $arrJob = [];

            if (\is_array($arrFilters) && !empty($arrFilters) && $arrFilters[0] !== '') {
                if (!\in_array((string)$objJob->office, $arrFilters)) {
                    continue;
                }
            }

            foreach ($objJob as $strField => $varValue) {

                $arrJob[$strField] = $this->parseJob($strField, $varValue);
            }

            $arrJobs[] = $arrJob;
        }

        $this->objCache->set('jobs', $arrJobs);

        return $arrJobs;
    }

    protected function parseJob($strField, $varValue)
    {

        switch ($strField) {
            case 'id':
                return (string)$varValue;
            case 'office':
                return (string)$varValue;
            case 'department':
                return (string)$varValue;
            case 'recruitingCategory':
                return (string)$varValue;
            case 'name':
                return (string)$varValue;
            case 'jobDescriptions':
                $arrValues = [];
                foreach ($varValue as $objValue) {
                    $arrValues[] = [
                        'headline' => (string)$objValue->name,
                        'content' => trim((string)$objValue->value)
                    ];
                }
                return $arrValues;
            case 'employmentType':
                return (string)$varValue;
            case 'seniority':
                return (string)$varValue;
            case 'schedule':
                return (string)$varValue;
            case 'yearsOfExperience':
                return (string)$varValue;
            case 'occupation':
                return (string)$varValue;
            case 'occupationCategory':
                return (string)$varValue;
            case 'createdAt':
                $varValue = (string)$varValue;
                if (!$varValue) {
                    return '';
                }
                return \date('U', strtotime($varValue));
        }

        return '';
    }
}
