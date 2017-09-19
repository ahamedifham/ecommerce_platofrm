<?php

namespace AppBundle\Controller\Seller;

use AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/seller/item")
 */
class ItemController extends BaseController
{
    /**
     * @Route("/add", name="seller_item_add")
     */
    public function addAction(Request $request)
    {
        return $this->render('seller/items/additem.html.twig',array(

        ));
    }

    /**
     * @Route("/list", name="seller_item_list")
     */
    public function listAction(Request $request)
    {
        return $this->render('seller/items/listitems.html.twig', array(

        ));
    }

    /**
     * @Route("/details", name="seller_item_details")
     */
    public function detailsAction(Request $request)
    {
        return $this->render('seller/items/itemdetails.html.twig', array(

        ));
    }
}
