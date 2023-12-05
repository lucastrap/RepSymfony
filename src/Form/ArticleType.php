<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use  Symfony\Component\Form\Extension\Core\Type\TextareaType;
use  Symfony\Component\Form\Extension\Core\Type\UrlType;
use  Symfony\Component\Form\Extension\Core\Type\DateType;
use  Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Cocur\Slugify\Slugify;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;




class ArticleType extends AbstractType
{
    // ArticleType.php
// ...

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('title', TextType::class, [
            'label' => 'Title',
            'attr' => ['placeholder' => 'Enter the title...'],
            'required' => true,
        ])
        ->add('content', TextareaType::class, [
            'label' => 'Content',
        ])
        ->add('imageUrl', UrlType::class, [
            'label' => 'Image URL',
        ])
        ->add('categories', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'required' => true,
            'label' => 'Categories',
        ])
        ->add('author', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'name',
            'multiple' => false,
            'expanded' => false,
            'required' => true,
            'label' => 'Author',
        ])
        ->add('slug', TextType::class)

        
        // Add the 'createdAt' and 'updatedAt' fields with the specified format
        ->add('createdAt', DateType::class, [
            'input' => 'datetime_immutable',
            'label' => 'Created At',
            'format' => 'dd MM yyyy',
        ])
        ->add('updatedAt', DateType::class, [
            'input' => 'datetime_immutable',
            'label' => 'Updated At',
            'format' => 'dd MM yyyy',
        ])
      
       
    ;
}

    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}