<?php

namespace App\HrCalculations;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\HrCalculations\CalculationOptions;
use App\HrCalculations\CalculationResult;
use DateTime;

class CompensationCalculator
{
    /**
     * @var EmployeeRepository
     */
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @return CalculationResult[]
     */
    public function calculate(CalculationOptions $options)
    {
        return $options->getEmployeeId() ? $this->calculateEmployeeHistory($options->getEmployeeId())
            : $this->monthlyReport();
    }

    private function monthlyReport()
    {
        $employees = $this->employeeRepository->findAll();

        $currentDate = new DateTime();
        $calculationResults = [];
        foreach ($employees as $employee) {
            $calculationResult = $this->calculateByMonth($employee, $currentDate);
            $calculationResults[] = $calculationResult;
        }

        return $calculationResults;
    }

    private function calculateEmployeeHistory($employeeId)
    {
        $employee = $this->employeeRepository->find($employeeId);
        $currentDate = new DateTime();
        $calculationResults = [];
        for ($i = 0; $i < 12; $i++) {
            $currentDate->modify('- 1 months');
            $calculationResult = $this->calculateByMonth($employee, $currentDate);
            $calculationResults[] = $calculationResult;
        }
        return $calculationResults;
    }

    /**
     * @return CalculationResult
     */
    private function calculateByMonth(Employee $employee, DateTime $date)
    {
        $calculationResult = new CalculationResult;
        // compensation
        // calculate exactly the workdays for each month
        $totalWorkDaysMonth = $this->countWorkDays($date->format('Y'), $date->format('m'));
        $restDays = $totalWorkDaysMonth % 5;
        $fullWorkWeeks = ($totalWorkDaysMonth - $restDays) / 5;
        $workedDays = $fullWorkWeeks * $employee->getWorkdays();
        // add rest days
        $workedDays += $employee->getWorkdays() < $restDays ? $employee->getWorkdays() : $restDays;
        // calculate total distance based on double the distance and the worked days.
        $totalDistance = $employee->getDistance() * 2 * $workedDays;

        $pricePerKm = $employee->getTransPortType()->getCompensation();
        // double the compensation if the distance is above threshold.
        if ($employee->getDistance() > $employee->getTransPortType()->getDoubleThreshold())
            $pricePerKm * 2;

        $compensation = number_format($totalDistance * $pricePerKm, 2, ',', '.');
        $paymentDate = new DateTime(sprintf('%s-%s-01', $date->format('Y'), $date->format('m')));
        $paymentDate->modify('+1 month')->modify('first monday');

        $calculationResult->setPaymentDate($paymentDate->format('d-m-Y'));
        $calculationResult->setDistance($totalDistance);
        $calculationResult->setCompensation($compensation);
        $calculationResult->setEmployeeName($employee->getName());
        $calculationResult->setTransportType($employee->getTransPortType()->getName());

        return $calculationResult;
    }

    private function countWorkDays($year, $month, $ignore = [0, 6])
    {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }
}
