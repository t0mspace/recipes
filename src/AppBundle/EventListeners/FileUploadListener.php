<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 15/04/2018
 * Time: 00:16
 */

namespace AppBundle\EventListeners;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Recipe;
use AppBundle\Entity\Picture;
use AppBundle\Services\PictureUpload;

class FileUploadListener
{
    private $uploader;

    public function __construct(PictureUpload $uploader)
    {
        $this->uploader = $uploader;
    }

//    /**
//     * @param PreUpdateEventArgs $args
//     */
//    public function preUpdate(PreUpdateEventArgs $args)
//    {
//        $entity = $args->getEntity();
//
//        $this->uploadFile($entity);
//    }


    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }


    private function uploadFile($entity)
    {

        if (!$entity instanceof Picture) {
            return;
        }

        $file = $entity->getUploadedFile();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setFileName($fileName);
    }



//    public function postLoad(LifecycleEventArgs $args)
//    {
//        $entity = $args->getEntity();
//
//        if (!$entity instanceof Recipe) {
//            return;
//        }
//
//        if ($fileName = $entity->getPicture()) {
//            $entity->setPicture(new File($this->uploader->getTargetDir().'/'.$fileName));
//        }
//    }


}