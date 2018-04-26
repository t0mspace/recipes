<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Picture;
use AppBundle\Entity\Recipe;
use AppBundle\Form\RecipeType;
use AppBundle\Utils\Slugger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vich\UploaderBundle\Handler\UploadHandler;


/**
 * Recipe controller.
 *
 * @Route("recipe")
 */
class RecipeController extends Controller
{


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAll()
    {
        $em = $this->getDoctrine()->getManager();

        $allRecipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('recipe/show_all.html.twig', array(
            'recipes' => $allRecipes
        ));
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('recipe/index.html.twig', array(
            'recipes' => $recipes
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $recipe = new Recipe();
        $em = $this->getDoctrine()->getManager();
//        $user = $this->get('security.token_storage')->getToken()->getUser();
//        $recipe->setAuthor($user);
        $form = $this->createForm('AppBundle\Form\RecipeType', $recipe);
        dump($request);
        $form->handleRequest($request);
        dump($recipe);
        if ($form->isSubmitted() && $form->isValid()) {


            $recipe->setSlug(Slugger::slugify($recipe->getName()));



            $em->persist($recipe);
            $em->flush();

//            $session = new Session();
//            $session->start();
//
//            $session->getFlashBag()->add('notice', 'Nouvelle recette sauvegardée');


            //return $this->redirectToRoute('recipe_show', array('id' => $recipe->getId()));
        }

        return $this->render('recipe/new.html.twig', array(
            'recipe' => $recipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Recipe $recipe
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Recipe $recipe)
    {
        $deleteForm = $this->createDeleteForm($recipe);

        return $this->render('recipe/show.html.twig', array(
            'recipe' => $recipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $request)
    {
        $em= $this->getDoctrine()->getManager();

        $recipe= $em->getRepository('AppBundle:Recipe')->find($id);

        if(null === $recipe)
        {
            throw new NotFoundHttpException("l'annonce n'existe pas");
        }

        dump($recipe);

        $form = $this->get('form.factory')->create(RecipeType::class, $recipe);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('recipe_index', array('id' => $recipe->getId()));
        }

        return $this->render('recipe/edit.html.twig', array(
            'recipe' => $recipe,
            'edit_form' => $form->createView()
        ));
    }


    public function deleteAction($id, Request $request)
    {
        $em= $this->getDoctrine()->getManager();

        $recipe= $em->getRepository('AppBundle:Recipe')->find($id);

        if(null === $recipe)
        {
            throw new NotFoundHttpException("la recette n'existe pas");
        }

        //@todo add empty form
        $em->remove($recipe);
        $em->flush();
//        $form = $this->get('form.factory')->create();
//
//
//        if ($request->isMethod('GET') && $form->handleRequest($request)->isValid()) {
//
//        }




        return $this->redirectToRoute('recipe_index');
    }

    /**
     * @param Recipe $recipe
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Recipe $recipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recipe_delete', array('id' => $recipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

//    public function uploadImageAction(Picture $image, UploadHandler $uploadHandler)
//    {
//
//        return $uploadHandler->upload($image, $fileField = 'imageFile');
//    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
