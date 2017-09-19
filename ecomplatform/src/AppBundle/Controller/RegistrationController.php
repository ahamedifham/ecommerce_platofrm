<?php
/**
 * Created by PhpStorm.
 * User: ifham
 * Date: 2/14/17
 * Time: 10:15 AM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Buyer;
use AppBundle\Form\Type\BuyerType as BuyerForm;


/**
 * @Route("/register")
 */
class RegistrationController extends BaseController
{
    /**
     * @Route("/buyer", name="register_buyer")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function buyerRegisterAction(Request $request){
        $object = new Buyer();
        $form = $this->generateForm(BuyerForm::class,$object,'create');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($object);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->outputForm($form,'register/buyerRegistration.html.twig',array('page_title'=>'Buyer Registration'));
    }
}