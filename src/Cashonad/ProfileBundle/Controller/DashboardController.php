<?php
namespace Cashonad\ProfileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Cashonad\ProfileBundle\Entity\User;

/**
 * Profile Dashboard Controller
 *
 * @author supragya
 */
class DashboardController extends Controller
{
        public function indexAction() {

        $em = $this->getDoctrine()
                ->getEntityManager();

        $products = $em->getRepository('CashonadMainBundle:Product')
                ->findAll();
        // var_dump($products);
        //die;
        return $this->render('CashonadAdminBundle:Admin:index.html.twig', array(
                    'products' => $products
        ));
    }
}
