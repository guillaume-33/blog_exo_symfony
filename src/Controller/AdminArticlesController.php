<?php

namespace App\Controller;

use \Symfony\Component\HttpFoundation;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{

    /**
     * @Route ("/admin/articles",name="admin_articles")
     */
        // j'appel les article depuis la BDD
    public function articlesRepository(ArticleRepository $articlesRepository){
        $articles= $articlesRepository->findAll();
        // et l=je les renvoie sur ma page twigx
        return $this->render('admin/articles.html.twig', [
            'articles' => $articles]);
    }
//    /**
//     * @Route("/admin/articles", name="admin_articles")
//     */
//

    // nouvelle route pour la creation des articles
    /**
     * @Route ("/admin/insert-article" , name ="admin_insert_article")
     */
    // je créé une nouvelle methode pour la création de nouveaux articles
    // Grace a EntityManager qui est un service Doctrine qui nous permet de manipuler des entités (Entity)
    public function insertArticles(EntityManagerInterface $entityManager)
    {

        $article = new Article();

        //je reintegre les données voulue grace au seter
        $article->setTilte("toto a la plage");
        $article->setContent("ila pas pris sa bouée ce con !!!");
        $article->setImage("www.goole.fr");
        $article->setAuthor("Moi meme");
        $article->setIsPublished(true);

        //grace a entitymanager, je peux directement enregistrer les données dans la BDD dans la table article
        $entityManager->persist($article); //equivalent git add . et commit (on charge les données)
        $entityManager->flush(); //equivalent push (on envoie les données)
        $this->addFlash('success', 'article créé');// message envoyé si succés
        return $this->redirectToRoute('admin_articles');//redirige sur la page des artocles une fois fini


    }

        /**
         * @Route("/admindelete/article/{id}", name="admin_delete_article")
         */
        public function deleteArticle($id,ArticleRepository $articleRepository , EntityManagerInterface $entityManager){
            $article=$articleRepository->find($id); // on recuêre l'ID de l'article a supprimer
            if (!is_null($article)){ //on verifie si l'id de l'article existe toujours si oui :
                $entityManager->remove($article); // on le supprime
                $entityManager->flush();    // et on 'confirme' a la BDD

                $this->addFlash('success', 'article supprimé'); // pour afficher un message confirmant que c'est modifier.
                return $this->redirectToRoute('home'); //renvoie a la page accueil
            }else{ // si l'article est deja supprimé, on obtient un message qui nous le précise.
                $this->addFlash('error', 'article déjà supprimé');


            }

        }

    /**
     * @Route("/admin/update/article/{id}", name="admin_update_article")
     */
        public function updateArticle($id,ArticleRepository $articleRepository, EntityManagerInterface $entityManager){

            $article=$articleRepository->find($id); //on recherche l'article par son ID
            $article->setTilte('toto cherche son pere'); // on modifie son titre
            $article->setContent("il a besoin de ta bouée toto !");

            $entityManager->persist($article); // on "enregistre la modif"
            $entityManager->flush(); // on l'envoie sur la BDD

            $this->addFlash('success', 'article modifié'); // pour afficher un message confirmant que c'est modifier.
           return $this->redirectToRoute('home'); //renvoie a la page accueil
        }

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