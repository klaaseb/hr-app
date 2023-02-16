<?php

namespace App\Controller;

use App\HrCalculations\CalculationCsvRenderer;
use App\HrCalculations\CalculationOptions;
use App\HrCalculations\CalculationResult;
use App\HrCalculations\CompensationCalculator;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HrController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        $employees = $employeeRepository->findAll();
        return $this->render('hr/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    #[Route('/download', name: 'download_all')]
    public function downloadAll(CalculationCsvRenderer $calculationCsvRenderer)
    {
        $options = new CalculationOptions;
        return $calculationCsvRenderer->getResponse($options);
    }

    #[Route('/view', name: 'view_all')]
    public function viewAll(CompensationCalculator $compensationCalculator)
    {
        $options = new CalculationOptions;

        $calculations = $compensationCalculator->calculate($options);
        return $this->render('hr/calculation-detail.html.twig', [
            'calculations' => $calculations,
            'labels' => CalculationResult::labels
        ]);
    }

    #[Route('/download/{id}', name: 'download_employee')]
    public function downloadEmployee(int $id, CalculationCsvRenderer $calculationCsvRenderer)
    {
        $options = new CalculationOptions;
        $options->setEmployeeId($id);

        return $calculationCsvRenderer->getResponse($options);
    }

    #[Route('/view/{id}', name: 'view_employee')]
    public function viewEmployee(int $id, CompensationCalculator $compensationCalculator)
    {
        $options = new CalculationOptions;
        $options->setEmployeeId($id);

        $calculations = $compensationCalculator->calculate($options);
        return $this->render('hr/calculation-detail.html.twig', [
            'calculations' => $calculations,
            'labels' => CalculationResult::labels
        ]);
    }
}
