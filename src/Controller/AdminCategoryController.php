<?php

namespace App\Controller;

use App\Form\CategorieType;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route("/admin/categorie",name="admin_insert_categorie")
     */
    public function category(EntityManagerInterface $entityManager, Request $request){
        //on créé un 'gabarit' via cmd avec "php bin/console make:form"
        $category =new Category();

        $form=$this->createForm( CategorieType::class,$category);//permet de créer automatiquement un formulaire avec les infos qui sont sur la table dans la BDD
        // on le renvoi vers une page twig qui contiendra la commande {{ form(form) }} pour afficher le formulaire


        $form->handleRequest($request);//on créé une instance de la calasse request a ce qui est dans le formulaire pour que celui ci puisse récuperer les données des champs remplis et faire des enregirstrement sue l'entity articles automatiquement.

        //on verifie que l'article a été envoyé et est valide ( avec toutes les infos nécessaires) puis en on enregistre avec  persist et on enregistre avec flush.
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Categorie enregistré');
        }
        return $this->render('admin/insert_categorie.html.twig',[
                'form'=>$form->createView()]
        );


//        $category->setIsPublished(true);
//        $category->setColor("red");
//        $category->setDescription('canicule');
//        $category->setTitle('informations');
//
//        $entityManager->persist($category);
//        $entityManager->flush();
//
//        dd($category);
    }
// code commenté ==> ArticlesController

    /**
     *@Route("admin/category" , name="admin_category")
     */
    public function categoriesinsert(CategoryRepository $categoryRepository){
        $categori = $categoryRepository->find(1);

        dd($categori);
        // commentaire la methode sur ArticleSoloController
    }


    /**
     * @Route ("admin/categories" , name="admin_categories")
     */
    public function categories(CategoryRepository $categoryRepository){
        $categories=$categoryRepository->findAll();
            return $this ->render('admin/categories.html.twig',[
                'categories'=> $categories
            ]);

    }

    /**
     * @Route("admin/categorie/{id}" , name ="admin_categorie")
     */
    public function categorie($id,CategoryRepository $categoryRepository){
        $categorie=$categoryRepository ->find($id);
            return $this ->render('admin/categorie.html.twig', [
                'categorie'=>$categorie
            ]);
    }

    /**
     * @Route("admin/categorie/delete/{id}" , name="admin_delete_categorie")
     */

    public function deleteCategorie($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager){
            $categorie=$categoryRepository->find($id);
                $entityManager->remove($categorie);//sauvegarde
                $entityManager->flush();// envoie ver la BDD
            $this->addFlash('success', 'categorie supprimée'); // pour afficher un message confirmant que c'est suppirmé.
            return $this->redirectToRoute('admin_categories'); //renvoie a la page des categories
    }


    /**
     * @Route("admin/categorie/update/{id}" , name="admin_update_categorie")
     */

    public function updateCategoie( $id , CategoryRepository $categoryRepository , EntityManagerInterface $entityManager ,Request $request){



            $category = $categoryRepository->find($id); //cherche la categorie par l'id.
        $form=$this->createForm(CategorieType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Categorie enregistré');
        }
        return $this->render('admin/formulaire.html.twig',[
                'form'=>$form->createView()]
        );
            $this->addFlash('success', 'categorie modifiée');//message de confirmation

    }


}