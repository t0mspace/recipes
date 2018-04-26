<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupRepository")
 * @ORM\Table("`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
//
    /**
     * @var string
     * @ORM\Column(type="string", unique=true, nullable=false)
     *
     */
    private $role;


    /**
     * @var User[]|ArrayCollection;
     *
     * @ORM\OneToMany(
     *      targetEntity="AppBundle\Entity\User",
     *      orphanRemoval=true,
     *      mappedBy="group"
     * )
     *
     */
    private $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
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
     * @return User[]|ArrayCollection
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * @param User $user
     */
    public function addUser(User $user ): void
    {
        if(!$this->users->contains($user))
        {
            $this->users->add($user);
            $user->setGroup($this);
        }

    }



    /**@var string
     * @param $role
     */
    public function setRole($role){
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getRole(): string {
        return (string)$this->role;
    }
    public function __toString() {
        return $this->getRole();
    }




}
