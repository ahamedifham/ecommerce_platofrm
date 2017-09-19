<?php

namespace AppBundle\Controller\Seller;

use AppBundle\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


/**
 * @Route("/seller")
 */
class SellerController extends BaseController
{
    /**
     * @Route("/", name="seller_root")
     */
    public function redirectdashboardAction(Request $request)
    {
        return $this->redirectToRoute('seller_dashboard');
    }

    /**
     * @Route("/dashboard", name="seller_dashboard")
     */
    public function sellerAction(Request $request)
    {

        return $this->render('seller/dashboard.html.twig', array(

        ));
    }

    /**
     * @Route("/scan-buyer-code", name="seller_scan_buyer_code")
     */
    public function scanBuyerCodeAction(Request $request)
    {
        //The following part is written by Ifham to fetch the keycode and transid from a form
        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
            ->add('keycode', TextType::class,array('label'=>'Enter Key code'))
          //  ->add('transId', TextType::class, array('label'=>'Enter Transaction Id'))
            ->add('send', SubmitType::class, array('label'=>'Proceed'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $keycode=$data['keycode'];
            //$transId=$data['transId'];

            $em=$this->getDoctrineManager();

            $user=$this->getUser();
            $member= $user->getMember();
            $seller=$this->getRepository('Seller')->findOneBy(array('member'=>$member));

            $transaction=$this->getRepository('Transaction')
                ->findOneBy(array('seller'=>$seller, 'code'=>$keycode));

            if (!is_null($transaction)){
                $transaction->setStatus(2);

                $em->persist($transaction);
                $em->flush();
            }
            //Temporarily this is being redirected to seller transactions
            return $this->redirectToRoute('seller_transactions');
        }

        return $this->render('seller/enterCode.html.twig', array(
            'form' => $form->createView(),
        ));

//        $keycode=$request->get('keycode');
//        $transId=$request->get('transId');
//
//        $em=$this->getDoctrineManager();
//
//        $user=$this->getUser();
//        $member= $user->getMember();
//        $seller=$this->getRepository('Seller')->findOneBy(array('member'=>$member));
//
//        $transaction=$this->getRepository('Transaction')
//            ->findOneBy(array('seller'=>$seller, 'code'=>$keycode, 'id'=>$transId));
//
//        if (!is_null($transaction)){
//            $transaction->setStatus(2);
//
//            $em->persist($transaction);
//            $em->flush();
//        }
//
//        $referer = $request->headers ->get('referer');
//        return $this->redirect($referer);
    }

    /**
     * @Route("/transactions", name="seller_transactions")
     */
    public function transactionListAction(Request $request)
    {
        $user=$this->getUser();
        $member=$user->getMember();
        $seller=$this->getRepository('Seller')->findOneBy(array('member'=>$member));

        $startDate=$request->get('start');
        $endDate=$request->get('end');

        $searchArray=array('start'=>$startDate,'end'=>$endDate,'seller'=>$seller);
        $transactions=$this->getRepository('Transaction')->getCompletedTransactions($searchArray);

        $pagedTransactions=$this->getPagination($transactions,$request);

        return $this->render('seller/transactions.html.twig', array(
            'transactionlist'=> $pagedTransactions,
            'startDate' =>$startDate,
            'endDate' => $endDate
        ));
    }

    public function renderHeaderAction(){
        $user=$this->getUser();
        $member=$user->getMember();
        $seller=$this->getRepository('Seller')->findOneBy(array('member'=>$member));

        $transactions=$this->getRepository('Transaction')->getUnconfirmedTransactions($seller);

        return $this->render('seller/shared-layout/header.html.twig', array(
            'transactions'=>$transactions));

    }

    public function renderPageHeaderAction($page_title=null){

        return $this->render('seller/shared-layout/page-header.html.twig', array(
            'page_title'=>$page_title
        ));

    }
}
