<?php

namespace FitcheckerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Consumption
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\ConsumptionRepository")
 */
class Consumption
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="consumptions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $name;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
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
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Consumption
     */
    public function setType($type)
    {
        $this->type = $type;

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
     * Set name
     *
     * @param string $name
     *
     * @return Consumption
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
