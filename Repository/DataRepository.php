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
    public function create(Data $data)
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

    public function stats()
    {
        $db = (new DB())->connect();
        $stats = [];

        $events = [];
        $query = $db->query(
            "SELECT DISTINCT `event` FROM `phplight_analytics`"
        )->fetchAll($db::FETCH_ASSOC);

        foreach ($query as $event) {
            $count = $db->query(
                "SELECT COUNT(`event`) FROM `phplight_analytics` WHERE `event`='" . $event['event'] . "'"
            )->fetch($db::FETCH_ASSOC);

            $tops = $db->query(
                "SELECT `identifier`, COUNT(*) AS `count` FROM `phplight_analytics` WHERE `event`='" . $event['event'] . "'
                        GROUP BY `identifier` ORDER BY `count` DESC LIMIT 25"
            )->fetchAll($db::FETCH_ASSOC);

            $topsWithData = $db->query(
                "SELECT `identifier`, `currentUrl`, `misc`, `user`, COUNT(*) AS `count` FROM `phplight_analytics` WHERE `event`='" . $event['event'] . "'
                        GROUP BY `identifier`, `currentUrl`, `misc`, `user` ORDER BY `count` DESC LIMIT 25"
            )->fetchAll($db::FETCH_ASSOC);

            foreach ($topsWithData as $index => $datum) {
                $topsWithData[$index]["misc"] = unserialize($datum["misc"]);
                $topsWithData[$index]["user"] = unserialize($datum["user"]);
            }

            $events[] = [
                "name" => $event["event"],
                "count" => $count["COUNT(`event`)"],
                "tops" => $tops,
                "topsWithData" => $topsWithData
            ];
        }

        $stats["events"] = $events;

        return $stats;
    }
}
