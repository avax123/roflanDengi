<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PaymentExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('sum_entities_field', [$this, 'sum']),
            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function formatPrice($number, int $decimals = 2, string $decPoint = '.', string $thousandsSep = ','): string
    {
        return number_format($number, $decimals, $decPoint, $thousandsSep);
    }

    public function sum(array $arrayOfEntities, string $method)
    {
        $sum = 0;

        foreach ($arrayOfEntities as $entity) {
            $value = $entity->{$method}();

            $sum += $value;
        }

        return $sum;
    }
}
