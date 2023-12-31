<?php
declare(strict_types=1);

namespace App\Services;

use App\Dto\Rate as RateDto;
use App\Entity\CurrencyRate as CurrencyRate;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Exception\OutOfBoundsException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use function array_merge;
use function count;

/**
 * Rates updater
 */
class RatesUpdater
{
    public function __construct(private readonly iterable $ratesProviders, private readonly ValidatorInterface $validator, private readonly ManagerRegistry $doctrine)
    {
    }


    /**
     * Get currency rates from providers and store into rates table
     * @throws OutOfBoundsException
     */
    public function __invoke(): void
    {
        $rates = [];

        foreach ($this->ratesProviders as $ratesProvider) {
            $rates[] = ($ratesProvider)();
        }

        $rates = array_merge(...$rates);
        $this->store($rates);
    }


    /**
     * Store rates into database
     * @param RateDto[] $rates
     * @throws OutOfBoundsException
     */
    protected function store(array $rates): void
    {
        $entityManager = $this->doctrine->getManager();
        $validator = $this->validator;

        array_walk($rates, function (RateDto $rateDto) use ($entityManager, $validator): void {
            $rate = $this->makeDirectRate($rateDto, $validator);
            $entityManager->persist($rate);

      
        });

        try {
            $entityManager->flush();
        } /** @noinspection PhpRedundantCatchClauseInspection */
        catch (UniqueConstraintViolationException) { // Simplest INSERT IGNORE approach
            $this->doctrine->resetManager();
        }
    }


    /**
     * Prepare and make straight exchange rate
     * @throws OutOfBoundsException
     */
    private function makeDirectRate(RateDto $rateDto, ValidatorInterface $validator): CurrencyRate 
    {
        $rate = new CurrencyRate();
        $rate->setBase($rateDto->base);
        $rate->setDate($rateDto->date);
        $rate->setRate($rateDto->rate);
        $rate->setCurrency($rateDto->currency);

        $errors = $validator->validate($rate);
        if (count($errors) > 0) {
            throw new OutOfBoundsException((string)$errors);
        }

        return $rate;
    }


   
}