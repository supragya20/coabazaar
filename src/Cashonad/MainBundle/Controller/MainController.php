<?php

namespace Cashonad\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cashonad\MainBundle\Entity\Enquiry;
use Cashonad\MainBundle\Entity\Product;

class MainController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()
                ->getEntityManager();

        $products = $em->getRepository('CashonadMainBundle:Product')
                ->findAll();
        // var_dump($products);
        //die;
        return $this->render('CashonadMainBundle:Main:index.html.twig', array(
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
            // Fill the entity
            $product->setProductName($form['ProductName']->getData());
            $product->setProductType($form['ProductType']->getData());
            $em->persist($product);
            $em->flush();

            $msg = sprintf('Your Enquiry Has been successfully submitted.');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('add'));
        }
        //  $session->getFlashBag()->add('notice', 'Profile updated');
        return $this->render('CashonadMainBundle:Main:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editsdAction($id, Request $request) {
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
            return $this->redirect($this->generateUrl('contact'));
        }

        $build['form'] = $form->createView();
        return $this->render('CashonadMainBundle:Main:edit.html.twig', $build);
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $product = $em->getRepository('CashonadMainBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find product post.');
        }

        return $this->render('CashonadMainBundle:Main:show.html.twig', array(
                    'product' => $product,
        ));
    }

    public function editAgdction(Request $request) {
        $advertiser = $this->getProduct();

        $form = $this->createForm('advertiser_edit_profile', $advertiser);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $advertiserManager = $this->get('coa.user_manager.advertiser');
            $advertiserManager->updateUser($advertiser);

            $this->get('session')->getFlashBag()->add('success', 'Your profile updated Successfully!');

            return $this->redirect($this->generateUrl('advertiser_profile_show'));
        }

        return $this->render('COAAdvertiserBundle:Profile:edit.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function contacgtAction(Request $request) {
        $form = $this->createForm(new \Cashonad\MainBundle\Form\Type\EnquiryType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form);
            $em->flush();

            $msg = sprintf('Your Enquiry Has been successfully submitted.');
            $this->get('session')->getFlashBag()->add('success', $msg);

            return $this->redirect($this->generateUrl('contact'));
        }

        return $this->render('CashonadMainBundle:Main:contact.html.twig', array(
                    'form' => $form->createView()
        ));
    }

    public function contactAction(Request $request) {

        $em = $this->getDoctrine()->getEntityManager();
        $enquiry = new Enquiry();

        $form = $this->createFormBuilder()
                ->add('name', 'text')
                ->add('email', 'text')
                ->add('subject', 'text')
                ->add('body', 'textarea')
                ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            // Fill the entity
            $enquiry->setName($form['name']->getData());
            $enquiry->setEmail($form['email']->getData());
            $enquiry->setSubject($form['subject']->getData());
            $enquiry->setBody($form['body']->getData());
            $em->persist($enquiry);
            $em->flush();

            return $this->redirect($this->generateUrl('contact'));
        }
        return $this->render('CashonadMainBundle:Main:contact.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function addedAction(Request $request) {
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

        return $this->render('CashonadMainBundle:Main:add.html.twig', array(
                    'form' => $form->createView()
        ));
    }

}
