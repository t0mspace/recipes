<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 09/04/2018
 * Time: 17:40
 */

namespace AppBundle\Controller;



use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    public function loginAction(Request $request, AuthenticationUtils $helper):Response
    {

        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('recipe_index');
        }
        // get the login error if there is one
        $error = $helper->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $helper->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));


    }


    public function loginCheckAction()
    {

        throw new \Exception('This should never be reached!');
    }


    public function logoutAction(): void
    {
        throw new \Exception('This should never be reached!');
    }

}