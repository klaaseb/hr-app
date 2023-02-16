<?php

namespace App\HrCalculations;

use App\HrCalculations\CalculationOptions;
use App\HrCalculations\CompensationCalculator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CalculationCsvRenderer extends CompensationCalculator
{
    public function getResponse(CalculationOptions $calculationOptions): BinaryFileResponse
    {
        $calculations = $this->calculate($calculationOptions);
        $file = 'calculations.csv';
        $fp = fopen($file, 'w+');

        // put labels
        fputcsv($fp, CalculationResult::labels);

        foreach ($calculations as $calculation) {
            fputcsv($fp, $calculation->toArray());
        }
        fclose($fp);

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'csv.csv');
        return $response;
    }
}
