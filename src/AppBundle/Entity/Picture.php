<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Picture
 *
 * @ORM\Table(name="picture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PictureRepository")
 */
class Picture
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
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     * @ORM\JoinColumn(nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="file_extension", type="string", length=255, nullable=true)
     */
    private $fileExtension;

    /**
     * @var string
     *
     * @ORM\Column(name="original_filename", type="string", length=255, nullable=true)
     */
    private $originalFilename;


    /**
     * @var UploadedFile
     */

    private $uploadedFile;


    /**
     * @var string
     *
     * @ORM\Column(name="final_file_name", type="string", length=255)
     */
    private $finalFileName;

    /**
     * @var string
     */
    private $tempFilename;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * @return string
     */
    public function getTempFilename(): string
    {
        return $this->tempFilename;
    }

    /**
     * @param string $tempFilename
     */
    public function setTempFilename(string $tempFilename): void
    {
        $this->tempFilename = $tempFilename;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function getFinalFileName()
    {
        return $this->finalFileName;
    }

    public function setFileName($filename)
    {
        $this->finalFileName = $filename;
    }

    /**
     * @param UploadedFile $uploadedFile
     */
    public function setUploadedFile(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }


    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }





    /**
     * @param Recipe $recipe
     * @return Picture
     */
    public function setRecipe(Recipe $recipe)
    {
        $this->recipe = $recipe;
        return $this;

    }

    /**
     * @return string
     */
    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    /**
     * @param string $fileExtension
     */
    public function setFileExtension(string $fileExtension): void
    {
        $this->fileExtension = $fileExtension;
    }

    /**
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->originalFilename;
    }

    /**
     * @param string $originalFilename
     */
    public function setOriginalFilename(string $originalFilename): void
    {
        $this->originalFilename = $originalFilename;
    }




}

