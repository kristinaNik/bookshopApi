<?php


namespace App\Interfaces;


interface iStatistics
{

    public function getAllBooksStatistics(\DateTime $dateFrom, \DateTime $dateTo, $bookId): array;

    public function getBooksStatisticsByUser(\DateTime $dateFrom, \DateTime $dateTo, $userId): array;

}