<?php
namespace App\Service;


use App\Entity\Quotation;

class QuotationService
{

    public function __construct()
    {



    }

    public function choicePack(Quotation $quotation)
    {

        if ($quotation->getPackageType() === [0]) {
            
        } else {

        }

    }

}