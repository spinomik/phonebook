<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PhoneBookController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('phonebook/phonebook.html.twig');
    }
    /**
     * @Route("/contact/{slug}")
     */
    public function show($slug)
    {
        return $this->render('phonebook/contact.html.twig',[
          'id' => $slug
        ]);
    }
}