<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use ContainerCxaiLxF\getAdminCategoryControllerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route("/admin/categorie",name="admin_insert_categorie")
     */
    public function category(EntityManagerInterface $entityManager){

        $category =new Category();

        $category->setIsPublished(true);
        $category->setColor("red");
        $category->setDescription('canicule');
        $category->setTitle('informations');

        $entityManager->persist($category);
        $entityManager->flush();

        dd($category);
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

        $title = $request->query->get('titre');// on verifie avant toute chose ce qui est envoyé en get
        $color = $request->query->get('color');// on verifie avant toute chose ce qui est envoyé en get
       
        if(!empty($title) &&//on verifie ce qui a ete envoyé en get, si il n'y a rien on fait la suite!
            !empty($color)) {


            $categorie = $categoryRepository->find($id); //cherche la categorie par l'id

            $categorie->setTitle($title); //modifie le titre

            $categorie->setColor($color); // modifie la couleur

            $entityManager->persist($categorie); // on "enregistre la modif"
            $entityManager->flush(); // on l'envoie sur la BDD

            $this->addFlash('success', 'categorie modifiée');
            return $this->redirectToRoute('admin_categories');
        }
        $this ->addFlash('error', 'un probleme est survenue');
        return $this->render('Admin/formulaire.html.twig');

    }


}