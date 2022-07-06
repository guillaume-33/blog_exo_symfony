<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity() // permet de déclarer que les classes/objets seront des entités/tables
 */
class Article // le nom de notre table(entité) TOUJOURS AVEC lA PREMIERE LETTRE EN MAJ !!!!
{
    /** on declare toujours les 'attributs' avant l'entrée.
     * @ORM\Id() // on commence par déclarer l'id de notre table
     * @ORM\GeneratedValue()// on definie que l'id sera en auto incremente
     * @ORM\Column(type="integer") //et qu'elle sera de type integer
     */
    public $id;


    /**
     * @ORM\Column(type="string") // declarer en "string" revient a declarer que la colone sera en varchar 255.
     */
    public $title;


    /**
     * @ORM\Column(type="string")
     */
    public $image;


    /**
     * @ORM\Column(type="boolean") //pour vérifier si vrai
     */
    public $isPublished;


    /**
     * @ORM\Column (type="string")
     */
    public $autor;
}

//- mappez ces propriétés avec les annotations @ORM
//- générez la requête SQL (migration) avec php bin/console make:migration
//- exécutez la migration en bdd pour créer la table avec php bin/console doctrine:migration:migrate

//Création ou modif d'une entité (classe avec les annotaiton @ORM)
//- php bin/console make:migration pour générer la requête SQL (pour créer / modifier la /les tables)
//- php bin/console doctrine:migration:migrate pour envoyer la requête SQL en bdd