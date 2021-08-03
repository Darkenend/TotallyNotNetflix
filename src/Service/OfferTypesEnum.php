<?php


namespace App\Service;


class OfferTypesEnum
{
    const None = 0;
    const FreeShipping = 1;
    const TwentyPercentOff = 2;
    // Not implemented yet because we don't have a cart
    //const FreeWithTwoOtherRents = 4;
    const FiftyPercentOff = 8;
}