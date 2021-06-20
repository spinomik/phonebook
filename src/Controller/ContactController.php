<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Form\AddContact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/add/", name="AddContact")
     */
    public function addContact(EntityManagerInterface $entityManager, Request  $request)
    {
        $form =$this->createForm(AddContact::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success','Dodano rekord do bazy danych');

            return $this->redirectToRoute('phoneBook');
        }
        return $this->render('phonebook/addcontact.html.twig',[
            'AddForm' => $form->createView(),
        ]);

//
//
//        return $this->render('phonebook/addcontact.html.twig');
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

        return $this->redirectToRoute('phoneBook');

    }
}

