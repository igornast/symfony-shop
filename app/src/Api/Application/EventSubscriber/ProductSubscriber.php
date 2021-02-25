<?php
declare(strict_types=1);

namespace App\Api\Application\EventSubscriber;


use App\Api\Domain\Product\Event\ProductCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ProductSubscriber implements EventSubscriberInterface
{
    /**
     * @var MailerInterface
     */
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            ProductCreatedEvent::class => 'onProductCreated',
        ];
    }

    public function onProductCreated(ProductCreatedEvent $event): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html(sprintf('<p>New product "%s" added!</p>', $event->getName()));

        $this->mailer->send($email);
    }
}