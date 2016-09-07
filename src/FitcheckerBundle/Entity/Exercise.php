<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\OneToMany(targetEntity="FitcheckerBundle\Entity\ExerciceSet", mappedBy="exercise")
     * @var ArrayCollection|ExerciceSet[]
     */
    private $exercisesets;

    /**
     * @ORM\ManyToMany(targetEntity="Equipment",inversedBy="exercises")
     * @ORM\JoinTable(name="exercise_equipment",
     *      joinColumns={@ORM\JoinColumn(name="exercise_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipment_id", referencedColumnName="id")}
     *      )
     */
    private $equipments;
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
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid name."
     * )
     */
    private $name;

    /**
     * Exercise constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->exercisesets = new ArrayCollection();
        $this->equipments = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|ExerciceSet[]
     */
    public function getExercisesets()
    {
        return $this->exercisesets;
    }

    /**
     * @param ArrayCollection|ExerciceSet[] $exercisesets
     */
    public function setExercisesets($exercisesets)
    {
        $this->exercisesets = $exercisesets;
    }

    /**
     * @return mixed
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param mixed $equipments
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Remove user
     *
     * @param \FitcheckerBundle\Entity\User $user
     */
    public function removeUser(User $user)
    {
        $this->users->removeElement($user);
    }
}
