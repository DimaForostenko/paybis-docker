<?php
declare(strict_types=1);

namespace App\Providers;

use App\Dto\Rate;
use Exception;

/**
 * CoinDesk BTC rates provider in USD
 */
final class CoinRatesProvider extends RatesProvider
{
    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function transform(array $data): array
    {
        $rates = $data['rate'];

        $date = array_key_last($rates);
        $rate = (string)$rates[$date];
        $currency = 'USD';

        return [
            new Rate(
                $currency,
                $this->base,
                $rate,
                $date
            ),
        ];
    }
}