<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class Index
{
    public function indexPage(): Response
    {
        $welcome = "Welcome to Totally Not Netflix!";
        $checklist = "Check our movies, place your rent and we'll deliver them to your home!";

        return new Response(
            '<html lang="en"><body><h2>'.$welcome.'</h2><p>'.$checklist.'</p></body>'
        );
    }
}