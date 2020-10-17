<?php

namespace App\Controller;

use App\Services\StatisticsService;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    /**
     * @var StatisticsService
     */
    private $service;

    /**
     * StatisticsController constructor.
     * @param StatisticsService $service
     */
    public function __construct(StatisticsService $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("api/statistics/book/{bookId}/", name="statistics")
     *
     * @param Request $request
     * @param $bookId
     * @return JsonResponse
     */
    public function bookStatisticsAll(Request $request, $bookId): JsonResponse
    {
        $dateFrom = Carbon::parse($request->query->get('date_from'))->toDate();
        $dateTo =   Carbon::parse($request->query->get('date_to'))->toDate();

        $response = $this->service->getAllBooksStatistics($dateFrom, $dateTo, $bookId);

        return $this->json($response, 200, []);

    }

    /**
     * @Route("api/statistics/user/{userId}", name="statistics")
     *
     * @param Request $request
     * @param $userId
     * @return JsonResponse
     */
    public function bookStatisticsByUser(Request $request, $userId): JsonResponse
    {
        $dateFrom = Carbon::parse($request->query->get('date_from'))->toDate();
        $dateTo =   Carbon::parse($request->query->get('date_to'))->toDate();

        $response = $this->service->getBooksStatisticsByUser($dateFrom, $dateTo, $userId);

        return $this->json($response, 200, []);


    }
}
