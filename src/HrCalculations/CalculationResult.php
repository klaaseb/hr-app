<?php

namespace App\HrCalculations;

use DateTime;

class CalculationResult
{
    const labels = ['Employee', 'Transport', 'Traveled distance', 'Compensation', 'Payment date'];

    private ?string $employeeName;
    private ?string $transportType;
    private ?int $distance;
    // formatted
    private ?string $compensation;
    private ?string $paymentDate;
    /**
     * Get the value of employeeName
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     * Set the value of employeeName
     *
     * @return  self
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;

        return $this;
    }

    /**
     * Get the value of transportType
     */
    public function getTransportType()
    {
        return $this->transportType;
    }

    /**
     * Set the value of transportType
     *
     * @return  self
     */
    public function setTransportType($transportType)
    {
        $this->transportType = $transportType;

        return $this;
    }

    /**
     * Get the value of distance
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set the value of distance
     *
     * @return  self
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get the value of compensation
     */
    public function getCompensation()
    {
        return $this->compensation;
    }

    /**
     * Set the value of compensation
     *
     * @return  self
     */
    public function setCompensation($compensation)
    {
        $this->compensation = $compensation;

        return $this;
    }

    /**
     * Get the value of paymentDate
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set the value of paymentDate
     *
     * @return  self
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    public function toArray()
    {
        return [
            $this->employeeName,
            $this->transportType,
            $this->distance,
            $this->compensation,
            $this->paymentDate
        ];
    }
}
