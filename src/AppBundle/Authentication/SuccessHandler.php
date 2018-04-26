<?php
/**
 * Created by PhpStorm.
 * User: t0m
 * Date: 20/04/2018
 * Time: 18:28
 */

namespace AppBundle\Authentication;

use Symfony\Component\Routing\RouterInterface,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface,
    Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**classe usefull to show the good template (recipes or users) in function of user role
 * Class SuccessHandler
 * @package AppBundle\Authentication
 */
class SuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($token->getUser()->isAdmin()) {
            return new RedirectResponse($this->router->generate('user_index'));
        }
        else {
            return new RedirectResponse($this->router->generate('recipe_index'));
        }
    }
}
