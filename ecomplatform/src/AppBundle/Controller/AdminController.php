<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BuyerPayment;
use AppBundle\Entity\SellerPayment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends BaseController
{
    /**
     * @Route("/", name="admin_root")
     */
    public function redirectdashboardAction(Request $request)
    {
        return $this->redirectToRoute('admin_dashboard');
    }

    /**
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('admin/dashboard.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/seller-payments", name="admin_seller_payments")
     */
    public function sellerPaymentsAction(Request $request)
    {
        $sellerId=$request->get('sellerId');
        $startDate=$request->get('start');
        $endDate=$request->get('end');

        $searchArray=array('start'=>$startDate,'end'=>$endDate,'seller'=>null);
        if ($sellerId<>-1 && !is_null($sellerId))$searchArray['seller']=$this->getRepository('Seller')->find($sellerId);


        $payments=$this->getRepository('SellerPayment')->getPayments($searchArray);
        $pagedPayments=$this->getPagination($payments,$request);

        $sellers= $this->getRepository('Seller')->findAll();

        return $this->render('admin/seller-payments.html.twig', array(
            'sellers'=>$sellers,
            'payments'=>$pagedPayments,
            'sellerId'=>$sellerId,
            'startDate' =>$startDate,
            'endDate' => $endDate
        ));
    }

    /**
     * @Route("/buyer-payments", name="admin_buyer_payments")
     */
    public function buyerPaymentsAction(Request $request)
    {
        $buyerId=$request->get('buyerId');
        $startDate=$request->get('start');
        $endDate=$request->get('end');

        $searchArray=array('start'=>$startDate,'end'=>$endDate,'buyer'=>null);
        if ($buyerId<>-1 && !is_null($buyerId))$searchArray['buyer']=$this->getRepository('Buyer')->find($buyerId);


        $payments=$this->getRepository('BuyerPayment')->getPayments($searchArray);
        $pagedPayments=$this->getPagination($payments,$request);

        return $this->render('admin/buyer-payments.html.twig', array(
            'payments'=>$pagedPayments,
            'buyerId'=>$buyerId,
            'startDate' =>$startDate,
            'endDate' => $endDate
        ));
    }

    /**
     * @Route("/transactions", name="admin_transactions")
     */
    public function viewTransactionsAction(Request $request)
    {
        $sellerId=$request->get('sellerId');
        $startDate=$request->get('start');
        $endDate=$request->get('end');

        $searchArray=array('start'=>$startDate,'end'=>$endDate,'seller'=>null);
        if ($sellerId<>-1 && !is_null($sellerId)) $searchArray['seller']=$this->getRepository('Seller')->find($sellerId);

        $transactions=$this->getRepository('Transaction')->getCompletedTransactions($searchArray);
        $pagedTransactions=$this->getPagination($transactions,$request);

        $sellers=$this->getRepository('Seller')->findAll();

        return $this->render('admin/transactions.html.twig', array(
            'transactions'=> $pagedTransactions,
            'sellers' => $sellers,
            'sellerId'=>$sellerId,
            'startDate' =>$startDate,
            'endDate' => $endDate
        ));
    }

    /**
     * @Route("/seller-pay", name="admin_seller_pay")
     */
    public function sellerPayAction(Request $request)
    {
        $sellerPayId=$request->get('sellerPayId');
        $payAmount=$request->get('amount');
        $seller=$this->getRepository('Seller')->find($sellerPayId);

        if (is_numeric($payAmount)){
            $payment= new SellerPayment();
            $payment->setSeller($seller);
            $payment->setAmount($payAmount);
            $payment->setDateTime(new \DateTime('now'));

            $em= $this->getDoctrineManager();
            $em->persist($payment);
            $em->flush();
        }

       return $this->redirectToRoute('admin_seller_payments');
    }

    /**
     * @Route("/buyer-pay", name="admin_buyer_pay")
     */
    public function buyerPayAction(Request $request)
    {
        $buyerName=$request->get('buyer');
        $payAmount=$request->get('amount');
        $member=$this->getRepository('Member')->findOneBy(array('name'=>$buyerName));

        if (!is_null($member)) {
            $buyer=$this->getRepository('Buyer')->findOneBy(array('member'=>$member));

            if (is_numeric($payAmount) && (!is_null($buyer))) {
                $payment = new BuyerPayment();
                $payment->setBuyer($buyer);
                $payment->setAmount($payAmount);
                $payment->setDateTime(new \DateTime('now'));

                $em = $this->getDoctrineManager();
                $em->persist($payment);
                $em->flush();
            }
        }

        return $this->redirectToRoute('admin_buyer_payments');
    }

    public function renderHeaderAction(){

        return $this->render('admin/shared-layout/header.html.twig', array(
        ));

    }

    public function renderPageHeaderAction($page_title=null){

        return $this->render('admin/shared-layout/page-header.html.twig', array(
            'page_title'=>$page_title
        ));

    }

}
