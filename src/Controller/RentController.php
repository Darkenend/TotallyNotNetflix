<?php

namespace App\Controller;

use App\Entity\Rent;
use App\Form\RentType;
use App\Form\ReturnRentChooseType;
use App\Form\ReturnRentType;
use App\Service\RentDataHelper;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    // Constant Values so that way we can easily modify the prices globally.
    const BASE_COST = 2.5;
    const SHIPPING_COST = 0.5;
    const DELAYDAY_COST = 1.25;

    /**
     * @Route("/rentmenu", name="rentmenu")
     */
    public function index(Request $request): Response
    {
        $rent = new Rent();
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(RentType::class, $rent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $movies = $rent->getIdMovie();
            $rentprice = 0;
            $movies_nostock = [];
            foreach ($movies as $movie)
            {
                // We check every movie to see if there's stock, if there is, then we add the price, if there isn't, we add the id to an array to remove non-stocked movies.
                if ($movie->getStock() != 0)
                    $rentprice += $this->individualMoviePriceCalculation($movie->getOfferType())['Total'];
                else
                    array_push($movies_nostock, $movie->getId());
            }
            // Remove non-stocked Movies
            foreach ($movies_nostock as $movieID)
                $rent->removeIdMovie($movieID);
            // Diminish stock for the movies that we can rent
            foreach ($rent->getIdMovie() as $movie)
                $movie->setStock($movie->getStock()-1);
            // Fill Rent Data
            $date = new DateTime('today');
            $returnDate = $date->add(new DateInterval('P4D'));
            $rent->setDateRent($date);
            $rent->setLengthRent(4);
            $rent->setReturnDate($returnDate);
            $rent->setIsDelayed(false);
            $rent->setPriceRent($rentprice);
            $rent->setDelayPrice(0);
            $rent->setActualReturnDate(null);
            $entityManager->persist($rent);
            $entityManager->flush();
            return $this->render('rent/movierented.html.twig', ['rentID' => $rent->getId(), 'movies' => $movies]);
        }
        return $this->render('rent/rentmenu.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/returnrentmenu", name="returnrent_menu")
     */
    public function returnRentMenu(Request $request): Response
    {
        // We generate a generic object that we can dump later the Form's data, and we'll study that
        $data = new RentDataHelper();
        $form = $this->createForm(ReturnRentChooseType::class, $data);
        $form->handleRequest($request);
        $valid = false;
        if ($form->isSubmitted() && $form->isValid())
        {
            $valid = true;
            $rent = $_POST['return_rent_choose']['rent'];
            return $this->render('rent/returnrentmenu.html.twig', ['rent' => $rent, 'form' => $form->createView(), 'valid' => $valid]);
        }
        return $this->render('rent/returnrentmenu.html.twig', ['form' => $form->createView(), 'valid' => $valid]);
    }

    /**
     * @Route("/returningrent/{rent}", name="returningrent")
     */
    public function returnRent(Rent $rent, Request $request)
    {
        $newRent = $rent;
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ReturnRentType::class, $rent);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $formdata = $form->getData();
            // Form Get Data isn't nice.
            $newRent->setActualReturnDate($formdata->getActualReturnDate());
            $newRent->calculateDelayPrice(self::DELAYDAY_COST);
            foreach ($newRent->getIdMovie() as $movie)
                $movie->setStock($movie->getStock()+1);
            $entityManager->persist($rent);
            $entityManager->flush();
            return $this->render('rent/rentreturned.html.twig', ['rent' => $rent]);
        }
        return $this->render('rent/returnrent.html.twig', ['rent' => $rent, 'form' => $form->createView()]);
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
