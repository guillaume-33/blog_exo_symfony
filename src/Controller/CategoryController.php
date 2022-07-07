<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("categorie",name="categorie")
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
}