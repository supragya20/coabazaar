<?php

namespace Cashonad\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Cashonad\ProfileBundle\Entity\User;

/**
 *  ResettingController
 *
 * @author supragya
 */
class ResettingController extends Controller {

    public function requestAction() {
        return $this->render('CashonadProfileBundle:Resetting:request.html.twig');
    }

    public function emailAction(Request $request) {
        $email = $request->request->get('_email');

        if (null === $email) {
            return new RedirectResponse($this->get('router')->generate('request'));
        }

        $profile = $em->getRepository('CashonadProfileBundle:User')
                ->findUserByEmail();
        var_dump($profile);
        if (null === $profile) {
            return $this->render('CashonadProfileBundle:Resetting:request.html.twig', array(
                        'invalid_email' => $email
            ));
        }
    }

}
