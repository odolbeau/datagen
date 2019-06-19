<?php

declare(strict_types=1);

namespace Shapin\Datagen\Stripe;

use Shapin\Datagen\FixtureInterface;
use Shapin\Datagen\ProcessorInterface;
use Shapin\Datagen\ReferenceManager;
use Shapin\Datagen\Stripe\Exception\UnknownObjectException;
use Shapin\Stripe\Api\HttpApi;
use Shapin\Stripe\Exception\Domain\ResourceAlreadyExistsException;
use Shapin\Stripe\StripeClient;

class Processor implements ProcessorInterface
{
    private $stripeClient;
    private $referenceManager;

    public function __construct(StripeClient $stripeClient, ReferenceManager $referenceManager)
    {
        $this->stripeClient = $stripeClient;
        $this->referenceManager = $referenceManager;
    }

    /**
     * {@inheritdoc}
     */
    public function process(FixtureInterface $fixture, array $options = []): void
    {
        $api = $this->getApi($fixture);

        foreach ($fixture->getObjects() as $key => $object) {
            $object = $this->referenceManager->findAndReplace($object);

            try {
                $object = $api->create($object);
            } catch (ResourceAlreadyExistsException $e) {
                // Doing nothing for now
            }

            if (is_string($key)) {
                $this->referenceManager->add($fixture->getObjectName(), $key, $object);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function flush(array $options = []): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'stripe';
    }

    private function getApi(FixtureInterface $fixture): HttpApi
    {
        switch ($fixture->getObjectName()) {
            case 'coupon':
                return $this->stripeClient->coupons();
            case 'plan':
                return $this->stripeClient->plans();
            case 'product':
                return $this->stripeClient->products();

            default:
                throw new UnknownObjectException($fixture->getObjectName());
        }
    }
}
