<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Form\SearchForm;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PhoneBookController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function search(EntityManagerInterface $entityManager, Request $request)
    {
        $form =$this->createForm(SearchForm::class);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data=$form->getData();
            $type = $form->getData();
            $type= $type['searchType'];
            $data = $data['searchData'];
            $repository = $entityManager->getRepository(Contact::class);
            $result = $repository->findBy([$type=>$data]);

            return $this->render('phonebook/result.html.twig',[
                'SearchForm' => $form->createView(),
                'results' => $result,
                ]);
        }
        return $this->render('phonebook/result.html.twig',[
            'SearchForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{sort}", name="phoneBook")
     */
    public function homepage($sort='id_down',EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request)
    {
        $repository = $entityManager->getRepository(Contact::class);
            if ($sort=='id_up'){
                $contacts = $repository->findBy([],['id'=>'DESC']);
            }
            elseif ($sort=='id_down')
                $contacts = $repository->findBy([],['id'=>'ASC']);
        $paginator=$paginator->paginate(
            $contacts,
            $request->query->getInt('page',1),
            10);
        return $this->render('phonebook/phonebook.html.twig',[
            'pagination' => $paginator,
            'sort' => $sort,
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