<?php
/**
 * Created by iKNSA.
 * User: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 07/02/2018
 * Time: 01:05
 */


namespace PhpLight\AnalyticsBundle\Controller;


use PhpLight\Framework\Controller\Controller;
use PhpLight\Http\Request\Request;
use PhpLight\Http\Response\JsonResponse;

class DataController extends Controller
{
    public function newAction(Request $request)
    {
        $data = $request->getPost()["data"];

        return new JsonResponse([
            "data" => $data
        ]);
    }
}
