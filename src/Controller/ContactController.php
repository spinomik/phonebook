<?php


namespace App\Controller;


use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/add/", name="AddContact")
     */
    public function addContact(EntityManagerInterface $entityManager)
    {
        $contact = new Contact();
        $contact->setName('Jan');
        $contact->setLastName('Kowalski');
        $contact->setPhoneNumber(666968857);
        $contact->setLocality('Poznań');
        $contact->setZipCode('01-004');
        $contact->setStreet('Poznańska');
        $contact->setNumberOfTheBulding(10);
        $contact->setNumberApartment('43');
        $entityManager->persist($contact);
        $entityManager->flush();

        return $this->render('phonebook/addcontact.html.twig');
    }
    /**
     * @Route("/delete/{slug}", name="DeleteContact")
     */
    public function delete($slug, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Contact::class);
        $contact = $repository->findOneBy(['id' =>$slug]);
        $entityManager->remove($contact);
        $entityManager->flush();
        $repository = $entityManager->getRepository(Contact::class);
        $contacts = $repository->findAll();
        $response = $this->forward('App\Controller\PhoneBookController::homepage',[
            'contacts' => $contacts
        ]);
        return $response;

    }
}

