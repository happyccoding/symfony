<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use BearClaw\Warehousing\TotalsCalculator;


class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    public function totalsCacluatorAction(Request $request)
    {
        //$purchase_order_ids = [2344, 2345, 2346];

        $purchase_order_ids = $request->get('purchase_order_ids');
        $result = []; $data =[];
        if (isset($purchase_order_ids) && !empty($purchase_order_ids)) {
            $totalCalculator = new TotalsCalculator();
            $data = $totalCalculator->getReport($purchase_order_ids);
            $result['status']='success';
            $result['data']=$data; 
            $response=new JsonResponse($data,200);          
        } 
        else {
            $data['status']='fail';
            $data['msg']='Missing required parameter';
            $response=new JsonResponse($data,401);
        }

        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }    
}
