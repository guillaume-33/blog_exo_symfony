<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleSoloController extends AbstractController
{
//    /**
//     * @Route("/article/{id}", name="article")
//     */

    /**
     * @Route("/admin/article/{id}", name="admin_article")
     */
//------ nouvelle route sans will card grace aux données récupérées via ArticleRepository.
//methode qui va "remplacer" le SELECT FROM WHERE
// on appel une instance de la classe ArticleRepository
    public function articleSolo(ArticleRepository $articleRepository, $id)
    {
        $article= $articleRepository ->find($id);
        //"find" permet de récuperer l'id de la table selectionnée

        //puis on renvoie sur la page twig
        return $this->render('admin/article.html.twig',
            ['article'=> $article]);
    }

}
