<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ExerciceSet
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\ExerciceSetRepository")
 */
class ExerciceSet
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="exercisesets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @var ArrayCollection|User[]
     */
    private $users;

    /**
     * ExerciceSet constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }


    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users->add($user);
    }
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
     */
    private $reps;


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

    /**
     * Get reps
     *
     * @return int
     */
    public function getReps()
    {
        return $this->reps;
    }
}
