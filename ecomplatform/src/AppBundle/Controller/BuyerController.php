<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/myacc")
 */
class BuyerController extends BaseController
{
    /**
     * @Route("/product/{product_id}/buy-now", name="buyer_product_id_buy_now")
     * @param integer $product_id
     * @return mixed
     */
    public function buyNowAction($product_id)
    {
        $em= $this->getDoctrineManager();

        $product = $this->getRepository('Product')->find($product_id);
        $user = $this->getUser();
        $member= $user->getMember();
        $buyer= $this->getRepository('Buyer')->findOneBy(array('member'=> $member));

        $code = random_int(1000,10000);
        $transaction= new Transaction();
        $transaction->setAmount($product->getPrice());
        $transaction->setProduct($product);
        $transaction->setBuyer($buyer);
        $transaction->setCode($code);
        $transaction->setDatetime(new \DateTime('now'));
        $transaction->setStatus(1);

//        $em->persist($transaction);
//        $em->flush();

        return $this->render('product/modals/buy-now.html.twig',array('transaction'=>$transaction));
    }

    /**
     * @Route("/enter-pin-code", name="buyer_enter_pin_code")
     */
    public function enterPinCodeAction(Request $request)
    {
        $securityPin=$request->get('security_pin');
        $transactionId=$request->get('transId');

        $transaction=$this->getRepository('Transaction')->find($transactionId);
        $buyer =$transaction->getBuyer();

        if ($transaction->getStatus()==1)
            $message ='Sorry you request is not confirmed yet. Please wait.';
        elseif ($transaction->getStatus()<>2)
            $message ='Transaction Failed. Please Try Again';
        else{
            if ($buyer->getMember()->getSecurityPin() == $securityPin) {
                $transaction->setStatus(3);
                $message='Transaction completed successfully!';
            }
            else {
                $transaction->setStatus(4);
                $message='Security Pin validation failed!';
            }
            $this->getDoctrineManager()->flush();

        }

        return $this->render('product/buy-now.html.twig',array('transaction'=>$transaction, 'error'=>$message));

    }

    /**
     * @Route("/profile", name="buyer_view_profile")
     */
    public function viewProfileAction(Request $request)
    {
        $user=$this->getUser();
        $member=$user->getMember();
        $buyer=$this->getRepository('Buyer')->findOneBy(array('member'=>$member));

        return $this->render('buyer/view-profile.html.twig',array('user'=>$user,'member'=>$member, 'buyer'=>$buyer));
    }

    /**
     * @Route("/purchase-history", name="buyer_purchase_history")
     */
    public function purchaseHistoryAction(Request $request)
    {
        $user=$this->getUser();
        $member=$user->getMember();
        $buyer=$this->getRepository('Buyer')->findOneBy(array('member'=>$member));

        $startDate=$request->get('start');
        $endDate=$request->get('end');

        $searchArray=array('start'=>$startDate,'end'=>$endDate,'buyer'=>$buyer);

        $transactions= $this->getRepository('Transaction')
            ->getBuyerTransactions($searchArray);

        $pagedTransactions= $this->getPagination($transactions,$request);


        return $this->render('buyer/purchase-history.html.twig', array(
            'transactions'=> $pagedTransactions,
            'startDate' =>$startDate,
            'endDate' => $endDate
        ));
    }

    public function renderHeaderAction(){
        $user=$this->getUser();
        $member=$user->getMember();
        $buyer=$this->getRepository('Buyer')->findOneBy(array('member'=>$member));

        return $this->render('buyer/shared-layout/header.html.twig', array(
        ));

    }

    public function renderPageHeaderAction($page_title=null){

        return $this->render('buyer/shared-layout/page-header.html.twig', array(
            'page_title'=>$page_title
        ));

    }
}
