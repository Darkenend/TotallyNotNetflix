<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    const BASE_COST = 2.5;
    const SHIPPING_COST = 0.5;
    /**
     * @Route("/rent/{id}", name="rent")
     */
    public function index($id): Response
    {
        $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
        $rentcost = $this->individualMoviePriceCalculation($movie->getOfferType());
        return $this->render('rent/index.html.twig', ['movie' => $movie, 'rentcost' => $rentcost]);
    }

    private function individualMoviePriceCalculation(int $offer): array
    {
        $cost = array("Base" => self::BASE_COST, "HalfDiscount" => 0, "TwentyDiscount" => 0, "Shipping" => self::SHIPPING_COST, "Total" => 0);
        $twenty_values = [2, 3, 6, 7, 10, 11, 14, 15];
        if ($offer >= 8)
            $cost["HalfDiscount"] = $cost["Base"] * 0.5 * -1;
        if (in_array($offer, $twenty_values))
            $cost["TwentyDiscount"] = $cost["Base"] * 0.2 * -1;
        if ($offer % 2 != 0)
            $cost["Shipping"] = 0;
        $cost["Total"] = $cost["Base"]+$cost["HalfDiscount"]+$cost["TwentyDiscount"]+$cost["Shipping"];
        return $cost;
    }
}
