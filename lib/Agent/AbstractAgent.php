<?php

declare(strict_types=1);

namespace Vendor\Module\Agent;

/**
 * Базовый, абстрактный класс события
 */
abstract class AbstractAgent implements AgentInterface
{
    /**
     * Имя Агента
     *
     * @return string
     */
    abstract public function getName(): string;

    /**
     * Код модуля агента
     *
     * @return string
     */
    public function getModule(): string
    {
        return Config::MODULE_CODE;
    }

    /**
     * Периодичность выполнения Y|N
     *
     * @return string
     */
    public function getPeriod(): string
    {
        return 'N';
    }

    /**
     * Интервал (в секундах), с какой периодичностью запускать агента.
     *
     * @return int
     */
    public function getInterval(): int
    {
        return Time::ONE_DAY->value;
    }

    /**
     * Дата первой проверки "не пора ли запустить агент" в формате текущего языка.
     *
     * @return string
     */
    public function getDateCheck(): string
    {
        return '';
    }

    /**
     * Активность агента (Y|N).
     *
     * @return string
     */
    public function getActive(): string
    {
        return 'Y';
    }

    /**
     * Дата первого запуска агента в формате текущего языка.
     *
     * @return string
     */
    public function getNextExec(): string
    {
        return '';
    }

    /**
     * Индекс сортировки позволяющий указать порядок запуска данного агента
     * относительно других агентов для которых подошло время запуска.
     *
     * @return int
     */
    public function getSort(): int
    {
        return 100;
    }
}
