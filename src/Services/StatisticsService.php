<?php


namespace App\Services;


use App\Entity\Book;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class StatisticsService
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
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $bookId
     * @return array
     */
    public function getAllBooksStatistics(\DateTime $dateFrom, \DateTime $dateTo, $bookId): array
    {

        $reviewRepo = $this->em->getRepository(Review::class);
        $bookRepo = $this->em->getRepository(Book::class)->find($bookId);
        $bookTitle = $this->em->getRepository(Book::class)->findTitleById($bookId);

        return [
           'book' => [
                'id' => $bookId,
                'title' => $bookTitle,
                'average_rating' => $reviewRepo->findAverageBookRating($bookRepo, $dateFrom, $dateTo)
            ]
        ];

    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $userId
     * @return array
     */
    public function getBooksStatisticsByUser(\DateTime $dateFrom, \DateTime $dateTo, $userId): array
    {
        $userRepo = $this->em->getRepository(User::class)->find($userId);
        $reviewRepo = $this->em->getRepository(Review::class);
        $userEmail = $this->em->getRepository(User::class)->findEmailById($userId);

        return [
            'user' => [
                'id' => $userId,
                'email' => $userEmail,
                'rated_books' => $reviewRepo->findBookRatingByUser($userRepo, $dateFrom, $dateTo)

            ]
        ];

    }


}