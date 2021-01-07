<?php
namespace App\Services;

use App\Entity\Book;
use App\Entity\Review;
use App\Entity\User;
use App\Interfaces\iStatistics;
use Doctrine\ORM\EntityManagerInterface;

class StatisticsService implements iStatistics
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ReviewService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }


    /**
     * @param $bookId
     * @return object|null
     */
    public function findBookId($bookId)
    {
        return $this->em->getRepository(Book::class)->find($bookId);
    }

    /**
     * @param $userId
     * @return object|null
     */
    public function findUserId($userId)
    {
        return  $userRepo = $this->em->getRepository(User::class)->find($userId);
    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $bookId
     * @return array
     */
    public function getStatisticsByBooks(\DateTime $dateFrom, \DateTime $dateTo, $bookId): array
    {

        $reviewRepo = $this->em->getRepository(Review::class);
        $bookRepo = $this->em->getRepository(Book::class)->find($bookId);
        $bookTitle = $this->em->getRepository(Book::class)->findTitleById($bookId);

        return [
           'book' => [
                'id' => $bookId,
                'title' => $bookTitle,
                'average_rating' => $reviewRepo->findAverageBookRating($bookRepo, $dateFrom, $dateTo) ?? 'No rating available'
            ]
        ];

    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $userId
     * @return array
     */
    public function getStatisticsByUser(\DateTime $dateFrom, \DateTime $dateTo, $userId): array
    {
        $userRepo = $this->em->getRepository(User::class)->find($userId);
        $reviewRepo = $this->em->getRepository(Review::class);
        $userEmail = $this->em->getRepository(User::class)->findEmailById($userId);

        return [
            'user' => [
                'id' => $userId,
                'email' => $userEmail,
                'rated_books' => $reviewRepo->findBookRatingByUser($userRepo, $dateFrom, $dateTo),
                'count_rated_book'=> $reviewRepo->countRatedBookByUser($userRepo, $dateFrom, $dateTo),
                'average_rating'  => $reviewRepo->averageRatingByUser($userRepo, $dateFrom, $dateTo) ?? 'No available ratings'

            ]
        ];

    }


}