<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @UniqueEntity("tilte",message= "ce titre existe déja") // permet de vérifier qu'il existe un seul article avec un élément defini ( ici le titre) puis renvoie un message d'erreur voulu cote client (ici ce titre existe deja).
    ne pas oublier d'utiliser le (Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tilte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     */
    private $category;
    // La relation ManyToOne Créée une clé étrangère permettant de lier articles & catégories
    //(manyToone=> une categorie peut avoir plusieurs articles mais un article ne peut avoir qu'une seule categorie
    //une fois que c'est fait, on fait nos migrations avec  "php bin/console make:migration" puis avec "php bin/console doctrine:migrations:migrate".
    //on assigne une categorie a nos article directement sur la BDD (php myAdmin) puis on modifie le twig-->

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTilte(): ?string
    {
        return $this->tilte;
    }

    public function setTilte(string $tilte): self
    {
        $this->tilte = $tilte;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }



}

//dans cmder j'ordonne de migrer mes infos php vers la table SQL. un comparatif sera fait entre
// les infos préexistantes et les nouvelles pour une MAJ
//fait en 2 temps :
//php bin/console make:migration
//bien vérifier mes infos dans le dossier migrations avant de migrer définitivement vers ma table
// puis php bin/console doctrine:migration:migrat