<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\TransportType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create start data for employees

        // creating transport types
        $transportTypes = [
            ['name' =>  'Bike', 'compensation' => 0.10, 'double_threshold' => 5], // id 1
            ['name' =>  'Car', 'compensation' => 0.10], // id 2
            ['name' =>  'Bus', 'compensation' => 0.25], // id 3
            ['name' =>  'Train', 'compensation' => 0.25], // id 4
        ];

        foreach ($transportTypes as $transportTypData) {
            $transportType = new TransportType();
            $transportType->setName($transportTypData['name']);
            $transportType->setCompensation($transportTypData['compensation']);
            if (array_key_exists('double_threshold', $transportTypData)) {
                $transportType->setDoubleThreshold($transportTypData['double_threshold']);
            }
            $manager->persist($transportType);
        }
        $manager->flush();

        // creating employees

        $employees = [
            ['name' => 'Paul', 'transport_type_id' => 2, 'distance' => 60, 'workdays' => 5],
            ['name' => 'Martin', 'transport_type_id' => 3, 'distance' => 8, 'workdays' => 4],
            ['name' => 'Jeroen', 'transport_type_id' => 1, 'distance' => 9, 'workdays' => 5],
            ['name' => 'Tineke', 'transport_type_id' => 1, 'distance' => 4, 'workdays' => 3],
            ['name' => 'Arnout', 'transport_type_id' => 4, 'distance' => 23, 'workdays' => 5],
            ['name' => 'Matthijs', 'transport_type_id' => 1, 'distance' => 11, 'workdays' => 4.5],
            ['name' => 'Rens', 'transport_type_id' => 2, 'distance' => 12, 'workdays' => 5],
        ];
        foreach ($employees as $employeeData) {
            $employee = new Employee();
            $employee->setName($employeeData['name']);
            $employee->setTransPortType($manager->getReference(TransportType::class, $employeeData['transport_type_id']));
            $employee->setDistance($employeeData['distance']);
            $employee->setWorkdays($employeeData['workdays']);
            $manager->persist($employee);
        }

        $manager->flush();
    }
}
