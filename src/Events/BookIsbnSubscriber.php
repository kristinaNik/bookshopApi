<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Book;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Validator\Constraints\Regex;

class BookIsbnSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['addIsbn', EventPriorities::PRE_WRITE]
        ];
    }

    /**
     * @param ViewEvent $event
     */
    public function addIsbn(ViewEvent $event): void
    {
        $book = $event->getControllerResult();
        if ($book instanceof Book) {
            $isbn = substr(str_shuffle("01234567891011"), 0, 13);
            $book->setIsbn($isbn);
        }

    }

}