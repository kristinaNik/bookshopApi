<?php


namespace App\Interfaces;


interface iStatistics
{
    public function findBookId($bookId);

    public function findUserId($userId);

    public function getStatisticsByBooks(\DateTime $dateFrom, \DateTime $dateTo, $bookId): array;

    public function getStatisticsByUser(\DateTime $dateFrom, \DateTime $dateTo, $userId): array;

}