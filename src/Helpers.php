<?php

declare(strict_types=1);

use App\Entity\SysLog;
use App\Support\AppSysLogRegistry;

if (!function_exists('appSysLog')) {
    /**
     * Her yerden çağrılabilir SysLog yardımcısı (Laravel Helpers.php ile aynı kullanım).
     *
     * @param mixed $data string, dizi veya nesne
     */
    function appSysLog(string $type = 'info', string $title = ' ', mixed $data = '', bool $isJson = false): SysLog
    {
        return AppSysLogRegistry::get()->log($type, $title, $data, $isJson);
    }
}
