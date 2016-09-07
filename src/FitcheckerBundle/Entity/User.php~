<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\ManyToMany(targetEntity="Exercise", inversedBy="users")
     * @ORM\JoinTable(name="user_exercise",
     *      joinColumns={@ORM\JoinColumn(name="exercise_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      ))
     * @var ArrayCollection|Exercise[]
     */
    private $exercises;
    /**
     * @ORM\ManyToMany(targetEntity="Consumption", inversedBy="users")
     * @ORM\JoinTable(name="user_consumption")
     */
    private $consumption;
    /**
     * @ORM\ManyToMany(targetEntity="Sleep", inversedBy="users")
     * @ORM\JoinTable(name="user_sleep")
     */
    private $sleep;
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var int
     */
    private $age;
    /**
     * @var string
     */
    private $street;
    /**
     * @var string
     */
    private $streetNumber;
    /**
     * @var string
     */
    private $zipcode;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $password;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    /**
     * @param Exercise $exercise
     */
    public function addExercise(Exercise $exercise)
    {
        dump($this->exercises);
        $this->exercises->add($exercise);
    }

    /**
     * @return mixed
     */
    public function getConsumption()
    {
        return $this->consumption;
    }

    /**
     * @param mixed $consumption
     */
    public function setConsumption($consumption)
    {
        $this->consumption = $consumption;
    }

    /**
     * @return mixed
     */
    public function getSleep()
    {
        return $this->sleep;
    }

    /**
     * @param mixed $sleep
     */
    public function setSleep($sleep)
    {
        $this->sleep = $sleep;
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
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set streetNumber
     *
     * @param string $streetNumber
     *
     * @return User
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
