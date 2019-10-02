<?php

namespace App\Controller;

use App\Entity\Aloitekanta;
use App\Form\LinkkiFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AloitelaatikkoController extends AbstractController{

/**
 * @Route("/aloite", name="aloite_lista")
 */
   
 public function index(){

    //get all from database
     $aloitet = $this->getDoctrine()->getRepository(Aloitekanta::class)->findAll();

     //pyydetään näkymää näyttämään kaikki linkit
      return $this->render('aloite/index.html.twig', [
          'aloitet' => $aloitet
      ]);
  }

  /**
 * @Route("/aloite/uusi", name="aloite_uusi")
 */

 public function uusi(Request $request){

    //Luodaan linkki -olio
     $aloite = new Aloitekanta();

     //Luodaan lomake
$form = $this->createForm(
    LinkkiFormType::class,
    $aloite, [
        'action' => $this->generateUrl('aloite_uusi'),
        'attr' => ['class' => 'form-signin']
    ]
);

//käsitellään lomakkeelta tulleet tiedot
$form->handleRequest($request);
if($form->isSubmitted()){
    // Talletetaan lomakettiedot muutujaan
    $aloite = $form->getData();

    // Talletetaan tietokantaan
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($aloite);
    $entityManager->flush();

    return $this->redirectToRoute('aloite_lista');
}

    // Kutsutaan index-kontrolleria
     return $this->render('aloite/uusi.html.twig', [
         'form1' => $form->createView()
     ]);
 }

  /**
 * @Route("/aloite/{id}", name= "aloite_nayta")
 */

public function nayta($id){
    $aloitet = $this->getDoctrine()->getRepository(Aloitekanta::class)->find($id);

    return $this->render('aloite/nayta.html.twig', [
        'aloitet' => $aloitet,
    ]);
 }

  /**
 * @Route("/aloite/muokkaa/{id}", name="aloite_muokkaa")
 */

public function muokkaa(Request $request, $id){
    $aloitet = $this->getDoctrine()->getRepository(Aloitekanta::class)->find($id);
    

 $form = $this->createForm(
    LinkkiFormType::class,
    $aloitet, [
        
        'attr' => ['class' => 'form-signin']
    ]
);

//käsitellään lomakkeelta tulleet tiedot
$form->handleRequest($request);
if($form->isSubmitted()){
    // Talletetaan lomakettiedot muutujaan
    $linkki = $form->getData();

    // Talletetaan tietokantaan
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();

    // Kutsutaan index-kontroller
    return $this->redirectToRoute('aloite_lista');
}

return $this->render('aloite/muokkaa.html.twig', [
    'form1' => $form->createView(),
]);

}

  /**
 * @Route("/aloite/poista/{id}", name="aloite_poista")
 */

public function poista(Request $request, $id){

    $aloitet = $this->getDoctrine()->getRepository(Aloitekanta::class)->find($id);
   
    //Poistetaan tietokannaasta
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($aloitet);
    $entityManager->flush();

    // Kutsutaan index-kontroller
    return $this->redirectToRoute('aloite_lista');

    return $this->render('aloite/poista.html.twig');
 }
  }



?>