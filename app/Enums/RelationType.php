<?php

namespace App\Enums;

enum RelationType: string
{
    case FATHER = 'Father';
    case MOTHER = 'Mother';
    case SISTER = 'Sister';
    case BROTHER = 'Brother';

    public static function getValues(): array
    {
        return array_column(RelationType::cases(), 'value');
    }
}
