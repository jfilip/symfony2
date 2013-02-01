<?php

namespace Demo\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller {
    public function loginAction() {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        $params = array(
            // last username entered by the user
            'title'         => 'Login',
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        );

        return $this->render('DemoSecurityBundle:Security:login.html.twig', $params);
    }
}
