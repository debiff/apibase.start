<?php
/**
 * Created by PhpStorm.
 * User: simone
 * Date: 18/03/16
 * Time: 23.54
 */
namespace SB\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Accessor;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Accessor(getter="getId")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=32, nullable=true)
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     */
    //
    protected $name;


    public function __construct()
    {
        parent::__construct();
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
