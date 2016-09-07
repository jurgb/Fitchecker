<?php

namespace FitcheckerBundle\Controller;

use FitcheckerBundle\Entity\ExerciceSet;
use FitcheckerBundle\Entity\Exercise;
use FitcheckerBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package FitcheckerBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signupAction(Request $request)
    {
        // create a user
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('street', TextType::class)
            ->add('streetNumber', TextType::class)
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add('password', PasswordType::class)
            ->add('Age', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            return $this->redirectToRoute('fitchecker_user_show', ['user_id' => $user->getId()]);
        }

        return $this->render(
            'FitcheckerBundle:User:signup.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param $user_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($user_id)
    {

        $repository = $this->getDoctrine()->getRepository('FitcheckerBundle:User');
        // dynamic method names to find a single product based on a column value
        $user = $repository->find($user_id);

        return $this->render('FitcheckerBundle:User:show.html.twig', ['user' => $user]);
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addExerciseAction($user_id, Request $request)
    {
        //get the current user
        $user = $this->getDoctrine()
            ->getRepository('FitcheckerBundle:User')
            ->find($user_id);

        //get all exercises
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('FitcheckerBundle:Exercise');
        // dynamic method names to find a single product based on a column value
        $exercises = $repository->findAll();


        $form = $this->createFormBuilder($exercises)
            ->add(
                'Exercise',
                EntityType::class,
                [
                    // query choices from this entity
                    'class' => 'FitcheckerBundle\Entity\Exercise',

                    // use the Exercise.name property as the visible option string
                    'choice_label' => 'name',

                    // used to render a select box, check boxes or radios
                    'multiple' => true,
                    'expanded' => true,
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'add exercise'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exercise = $form['Exercise']->getData();
            $user->setExercises($exercise);
            //$user->addExercise($exercise);
            $em->flush();

            return $this->redirectToRoute('fitchecker_user_show', ['user_id' => $user->getId()]);
        }

        return $this->render(
            'FitcheckerBundle:User:addExercise.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param $user_id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addExerciseSetAction($user_id, Request $request)
    {
        //create a new ExerciseSet
        $exerciseSet = new ExerciceSet();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FitcheckerBundle:User')->find($user_id);

        $form = $this->createFormBuilder($exerciseSet)
            ->add(
                'exercise',
                EntityType::class,
                [
                    'class' => 'FitcheckerBundle\Entity\Exercise',

                    // use the Exercise.name property as the visible option string
                    'choice_label' => 'name',
                    'placeholder' => 'choose an exercise',
                ]
            )
            ->add('reps', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'add set'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exerciseSet = $form->getData();
            $exerciseSet->setUser($user);
            $em->persist($exerciseSet);
            $em->flush();

            return $this->redirectToRoute('fitchecker_user_show', ['user_id' => $user->getId()]);
        }

        return $this->render(
            'FitcheckerBundle:User:addExerciseSet.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
