<?php

namespace FitcheckerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ExerciceSet
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\ExerciceSetRepository")
 */
class ExerciceSet
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="exercisesets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="FitcheckerBundle\Entity\Exercise", inversedBy="exercisesets")
     * @ORM\JoinColumn(name="exercise_id", referencedColumnName="id")
     */
    private $exercise;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var int
     * @ORM\Column(name="reps", type="integer", nullable=true)
     * @Assert\GreaterThan(0)
     */
    private $reps;

    /**
     * @return mixed
     */
    public function getExercise()
    {
        return $this->exercise;
    }

    /**
     * @param mixed $exercise
     */
    public function setExercise($exercise)
    {
        $this->exercise = $exercise;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get reps
     *
     * @return int
     */
    public function getReps()
    {
        return $this->reps;
    }

    /**
     * Set reps
     *
     * @param integer $reps
     *
     * @return ExerciceSet
     */
    public function setReps($reps)
    {
        $this->reps = $reps;

        return $this;
    }
}
