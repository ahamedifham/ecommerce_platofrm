<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/product")
 */
class ProductController extends BaseController
{
    /**
     * @Route("/details", name="product_details")
     */
    public function detailsAction(Request $request)
    {
        return $this->render('product/detail.html.twig',array());
    }

    /**
     * @Route("/{product_id}/details", name="product_id_details")
     * @param $product_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productDetailsAction($product_id)
    {
        $product=$this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($product_id);

        return $this->render('product/detail.html.twig',array('product'=>$product));
    }
}
