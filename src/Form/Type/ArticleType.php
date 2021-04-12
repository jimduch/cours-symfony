<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Article;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ArticleType extends AbstractType {
 
    public function buildForm(FormBuilderInterface $builder,array $options){
      $builder->add('title', TextType::class, [
          'label' => 'Titre'
      ]);
      $builder->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label'=> 'name',
        'label' => 'Categorie'

    ]);
    $builder->add('content', TextareaType::class, [
        'label' => 'contenu'
    ]);
      $builder->add('submit', SubmitType::class, [
        'label' => 'Valider'
    ]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }



}