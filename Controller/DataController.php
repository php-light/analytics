<?php
/**
 * Created by iKNSA.
 * User: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 07/02/2018
 * Time: 01:05
 */


namespace PhpLight\AnalyticsBundle\Controller;


use PhpLight\AnalyticsBundle\Entity\Data;
use PhpLight\AnalyticsBundle\Repository\DataRepository;
use PhpLight\Framework\Components\Config;
use PhpLight\Framework\Controller\Controller;
use PhpLight\Http\Request\Request;
use PhpLight\Http\Response\JsonResponse;

class DataController extends Controller
{
    public function newAction(Request $request)
    {
        $data = $request->getPost()["data"];

        if ($request->getUser()) {
            $userRepository = (new Config())->getConfig()["user_repository"];
            $data["user"] = (new $userRepository())->findByUid($request->getUser()->getUid())->getPublicData();
        }

        $data = new Data($data);

        return new JsonResponse([
            "data" => (new DataRepository())->create($data)->toArray()
        ]);
    }

    public function statsAction(Request $request)
    {
        if (!$request->isUserRoleAdmin()) {
            return new JsonResponse([
                "message" => "You cannot access this section"
            ]);
        }

        return new JsonResponse([
            "success" => true,
            "stats" => (new DataRepository())->stats()
        ]);
    }
}
