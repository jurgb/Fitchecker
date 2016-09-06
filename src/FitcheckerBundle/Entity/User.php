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
     * @ORM\ManyToMany(targetEntity="Consumption", mappedBy="users")
     * @ORM\JoinTable(name="user_consumption",
     *      joinColumns={@ORM\JoinColumn(name="consumption_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      ))
     * @var ArrayCollection|Consumption[]
     */
    private $consumptions;
    /**
     * @ORM\ManyToMany(targetEntity="Sleep", mappedBy="users")
     * @ORM\JoinTable(name="user_sleep",
     *      joinColumns={@ORM\JoinColumn(name="sleep_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      ))
     * @var ArrayCollection|Sleep[]
     */
    private $sleeps;
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
     * @ORM\Column(name="firstname", type="string", nullable=true)
     */
    private $firstname;
    /**
     * @var int
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;
    /**
     * @var string
     * @ORM\Column(name="street", type="string", nullable=true)
     */
    private $street;
    /**
     * @var string
     * @ORM\Column(name="street_number", type="string", nullable=true)
     */
    private $streetNumber;
    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", nullable=true)
     */
    private $zipcode;
    /**
     * @var string
     * @ORM\Column(name="city", type="string", nullable=true)
     */
    private $city;
    /**
     * @var string
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    private $password;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->consumptions = new ArrayCollection();
        $this->sleeps = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    public function setExercises()
    {

    }

    /**
     * @param Exercise $exercise
     */
    public function addExercise(Exercise $exercise)
    {
        $this->exercises->add($exercise);
    }

    /**
     * @return mixed
     */
    public function getConsumption()
    {
        return $this->consumptions;
    }

    /**
     * @param mixed $consumption
     */
    public function setConsumption($consumption)
    {
        $this->consumptions = $consumption;
    }

    /**
     * @return mixed
     */
    public function getSleep()
    {
        return $this->sleeps;
    }

    /**
     * @param mixed $sleep
     */
    public function setSleep($sleep)
    {
        $this->sleeps = $sleep;
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

    /**
     * Remove exercise
     *
     * @param \FitcheckerBundle\Entity\Exercise $exercise
     */
    public function removeExercise(Exercise $exercise)
    {
        $this->exercises->removeElement($exercise);
    }

    /**
     * Add consumption
     *
     * @param \FitcheckerBundle\Entity\Consumption $consumption
     *
     * @return User
     */
    public function addConsumption(Consumption $consumption)
    {
        $this->consumptions[] = $consumption;

        return $this;
    }

    /**
     * Remove consumption
     *
     * @param \FitcheckerBundle\Entity\Consumption $consumption
     */
    public function removeConsumption(Consumption $consumption)
    {
        $this->consumptions->removeElement($consumption);
    }

    /**
     * Add sleep
     *
     * @param \FitcheckerBundle\Entity\Sleep $sleep
     *
     * @return User
     */
    public function addSleep(Sleep $sleep)
    {
        $this->sleeps[] = $sleep;

        return $this;
    }

    /**
     * Remove sleep
     *
     * @param \FitcheckerBundle\Entity\Sleep $sleep
     */
    public function removeSleep(Sleep $sleep)
    {
        $this->sleeps->removeElement($sleep);
    }
}
