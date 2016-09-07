<?php

namespace FitcheckerBundle\Controller;

use FitcheckerBundle\Entity\Equipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EquipmentController
 * @package FitcheckerBundle\Controller
 */
class EquipmentController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('FitcheckerBundle:Equipment');
        $equipments = $repository->findAll();

        return $this->render(
            'FitcheckerBundle:Equipment:index.html.twig',
            ['equipments' => $equipments]
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        // create new Equipment
        $equipment = new Equipment();

        $form = $this->createFormBuilder($equipment)
            ->add('name', TextType::class)
            ->add('location', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add Equipment'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipment = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($equipment);
            $em->flush();

            return $this->redirectToRoute('fitchecker_equipment_index');
        }

        return $this->render(
            'FitcheckerBundle:Equipment:add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
