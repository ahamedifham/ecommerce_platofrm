<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends BaseController
{
    /**
     * @Route("/", name="root")
     */
    public function redirecthomeAction(Request $request)
    {
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function homeAction(Request $request)
    {
        $filteredItems =array(
            array('category'=>'featured',
                'items'=>array(
                    array('image'=>'site/images/home/filtered-products/featured/item-1',
                        'name'=>'Organic Cosmetic',
                        'price'=>'30,0.00',
                        'rating'=>'3.75'),
                    array('image'=>'site/images/home/filtered-products/featured/item-2',
                        'name'=>'Stain Clean',
                        'price'=>'215.00',
                        'rating'=>'2.75'),
                    array('image'=>'site/images/home/filtered-products/featured/item-3',
                        'name'=>'Quality Food',
                        'price'=>'50.00',
                        'rating'=>'4.5')
                    )
                ),
            array('category'=>'daily deals',
                'items'=>array(
                    array('image'=>'site/images/home/filtered-products/deals/item-1',
                        'name'=>'Organic Cosmetic',
                        'price'=>'30,0.00',
                        'rating'=>'3.75'),
                    array('image'=>'site/images/home/filtered-products/deals/item-2',
                        'name'=>'Stain Clean',
                        'price'=>'215.00',
                        'rating'=>'2.75'),
                    array('image'=>'site/images/home/filtered-products/deals/item-3',
                        'name'=>'Quality Food',
                        'price'=>'50.00',
                        'rating'=>'4.5')
                )
            ),
            array('category'=>'recent',
                'items'=>array(
                    array('image'=>'site/images/home/filtered-products/recent/item-1',
                        'name'=>'Organic Cosmetic',
                        'price'=>'30,0.00',
                        'rating'=>'3.75'),
                    array('image'=>'site/images/home/filtered-products/recent/item-2',
                        'name'=>'Stain Clean',
                        'price'=>'215.00',
                        'rating'=>'2.75'),
                    array('image'=>'site/images/home/filtered-products/recent/item-3',
                        'name'=>'Quality Food',
                        'price'=>'50.00',
                        'rating'=>'4.5')
                )
            )
        );

        $categoryItems =array(
            array('category'=>'vehicles',
                'image'=>'site/images/home/categorized-products/vehicle',
                'name'=>'Blue Ranger',
                'price'=>'30,000.00',
                'rating'=>'3'),

            array('category'=>'real estate',
                'image'=>'site/images/home/categorized-products/real-estate',
                'name'=>'Small Garden House',
                'price'=>'150,000.00',
                'rating'=>'4.25'),

            array('category'=>'rooms & accomodation',
                'image'=>'site/images/home/categorized-products/rooms',
                'name'=>'Comfort Room',
                'price'=>'1,000.00',
                'rating'=>'5')
        );

        return $this->render('site/home.html.twig',array('filteredItems'=>$filteredItems,
            'categoryItems'=>$categoryItems));
    }

    /**
     * @Route("/vehicles", name="vehicles")
     */
    public function vehiclesAction(Request $request)
    {
        $item = array('category'=>'vehicles',
            'image'=>'site/images/home/categorized-products/vehicle',
            'name'=>'Blue Ranger',
            'price'=>'30,000.00',
            'rating'=>'3');

        return $this->render('site/vehicles.html.twig',array('item'=>$item));
    }

    //render search form
    public function renderSearchFormAction($key=null,$cat=-1){

        $em=$this->getDoctrineManager();
        $itemTypeRepo=$this->getRepository('ItemType');

        $itemTypes= $itemTypeRepo->findAll();

        return $this->render('site/header/mini-search-form.html.twig',array('key'=>$key, 'cat'=>$cat,
            'itemTypes'=>$itemTypes));

    }

    //render filtered collection item
    public function renderFilteredCollectionItemAction($collection){

        return $this->render('site/showcase-templates/filtered-item-collection.html.twig',array('collection'=>$collection));

    }

    //render category item
    public function renderCategoryItemAction($item){

        return $this->render('site/showcase-templates/category-item.html.twig',array('item'=>$item));

    }
}
