<?php

namespace Cashonad\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cashonad\MainBundle\Entity\Enquiry;
use Cashonad\MainBundle\Entity\Product;

class AdminController extends Controller {

    // public function boardAction() {
    //   $em = $this->getDoctrine()
    //           ->getEntityManager();
    //  $products = $em->getRepository('CashonadMainBundle:Product')
    //        ->findAll();
    // var_dump($products);
    //die;
    //   return $this->render('CashonadAdminBundle:Admin:index.html.twig', array(
    //            'products' => $products
    // ));
    // }

    public function chartAction() {

        return $this->render('CashonadAdminBundle:Admin:charts.html.twig'
        );
    }

    public function imageAction() {

        return $this->render('CashonadAdminBundle:Admin:image.html.twig'
        );
    }

    public function profileAction() {
        $em = $this->getDoctrine()
                ->getEntityManager();

        $profile = $em->getRepository('CashonadProfileBundle:User')
                ->findAll();

        return $this->render('CashonadAdminBundle:Admin:profile.html.twig', array(
                    'profile' => $profile
        ));
    }

}
