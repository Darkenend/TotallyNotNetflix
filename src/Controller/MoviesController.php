<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /**
     * @Route("/movies", name="movies")
     */
    public function index(): Response
    {
        $movies = $this->getDoctrine()->getRepository(Movie::class)->findAll();
        return $this->render('movies/index.html.twig', array('movies' => $movies));
    }

    /**
     * @Route("/movies/{id}", name="movie_info")
     */
     public function movieInfo($id): Response
     {
         $movie = $this->getDoctrine()->getRepository(Movie::class)->find($id);
         return $this->render("movies/movie.html.twig", ['movie' => $movie]);
     }
}
