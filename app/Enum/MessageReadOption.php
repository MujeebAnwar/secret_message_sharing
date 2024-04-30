<?php
namespace App\Enum;

enum MessageReadOption : int{
    case ONCE  = 1; // For None
    case CUSTOM = 2; // For Fixed
    

    
    public function label(): string
    {
        return match ($this) {
            static::ONCE => __('Read Once, Then Delete'),
            static::CUSTOM => __('Delete After X Period'),
        };
    }


}