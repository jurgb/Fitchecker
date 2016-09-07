<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipment
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\EquipmentRepository")
 */
class Equipment
{

    /**
     * @ORM\ManyToMany(targetEntity="FitcheckerBundle\Entity\Exercise", mappedBy="equipments")
     * @var ArrayCollection|Exercise[]
     */
    private $exercises;
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
     * @var string
     * @ORM\Column(name="location", type="string", nullable=true)
     */
    private $location;

    /**
     * Equipment constructor.
     */
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
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
     * @return ArrayCollection|Exercise[]
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    /**
     * @param ArrayCollection|Exercise[] $exercises
     */
    public function setExercises($exercises)
    {
        $this->exercises = $exercises;
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
     * @return Equipment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Equipment
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }
}
