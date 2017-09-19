<?php
/**
 * Created by PhpStorm.
 * User: charith
 * Date: 17/01/19
 * Time: 11:55
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function getRepository($entity){
        return $entityRepo=$this->getDoctrine()
            ->getRepository('AppBundle:'.$entity);
    }

    public function getDoctrineManager(){
        return $this->getDoctrine()->getManager();
    }

    public function getPagination($query,$request){
        return $this->get('knp_paginator')->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
    }

    /**
     * @param $form
     * @param $template
     * @param $pageTexts
     * @return Response
     */
    protected function outputForm($form,$template,$pageTexts){
        $variablePassArr = array(
            'form' => $form->createView(),
        );
        $variablePassArr = array_merge($pageTexts,$variablePassArr);
        return $this->render($template, $variablePassArr);
    }

    /**
     * Generate form with different form options
     * @param $namespace
     * @param $object
     * @param $mode : create,edit,search
     * @param array $options
     * @return \Symfony\Component\Form\Form
     */
    protected function generateForm($namespace,$object,$mode,$options = array()){

        switch ($mode){
            case 'create':

                return $this->createForm($namespace,$object,array_merge(array('mode'=>'create','translation_domain' => 'backend','attr'=>array('id'=>'data_entry_form')),$options));
                //return $this->createForm($namespace,$object,array('mode'=>'create'));
            case 'edit':
                return $this->createForm($namespace,$object,array_merge(array('mode'=>'edit','translation_domain' => 'backend','attr'=>array('id'=>'data_entry_form')),$options));
            case 'search':
                return $this->createForm($namespace,$object,array_merge(array('mode'=>'search','translation_domain' => 'backend','method'=>'GET','attr'=>array('novalidate'=>'novalidate')),$options));

            default:
                return $this->createForm($namespace,$object,$options);
        }
    }
}