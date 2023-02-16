<?php

namespace App\HrCalculations;

class CalculationOptions
{
    # due to time constraints only employee Id is implemented in the functionality
    # I was planning to support multiple calculating options

    private ?int $employeeId = null;
    private ?bool $yearToDate = true;
    private ?int $month = null;


    /**
     * Get the value of month
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set the value of month
     *
     * @return  self
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get the value of employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * Set the value of employeeId
     *
     * @return  self
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    /**
     * Get the value of yearToDate
     */
    public function getYearToDate()
    {
        return $this->yearToDate;
    }

    /**
     * Set the value of yearToDate
     *
     * @return  self
     */
    public function setYearToDate($yearToDate)
    {
        $this->yearToDate = $yearToDate;

        return $this;
    }
}
