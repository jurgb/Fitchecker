<?php

namespace FitcheckerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FitcheckerBundle\Entity\Exercise;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class ExerciseController
 * @package FitcheckerBundle\Controller
 */
class ExerciseController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render(
            'FitcheckerBundle:Exercise:index.html.twig'
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        // create a exercise
        $exercise = new Exercise();

        $form = $this->createFormBuilder($exercise)
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Add exercise'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $exercise = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($exercise);
            $em->flush();

            return $this->redirectToRoute('fitchecker_exercise_index');
        }

        return $this->render(
            'FitcheckerBundle:Exercise:add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
