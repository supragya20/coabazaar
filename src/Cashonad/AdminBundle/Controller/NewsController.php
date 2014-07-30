<?php

namespace Cashonad\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cashonad\MainBundle\Entity\Product;

class NewsController extends Controller {

    public function NewsAction() {
        $em = $this->getDoctrine()
                ->getEntityManager();
        $products = $em->getRepository('CashonadMainBundle:Product')
                ->findAll();


        return $this->render('CashonadAdminBundle:Admin:list.html.twig', array(
                    'products' => $products
        ));
    }

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $product = new Product();

        $form = $this->createFormBuilder()
                ->add('ProductName', 'text')
                ->add('ProductType', 'textarea')
                ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {

            $product->setProductName($form['ProductName']->getData());
            $product->setProductType($form['ProductType']->getData());
            $em->persist($product);
            $em->flush();

            $msg = sprintf('News Added Successfully.');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('news'));
        }

        return $this->render('CashonadAdminBundle:Admin:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    function addQWAction(Request $request) {
        $product = new Product();
        $form = $this->createForm('adding_product', $product);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();

            $msg = sprintf('News added Successfully.');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('contact'));
        }

        return $this->render('CashonadAdminBundle:Admin:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    function editAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('CashonadMainBundle:Product')->find($id);

        if (!$products) {
            throw $this->createNotFoundException(
                    'No product found for id ' . $id
            );
        }
        $form = $this->createFormBuilder($products)
                ->add('ProductName', 'text')
                ->add('ProductType', 'textarea')
                ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('news'));
        }

        $build['form'] = $form->createView();
        return $this->render('CashonadMainBundle:Main:edit.html.twig', $build);
    }

    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $products = $em->getRepository('CashonadMainBundle:Product')->find($id);

        if (!$products) {
            throw $this->createNotFoundException('No guest found for id ' . $id);
        }
        $em->remove($products);
        $em->flush();


        $msg = sprintf('News Deleted Successfully.');
        $this->get('session')->getFlashBag()->add('success', $msg);

        return $this->redirect($this->generateUrl('news'));
    }

}
