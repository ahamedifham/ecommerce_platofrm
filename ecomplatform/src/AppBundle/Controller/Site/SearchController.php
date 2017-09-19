<?php

namespace AppBundle\Controller\Site;

use AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends BaseController
{
    /**
     * @Route("/search", name="search_results")
     */
    public function searchAction(Request $request)
    {
       $key = $request->get('key');
       $cat= $request->get('cat');

        $referer = $request->headers ->get('referer');

       if (is_null($key) || trim($key)=="") return $this->redirect($referer);

        return $this->render('site/search-results.html.twig',array('key'=>$key, 'cat'=>$cat));
    }

}
