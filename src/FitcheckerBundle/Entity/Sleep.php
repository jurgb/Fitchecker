<?php

namespace FitcheckerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sleep
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\SleepRepository")
 */
class Sleep
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sleeps")
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
     * @var int
     * @ORM\Column(name="hours", type="integer", nullable=false)
     */
    private $hours;

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
     * Get hours
     *
     * @return int
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set hours
     *
     * @param integer $hours
     *
     * @return Sleep
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }
}
