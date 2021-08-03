<?php


namespace App\Service;


use App\Entity\Rent;

class RentDataHelper
{
    private $rent;

    /**
     * @param Rent $rent
     */
    public function setRent(Rent $rent): void
    {
        $this->rent = $rent;
    }

    /**
     * @return mixed
     */
    public function getRent()
    {
        return $this->rent;
    }
}