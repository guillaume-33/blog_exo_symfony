<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route("/admin/categorie",name="admin_categorie")
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
}