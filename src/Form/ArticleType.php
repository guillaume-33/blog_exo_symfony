<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tilte')

            ->add('category',EntityType::class,[
                    'class'=>Category::class,
                    'choice_label'=>'title',
                ])
           // permet d'ajouter une " option" dans la création de l'entité article, grace à sa cardinalité avec l'entité "category". on commence par choisir l'entité que l'on veut" raccorder" puis on choisis ce que l'on veut rajouter ( ici, le titre de la category)
            ->add('image')
            ->add('isPublished')
            ->add('author')
            ->add('content')
            ->add('Confirmer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
