<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File as UploadedFile;
use Symfony\Component\Validator\Constraints\File;

/**
 * Recipe
 *
 * @ORM\Table(name="recipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecipeRepository")
 */
class Recipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=250)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=250)
     */
    private $slug;




    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     *
     */
    private $author;


    /**
     * @var int
     *
     * @ORM\Column(name="difficulty_level", type="integer")
     */
    private $difficultyLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="peparation_time", type="string", length=250)
     */
    private $peparationTime;

    /**
     * @var string
     *
     * @ORM\Column(name="cooking_time", type="string", length=50)
     */
    private $cookingTime;

    /**
     * @var int
     *
     * @ORM\Column(name="cost", type="integer", nullable=true)
     */
    private $cost;

    /**
     * @var int
     *
     * @ORM\Column(name="for_nbre_people", type="integer")
     */
    private $forNbrePeople;



    /**
     * @var KindDish
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\KindDish", inversedBy="recipes", cascade={"persist"})
     * @ORM\JoinColumn(name="kind_dish_id", referencedColumnName="id")
     */
    private $kind_dish;


    /**
     *
     * @var Picture
     * @ORM\OneToOne(
     *      targetEntity="AppBundle\Entity\Picture",
     *      cascade={"persist", "remove"}
     * )
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="how_make", type="text")
     */
    private $howMake;


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
     * Set name
     *
     * @param string $name
     *
     * @return Recipe
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author=null): void
    {
        $this->author = $author;
    }


    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set difficultyLevel
     *
     * @param integer $difficultyLevel
     *
     * @return Recipe
     */
    public function setDifficultyLevel($difficultyLevel)
    {
        $this->difficultyLevel = $difficultyLevel;

        return $this;
    }

    /**
     * Get difficultyLevel
     *
     * @return int
     */
    public function getDifficultyLevel()
    {
        return $this->difficultyLevel;
    }

    /**
     * Set peparationTime
     *
     * @param string $peparationTime
     *
     * @return Recipe
     */
    public function setPeparationTime($peparationTime)
    {
        $this->peparationTime = $peparationTime;

        return $this;
    }

    /**
     * Get peparationTime
     *
     * @return string
     */
    public function getPeparationTime()
    {
        return $this->peparationTime;
    }

    /**
     * Set cookingTime
     *
     * @param string $cookingTime
     *
     * @return Recipe
     */
    public function setCookingTime($cookingTime)
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    /**
     * Get cookingTime
     *
     * @return string
     */
    public function getCookingTime()
    {
        return $this->cookingTime;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return Recipe
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    public function __construct()
    {

    }


    /**
     * Set forNbrePeople
     *
     * @param integer $forNbrePeople
     *
     * @return Recipe
     */
    public function setForNbrePeople($forNbrePeople)
    {
        $this->forNbrePeople = $forNbrePeople;

        return $this;
    }

    /**
     * Get forNbrePeople
     *
     * @return int
     */
    public function getForNbrePeople()
    {
        return $this->forNbrePeople;
    }

    /**
     * @return Picture
     */
    public function getPicture(): ?Picture
    {
        return $this->picture;
    }


    /**
     * @param null $picture
     */
    public function setPicture($picture= null)
    {
        $this->picture = $picture;
    }






    /**
     * Set howMake
     *
     * @param string $howMake
     *
     * @return Recipe
     */
    public function setHowMake($howMake)
    {
        $this->howMake = $howMake;

        return $this;
    }

    /**
     * @param KindDish $kindDish
     */
    public function setKindDish(KindDish $kindDish)
    {
        $this->kind_dish = $kindDish;
    }

    public function getKindDish()
    {
        return $this->kind_dish;
    }



    /**
     * Get howMake
     *
     * @return string
     */
    public function getHowMake()
    {
        return $this->howMake;
    }


}

