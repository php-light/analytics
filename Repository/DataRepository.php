<?php
/**
 * Created by iKNSA.
 * User: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 07/02/2018
 * Time: 01:05
 */


namespace PhpLight\AnalyticsBundle\Repository;


use PhpLight\AnalyticsBundle\Entity\Data;
use PhpLight\Framework\Components\DB\DB;

class DataRepository
{
    public function new(Data $data)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(
            "INSERT INTO `phplight_analytics` (
            `identifier`,
            `currentUrl`,
            `currentHash`,
            `event`,
            `user`,
            `misc`,
            `createdAt`) VALUES (
            :identifier,
            :currentUrl,
            :currentHash,
            :event,
            :user,
            :misc,
            :createdAt)"
        );

        $query->bindValue(':identifier', $data->getIdentifier());
        $query->bindValue(':currentUrl', $data->getCurrentUrl());
        $query->bindValue(':currentHash', $data->getCurrentHash());
        $query->bindValue(':event', $data->getEvent());
        $query->bindValue(':user', serialize($data->getUser()));
        $query->bindValue(':misc', serialize($data->getMisc()));
        $query->bindValue(':createdAt', $data->getCreatedAt()->format("Y-m-d H:i:s"));

        if (!$query->execute()) {
            dump($db->errorInfo());
            return false;
        }

        $data->setId($db->lastInsertId());

        return $data;
    }
}
