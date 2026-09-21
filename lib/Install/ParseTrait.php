<?php

declare(strict_types=1);

namespace Vendor\Module\Install;

trait ParseTrait
{
    /**
     * Узнаем имя класса
     *
     * @param array $tokens
     *
     * @return string
     */
    private function parseTokens(array $tokens): string
    {
        $classStart = false;

        foreach ($tokens as $token) {
            if ($token[0] === T_CLASS) {
                $classStart = true;
            }
            if ($classStart && $token[0] === T_STRING) {
                return $token[1];
            }
        }

        return '';
    }

    /**
     * Узнаем Namespace
     *
     * @param array $tokenList
     *
     * @return string
     */
    private function parseNamespace(array $tokenList): string
    {
        foreach ($tokenList as $token) {
            if ($token[0] === T_NAME_QUALIFIED) {
                return $token[1];
            }
        }

        return '';
    }
}
