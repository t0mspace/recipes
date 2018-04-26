<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $lastname;


    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $password;


//	/**
//	 * @var string
//	 *
//	 * @ORM\Column(type="string")
//	 */
//	private $role;


    /**
     * @var Group
     * /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="users")
     * @ORM\JoinColumn(name="group_ref", referencedColumnName="id", nullable=false)
     */
    private $group;

    /**
     *@var boolean
     *@ORM\Column(type="boolean");
     *
     */
    private $active;




    /**
     * @var \DateTime
     *
     *@ORM\Column(type="datetime", nullable=false)
     *
     *
     */
    private $createdAt;



    /**
     * @var \DateTime
     *
     *
     * @ORM\Column(type="datetime",nullable=true)
     *
     */
    private $updatedAt;

    /**
     * User constructor.
     * @param DateTime $createdAt
     */
    public function __construct()
    {
        $this->setCreatedAtValue(new \DateTime());
    }


    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id ): void {
        $this->id = $id;
    }



    /**
     * @param Group $group
     */
    public function setGroup( Group $group ) {
        $this->group= $group;
    }

    public function setRole($role)
    {
        $this->setGroup($role);
    }

//    /**
//     * @return Group
//     */
//    public function getGroup() {
//        return $this->group;
//    }
//
//
//
//    public function getRoles()
//    {
//        return $this->group->getRole();
//    }
//
//    public function getRole()
//    {
//        return (string)$this->group->getRole();
//    }


    public function getGroup() {
        return $this->group;
    }
    public function getRoles() :array
    {
        return array($this->group->getRole());
    }


    public function isAdmin()
    {
        return 'ROLE_ADMIN' === $this->getGroup()->getRole();
    }



//	public function isGroup(string $groupName)
//	{
//		return $groupName === $this->getRoles();
//	}



    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt() {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername() {
        return $this->username;
    }





    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {

    }


    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }




    /**
     * @return mixed
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname(string $firstname ): void {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname(string $lastname ): void {
        $this->lastname = $lastname;
    }

    /**
     * @param string $username
     */
    public function setUsername( string $username ): void {
        $this->username = $username;
    }


    public function isActive()
    {
        return $this->active;
    }


    /**
     * @param bool $active
     */
    public function setActive(bool $active):void {
        $this->active=$active;
    }

    /**
     * @return void
     */
    public function setInactive(): void
    {
        if($this->isActive())
        {
            $this->active = false;
        }
    }



    public function setCreatedAtValue(DateTime $dateTime)
    {
        $this->createdAt = $dateTime;
    }


    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }


    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt():? DateTime {
        return $this->updatedAt;
    }





    /**
     * @return string
     */
    public function getFullName():string
    {
        $fullname = $this->getFirstname().' '.$this->getLastname();

        return $fullname;
    }

//	/**
//	 * Checks whether the user's account has expired.
//	 *
//	 * Internally, if this method returns false, the authentication system
//	 * will throw an AccountExpiredException and prevent login.
//	 *
//	 * @return bool true if the user's account is non expired, false otherwise
//	 *
//	 * @see AccountExpiredException
//	 */
//	public function isAccountNonExpired() {
//		return true;
//	}
//
//	/**
//	 * Checks whether the user is locked.
//	 *
//	 * Internally, if this method returns false, the authentication system
//	 * will throw a LockedException and prevent login.
//	 *
//	 * @return bool true if the user is not locked, false otherwise
//	 *
//	 * @see LockedException
//	 */
//	public function isAccountNonLocked() {
//		return true;
//	}
//
//	/**
//	 * Checks whether the user's credentials (password) has expired.
//	 *
//	 * Internally, if this method returns false, the authentication system
//	 * will throw a CredentialsExpiredException and prevent login.
//	 *
//	 * @return bool true if the user's credentials are non expired, false otherwise
//	 *
//	 * @see CredentialsExpiredException
//	 */
//	public function isCredentialsNonExpired() {
//		return $this->isActive();
//	}

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return bool true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled() {
        return $this->active;
    }


    public function __toString() {


        return $this->getFullName();
    }


    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize( $serialized )
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }
}
