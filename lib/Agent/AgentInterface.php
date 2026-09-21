<?php

declare(strict_types=1);

namespace Vendor\Module\Agent;

/**
 * Интерфейс события модуля
 */
interface AgentInterface
{
    /**
     * Имя Агента
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Код модуля агента
     *
     * @return string
     */
    public function getModule(): string;

    /**
     * Периодичность выполнения Y/N
     *
     * @return string
     */
    public function getPeriod(): string;

    /**
     * Интервал (в секундах), с какой периодичностью запускать агента.
     *
     * @return int
     */
    public function getInterval(): int;

    /**
     * Дата первой проверки "не пора ли запустить агент" в формате текущего языка.
     *
     * @return string
     */
    public function getDateCheck(): string;

    /**
     * Активность агента (Y|N).
     *
     * @return string
     */
    public function getActive(): string;

    /**
     * Дата первого запуска агента в формате текущего языка.
     *
     * @return string
     */
    public function getNextExec(): string;

    /**
     * Индекс сортировки позволяющий указать порядок запуска данного агента
     * относительно других агентов для которых подошло время запуска.
     *
     * @return int
     */
    public function getSort(): int;
}
