<?php

namespace App\Controller;

use App\Interfaces\iStatistics;
use App\Traits\ParseDateTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    use ParseDateTrait;

    /**
     * @var iStatistics
     */
    private $service;

    /**
     * StatisticsController constructor.
     * @param iStatistics $service
     */
    public function __construct(iStatistics $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("api/statistics/book/{bookId}/", name="statisticsByBook")
     *
     * @param Request $request
     * @param $bookId
     * @return JsonResponse
     */
    public function statisticsByBook(Request $request, $bookId): JsonResponse
    {
        if ($this->service->findBookId($bookId) === null) {
           return $this->json(['message' => "The resource does not exist"], 404, []);

        }

        $dates = $this->parseDate($request->query->get('date_from'),$request->query->get('date_to'));
        $response = $this->service->getStatisticsByBooks($dates->dateFrom, $dates->dateTo, $bookId);

        return $this->json($response, 200, []);

    }

    /**
     * @Route("api/statistics/user/{userId}", name="statisticsByUser")
     *
     * @param Request $request
     * @param $userId
     * @return JsonResponse
     */
    public function statisticsByUser(Request $request, $userId): JsonResponse
    {
        if ($this->service->findUserId($userId) === null) {
            return $this->json(['message' => "The resource does not exist"], 404, []);
        }
        $dates = $this->parseDate($request->query->get('date_from'),$request->query->get('date_to'));
        $response = $this->service->getStatisticsByUser($dates->dateFrom, $dates->dateTo, $userId);

        return $this->json($response, 200, []);

    }

}
