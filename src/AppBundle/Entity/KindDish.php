<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * KindDish
 *
 * @ORM\Table(name="kind_dish")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KindDishRepository")
 */
class KindDish
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    /**
     * @var Recipe[]|ArrayCollection;
     *
     * @ORM\OneToMany(
     *      targetEntity="AppBundle\Entity\Recipe",
     *      orphanRemoval=true,
     *      mappedBy="kind_dish"
     * )
     *
     */
    private $recipes;

    /**
     * KindDish constructor.
     *
     * @param Recipe[]|ArrayCollection $recipes
     */
    public function __construct()
    {

        $this->recipes = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return KindDish
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

    /**
     * @param Recipe $recipe
     */
    public function addRecipe(Recipe $recipe)
    {
        $recipe->setKindDish($this);
        if(!$this->recipes->contains($recipe))
        {
            $this->recipes->add($recipe);
        }
    }

    /**
     * @param Recipe $recipe
     */
    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }


}

