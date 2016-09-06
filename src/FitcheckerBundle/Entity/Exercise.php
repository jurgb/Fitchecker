<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Exercise
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\ExerciseRepository")
 */
class Exercise
{
    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="exercises")
     * @var ArrayCollection|User[]
     */
    private $users;

    /**
     * Exercise constructor.
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
     * @var string
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     *
     * @return Exercise
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Remove user
     *
     * @param \FitcheckerBundle\Entity\User $user
     */
    public function removeUser(\FitcheckerBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }
}
