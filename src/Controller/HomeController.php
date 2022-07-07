<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use PhpParser\Node\Stmt\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class HomeController extends AbstractController
{
    /**
     * @Route ("/home", name="home")
     */
    public function home(ArticleRepository $articleRepository){


        $dernierArticles= $articleRepository->findBy([], ['id'=>'DESC'],3);

        return  $this->render("home.html.twig",[
                         'dernierArticles' => $dernierArticles,
        ]);
    }
//    public function age(Request $request){
//
//        $age = $request->query->get("age");
//            if(age>= 18){
//                return $this ->render("articles.html.twig");
//            }
//            else{
//                return $this -> render('https://www.google.com/');
//            }
//
//    }
}