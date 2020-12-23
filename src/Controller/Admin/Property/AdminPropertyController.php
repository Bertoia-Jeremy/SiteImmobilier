<?php

namespace App\Controller\Admin\Property;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PropertyRepository;
use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository){
        $this->repository = $repository;
    }
    
    /**
        * @Route("/admin/property", name="admin.property.index")
    */
    public function index(){
        $properties = $this->repository->findAll();
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
        * @Route("/admin/property/new", name="admin.property.new")
    */
    public function new(Request $request){
        $property = new Property;

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() AND $form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($property);
                $entityManager->flush();
                $this->addFlash('success', 'Bien créé avec succès');
                return $this->redirectToRoute('admin.property.index');
        }
        
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
        * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
    */
    public function edit(Property $property, Request $request){

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() AND $form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->flush();
                $this->addFlash('success', 'Bien modifié avec succès');
                return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
        * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
    */
    public function delete(Property $property, Request $request){

        $submittedToken = $request->request->get('token');

        if($this->isCsrfTokenValid('delete_property', $submittedToken)){

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($property);
            $entityManager->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }

        return $this->redirectToRoute('admin.property.index');
    }

}