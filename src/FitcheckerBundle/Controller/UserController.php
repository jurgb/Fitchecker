<?php

namespace FitcheckerBundle\Controller;

use FitcheckerBundle\Entity\Consumption;
use FitcheckerBundle\Entity\ExerciceSet;
use FitcheckerBundle\Entity\Exercise;
use FitcheckerBundle\Entity\Sleep;
use FitcheckerBundle\Entity\User;
use FitcheckerBundle\Form\UserType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            //$user = $form->getData();

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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'FitcheckerBundle:User:login.html.twig',
            [
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
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

    /**
     * @param $user_id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addConsumptionAction($user_id, Request $request)
    {
        //Make a new Consumption
        $consumption = new Consumption();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FitcheckerBundle:User')->find($user_id);

        $form = $this->createFormBuilder($consumption)
            ->add('name', TextType::class)
            ->add(
                'type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Healthy' => 'Healthy',
                        'Unhealthy' => 'Unhealthy',
                        'Inbetween' => 'Inbetween',
                    ],
                ]
            )
            ->add('save', SubmitType::class, ['label' => 'add consumption'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consumption = $form->getData();
            $consumption->setUser($user);
            $em->persist($consumption);
            $em->flush();

            return $this->redirectToRoute('fitchecker_user_show', ['user_id' => $user->getId()]);
        }

        return $this->render(
            'FitcheckerBundle:User:addConsumption.html.twig',
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
    public function addSleepAction($user_id, Request $request)
    {
        //Make a new Sleep
        $sleep = new Sleep();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('FitcheckerBundle:User')->find($user_id);

        $form = $this->createFormBuilder($sleep)
            ->add('hours', IntegerType::class)
            ->add('save', SubmitType::class, ['label' => 'add sleep'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sleep = $form->getData();
            $sleep->setUser($user);
            $em->persist($sleep);
            $em->flush();

            return $this->redirectToRoute('fitchecker_user_show', ['user_id' => $user->getId()]);
        }

        return $this->render(
            'FitcheckerBundle:User:addConsumption.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }


}
