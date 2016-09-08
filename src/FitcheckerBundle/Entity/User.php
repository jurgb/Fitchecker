<?php

namespace FitcheckerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 * @ORM\Entity(repositoryClass="FitcheckerBundle\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
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
     * @ORM\OneToMany(targetEntity="Consumption", mappedBy="user")
     * @var ArrayCollection|Consumption[]
     */
    private $consumptions;
    /**
     * @ORM\OneToMany(targetEntity="Sleep", mappedBy="user")
     * @var ArrayCollection|Sleep[]
     */
    private $sleeps;
    /**
     * @ORM\OneToMany(targetEntity="FitcheckerBundle\Entity\ExerciceSet", mappedBy="user")
     * @var ArrayCollection|ExerciceSet[]
     */
    private $exercisesets;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="email",type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(name="username",type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(name="password",type="string", length=64)
     */
    private $password;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=true)
     * @Assert\NotBlank(
     *     groups={"FullProfile"}
     * )
     */
    private $name;
    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", nullable=true)
     * @Assert\NotBlank(
     *     groups={"FullProfile"}
     * )
     */
    private $firstname;
    /**
     * @var int
     * @ORM\Column(name="age", type="integer", nullable=true)
     * @Assert\NotBlank(
     *     groups={"FullProfile"}
     * )
     * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid age.",
     *     groups={"FullProfile"}
     * )
     * @Assert\Range(
     *      min = 16,
     *      max = 120,
     *      minMessage = "You must be at least {{ limit }} years old to gain acces to this application",
     *      maxMessage = "You cannot be older than {{ limit }}",
     *      groups={"FullProfile"}
     * )
     */
    private $age;
    /**
     * @var string
     * @ORM\Column(name="street", type="string", nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid street."
     * )
     */
    private $street;
    /**
     * @var string
     * @ORM\Column(name="street_number", type="string", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid streetnumber."
     * )
     */
    private $streetNumber;
    /**
     * @var string
     * @ORM\Column(name="zipcode", type="string", nullable=true)
     * @Assert\Type(
     *     type="numeric",
     *     message="The value {{ value }} is not a valid zipcode."
     * )
     */
    private $zipcode;
    /**
     * @var string
     * @ORM\Column(name="city", type="string", nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="The value {{ value }} is not a valid city."
     * )
     */
    private $city;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
        $this->consumptions = new ArrayCollection();
        $this->sleeps = new ArrayCollection();
        $this->exercisesets = new ArrayCollection();
    }

    /**
     * @return ArrayCollection|Consumption[]
     */
    public function getConsumptions()
    {
        return $this->consumptions;
    }

    /**
     * @param ArrayCollection|Consumption[] $consumptions
     */
    public function setConsumptions($consumptions)
    {
        $this->consumptions = $consumptions;
    }

    /**
     * @return ArrayCollection|Sleep[]
     */
    public function getSleeps()
    {
        return $this->sleeps;
    }

    /**
     * @param ArrayCollection|Sleep[] $sleeps
     */
    public function setSleeps($sleeps)
    {
        $this->sleeps = $sleeps;
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
    public function getExercises()
    {
        return $this->exercises;
    }


    /**
     * @param ArrayCollection $selectedExercises
     */
    public function setExercises(ArrayCollection $selectedExercises)
    {
        $this->exercises = $selectedExercises;
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
     * Remove exercise
     *
     * @param \FitcheckerBundle\Entity\Exercise $exercise
     */
    public function removeExercise(Exercise $exercise)
    {
        $this->exercises->removeElement($exercise);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
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

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
        return ['ROLE_USER'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
        return null;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
