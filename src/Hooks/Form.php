<?php

namespace Alnv\ContaoPersonioBundle\Hooks;

use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\Date;
use Contao\System;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LogLevel;

class Form
{

    public function processFormData(array $arrSubmitted, array $arrForm, ?array $arrFiles): void
    {

        if (!$arrSubmitted['job_position_id'] || !$arrSubmitted['company_id'] || !$arrSubmitted['access_token']) {
            return;
        }

        $client = new Client();

        $arrData = [
            'first_name' => $arrSubmitted['first_name'] ?? '',
            'last_name' => $arrSubmitted['last_name'] ?? '',
            'email' => $arrSubmitted['email'] ?? '',
            'phone' => $arrSubmitted['phone'] ?? '',
            'job_position_id' => $arrSubmitted['job_position_id'],
            'message' => $arrSubmitted['message'] ?? '',
            'salary_expectations' => $arrSubmitted['salary_expectations'],
            'birthday' => (($arrSubmitted['birthday'] ?? '') ? \date('Y-m-d', (new Date($arrSubmitted['birthday']))->tstamp) : ''),
            'available_from' => (($arrSubmitted['available_from'] ?? '') ? \date('Y-m-d', (new Date($arrSubmitted['available_from']))->tstamp) : ''),
            'application_date' => \date('Y-m-d', \time()),
            'files' => []
        ];

        foreach ($arrFiles as $arrFile) {

            try {
                $arrPostFile = [];
                $arrPostFile['file'] = \curl_file_create($arrFile['tmp_name'], 'application/pdf', 'my_file.pdf');

                $arrHeaders = [
                    "Accept: application/json",
                    "Content-Type: multipart/form-data",
                    "x-company-id: " . $arrSubmitted['company_id'],
                    "Authorization: Bearer " . $arrSubmitted['access_token']
                ];

                $objRequest = \curl_init('https://api.personio.de/v1/recruiting/applications/documents');
                \curl_setopt($objRequest, CURLOPT_POST, 1);
                \curl_setopt($objRequest, CURLOPT_RETURNTRANSFER, true);
                \curl_setopt($objRequest, CURLOPT_POSTFIELDS, $arrPostFile);
                \curl_setopt($objRequest, CURLOPT_HTTPHEADER, $arrHeaders);

                $objResponse = \curl_exec($objRequest);
                $arrJson = \json_decode($objResponse, true);
                \curl_close($objRequest);

                if (!empty($arrJson)) {
                    $arrJson['category'] = 'cv';
                    $arrData['files'][] = $arrJson;
                }
            } catch (\Exception $exception) {
                System::getContainer()
                    ->get('monolog.logger.contao')
                    ->log(LogLevel::ERROR, $exception->getMessage(), ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__)]);
            }
        }

        try {
            $client->request('POST', 'https://api.personio.de/v1/recruiting/applications', [
                'body' => json_encode($arrData, null, 512),
                'headers' => [
                    'X-Company-ID' => $arrSubmitted['company_id'],
                    'accept' => 'application/json',
                    'authorization' => 'Bearer ' . $arrSubmitted['access_token'],
                    'content-type' => 'application/json',
                ],
            ]);
        } catch (RequestException $exception) {
            System::getContainer()
                ->get('monolog.logger.contao')
                ->log(LogLevel::ERROR, $exception->getMessage(), ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__)]);
        }
    }
}