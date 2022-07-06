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
}