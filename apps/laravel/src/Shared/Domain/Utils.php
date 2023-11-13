<?php

declare(strict_types=1);

namespace Modules\Shared\Domain;

use DateTimeImmutable;
use DateTimeInterface;
use ReflectionClass;
use RuntimeException;

use function Lambdish\Phunctional\filter;

final class Utils
{

    public static function toCamelCase(string $text): string
    {
        return lcfirst(str_replace('_', '', ucwords($text, '_')));
    }

    public static function dot(array $array, string $prepend = ''): array
    {
        $results = [];
        foreach ($array as $key => $value) {
            if (is_array($value) && ! empty($value)) {
                $results = array_merge($results, self::dot($value, $prepend.$key.'.'));
            } else {
                $results[$prepend.$key] = $value;
            }
        }

        return $results;
    }

}
