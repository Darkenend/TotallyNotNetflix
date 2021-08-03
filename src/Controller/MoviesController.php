<?php

namespace App\Controller;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

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
         $poster_url = $this->obtainMoviePoster($movie->getIdIMDB());
         return $this->render("movies/movie.html.twig", ['movie' => $movie, 'poster_url' => $poster_url]);
     }

    /**
     * This function makes an HTTP request to Open Movie Database (OMDB), to obtain the poster of a Movie, found through it's IMDB ID.
     * @param string $idIMDB IMDB ID of the Movie that we want to get the poster from.
     * @return mixed|string Either the URL for the IMDB poster, or "poster_not_available" to fix it on template rendering.
     */
     private function obtainMoviePoster(string $idIMDB)
     {
         $client = HttpClient::create();
         // It is HTTP sadly, but https doesn't work at the moment with OMDB.
         $link = "http://www.omdbapi.com/?i=".$idIMDB."&apikey=".$_SERVER['OMDB_KEY'];
         try {
             $response = $client->request('GET', $link);
             if ($response->getStatusCode() != 200) {
                 return "poster_not_available";
             }
             $contentArray = $response->toArray();
         } catch (ClientExceptionInterface | DecodingExceptionInterface | RedirectionExceptionInterface | ServerExceptionInterface | TransportExceptionInterface $e) {
             return "poster_not_available";
         }
         return $contentArray['Poster'];
     }
}
