<?php

// namespace App\Form;
namespace App\Form;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Aloitekanta;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LinkkiFormType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
         
         ->add('aihe', TextType::class, ['label'=> 'Aihe'])
         ->add('kuvaus', TextType::class, ['label'=> 'Kuvaus'])
         ->add('etunimi', TextType::class, ['label'=> 'Etunimi'])
         ->add('sukunimi', TextType::class, ['label'=> 'Sukunimi'])
         ->add('email', TextType::class, ['label'=> 'Email'])
         ->add('kirjauspvm', DateType::class, ['label'=> 'Kirjauspvm'])
         ->add('save', SubmitType::class, [
             'label'=>'Talleta',
             'attr'=>['class' =>'btn btn-info']
         ]);
        
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
          'data-class' => Aloitekanta::class,
        ]);
    }

}
?>