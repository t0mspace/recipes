<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 20/04/2018
 * Time: 21:59
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllAction()
    {
        $em = $this->getDoctrine()->getManager();

        $allRecipes = $em->getRepository('AppBundle:Recipe')->findAll();

        return $this->render('recipe/show_all.html.twig', array(
            'recipes' => $allRecipes
        ));
    }
}