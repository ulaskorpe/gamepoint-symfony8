<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\SysLog;
use Doctrine\ORM\EntityManagerInterface;

/**
 * SysLog kayıtlarını Doctrine üzerinden yazar.
 */
final class AppSysLogService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param mixed $data string, dizi veya nesne
     */
    public function log(string $type = 'info', string $title = ' ', mixed $data = '', bool $isJson = false): SysLog
    {
        $now = new \DateTimeImmutable();

        $sysLog = new SysLog();
        $sysLog->setType($type);
        $sysLog->setTitle($title);
        $sysLog->setData($this->normalizeData($data, $isJson));
        $sysLog->setCreatedAt($now);
        $sysLog->setUpdatedAt($now);

        $this->entityManager->persist($sysLog);
        $this->entityManager->flush();

        return $sysLog;
    }

    /**
     * Doctrine SIMPLE_ARRAY alanı için veriyi dizi biçimine çevirir.
     */
    private function normalizeData(mixed $data, bool $isJson): array
    {
        if ($isJson) {
            if (is_string($data)) {
                return ['json' => $data];
            }

            return [
                'json' => json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            ];
        }

        if (is_array($data)) {
            return $data;
        }

        if ($data === '' || $data === null) {
            return [];
        }

        return ['value' => (string) $data];
    }
}
