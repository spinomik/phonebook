<?php


namespace App\Controller;


use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PhoneBookController extends AbstractController
{
    /**
     * @Route("/", name="phoneBook")
     */
    public function homepage(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Contact::class);
        $contacts = $repository->findAll();

        return $this->render('phonebook/phonebook.html.twig',[
            'contacts' => $contacts,
        ]);
    }
    /**
     * @Route("/contact/{slug}", name="ContactDetail")
     */
    public function show($slug, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Contact::class);
        $contact = $repository->findOneBy(['id' =>$slug]);
        return $this->render('phonebook/contact.html.twig',[
          'id' => $slug,
          'contact' => $contact,
        ]);
    }

}