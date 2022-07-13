<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category")
     */
    //je fait le lien entre les  entites "categorie" et "article"
    // je demande de recupérer les articles existants liés a une categorie
    private $articles;
    //->J'ajoute moi-même le lien entre article et catégorie - penser à inversedBy dans param ORM
    //pour articles = 1 seule cat
    //pour cat = plusieurs articles
    //->ManyToOne crée la clé étrangère qui permettra de relier une catégorie à un article
    //je créé une fonction __consruct(double underscrore) (cette fonction aura toujours le meme nom, c'est lié a PHP)
    // qui a pour but d'afficher tous les articles trouvés.
    //on passepar un array pour que les articles ne s'ecrasent pas a chaque chargement( permet d'afficher tous les articles)
    //on fait ensuite les "get" et "set" --> clic droit-> generate->getter and setter
    public function __construct(){
        $this->articles= new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return ArrayCollection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param ArrayCollection $articles
     */
    public function setArticles($articles): void
    {
        $this->articles = $articles;
    }


}
//dans cmder j'ordonne de migrer mes infos php vers la table SQL. un comparatif sera fait entre
// les infos préexistantes et les nouvelles pour une MAJ
//fait en 2 temps :
//php bin/console make:migration
//bien vérifier mes infos dans le dossier migrations avant de migrer définitivement vers ma table
// puis php bin/console doctrine:migration:migrat