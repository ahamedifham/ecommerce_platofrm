<?php
/**
 * Created by PhpStorm.
 * User: charith
 * Date: 17/01/19
 * Time: 11:55
 */

namespace AppBundle\Controller;


use AppBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        //redirect if already logged in
        $user = $this->getUser();
        if (!is_null($user)) {
            $role = $user->getRole()->getMetaCode();

            if ($role == 'ROLE_SELLER') return $this->redirectToRoute('seller_dashboard');
            elseif ($role == 'ROLE_ADMIN') return $this->redirectToRoute('admin_dashboard');
            elseif ($role == 'ROLE_BUYER') return $this->redirectToRoute('homepage');

        }

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }

    /**
     * @Route("/login/redirect", name="login_redirect")
     */
    public function loginRedirectAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_null($user)) {
            $role = $user->getRole()->getMetaCode();

            if ($role == 'ROLE_SELLER') return $this->redirectToRoute('seller_dashboard');
            elseif ($role == 'ROLE_ADMIN') return $this->redirectToRoute('admin_dashboard');

        }

        return $this->redirectToRoute('homepage');
    }
}