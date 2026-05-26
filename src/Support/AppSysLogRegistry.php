<?php

declare(strict_types=1);

namespace App\Support;

use App\Service\AppSysLogService;

/**
 * Global appSysLog() fonksiyonunun Symfony servisine erişimi.
 */
final class AppSysLogRegistry
{
    private static ?AppSysLogService $service = null;

    public static function set(AppSysLogService $service): void
    {
        self::$service = $service;
    }

    public static function get(): AppSysLogService
    {
        if (null === self::$service) {
            throw new \RuntimeException(
                'AppSysLogService hazır değil. appSysLog() yalnızca HTTP isteği veya console komutu çalışırken kullanılabilir.'
            );
        }

        return self::$service;
    }
}
