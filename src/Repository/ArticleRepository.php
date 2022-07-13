<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchByWord($search){
    //createQueryBuilder permet de faire une requete SQL mais avec du PHP
        $qb= $this->createQueryBuilder('article');

    //on fait un select sur la table 'article'
        $query= $qb->select('article')

    // on recupere les articles avec dont le titre contient le (:word) mot  recherché
        ->where('article.tilte LIKE :search')

    //la valeur de ':word' est definie et correspond au mot recherché.
    // on indique grace au '%' que le mot peut etre entouré d'autre caracteres (permet une recherche par mot clé et nom en ' aboslu sur uniquement le mot tapé
        ->setParameter('search', '%'.$search.'%')

       //on recupere la requete genérée.
        ->getQuery();

        // on envoie les resultats via la BDD
    return $query->getResult();
    }
}
