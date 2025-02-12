<?php

namespace Alnv\ContaoPersonioBundle\Elements;

use Alnv\ContaoPersonioBundle\API\Personio;
use Contao\BackendTemplate;
use Contao\Config;
use Contao\ContentElement;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;

class ContentPersonioReader extends ContentElement
{

    protected $strTemplate = 'ce_personio_reader';

    public function generate()
    {

        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer()->get('request_stack')->getCurrentRequest() ?? Request::create(''))) {

            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . \strtoupper(($GLOBALS['TL_LANG']['CTE']['personio_reader'][0] ?? '')) . ' ###';

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    protected function compile()
    {

        $objPersonio = new Personio();

        $this->Template->action = Config::get('personioUrl') ?: '';
        $this->Template->token = Config::get('personioToken') ?: '';
        $this->Template->companyId = Config::get('personioCompanyId') ?: '';
        $this->Template->jobs = $objPersonio->getJobs($this->offices);
    }
}