<?php

// namespace App\Form;
namespace App\Form;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LoginFormType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
         
        
         
         ->add('email', TextType::class, ['label'=> 'Email'])
         ->add('password', DateType::class, ['label'=> 'Password'])
         ->add('save', SubmitType::class, [
             'label'=>'Login',
             'attr'=>['class' =>'btn btn-secoundary']
         ]);
        
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
          'data-class' => Users::class,
        ]);
    }

}
?>