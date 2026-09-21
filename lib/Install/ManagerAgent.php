<?php

declare(strict_types=1);

namespace Vendor\Module\Install;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\SystemException;
use CAgent;
use Vendor\Module\Agent\AgentInterface;

/**
 * Менеджер агентов в модуле при установке
 *
 */
class ManagerAgent
{
    use ParseTrait;

    /** @var array Игнорируемые имена файлов в lib/agent */
    private const IGNORE_FILE_NAME = [
        'AbstractAgent.php',
        'AgentInterface.php',
        '.DS_Store',
    ];

    /**
     * Регистрация агентов модуля
     */
    public function registerAgents(): void
    {
        foreach ($this->getAgentList() as $agent) {
            CAgent::AddAgent(
                $agent->getName(),
                $agent->getModule(),
                $agent->getPeriod(),
                $agent->getInterval(),
                $agent->getDateCheck(),
                $agent->getActive(),
                $agent->getNextExec(),
                $agent->getSort(),
                $agent->getUserId()
            );
        }
    }

    /**
     * Удаляем все агенты модуля
     */
    public function unRegisterAgents(): void
    {
        CAgent::RemoveModuleAgents(Config::MODULE_CODE);
    }

    /**
     * Получаем список агентов модуля
     *
     * @return AgentInterface[]
     *
     * @throws SystemException
     * @throws \Bitrix\Main\IO\FileNotFoundException
     */
    private function getAgentList(): array
    {
        $result = [];

        $dir = new Directory(__DIR__ . '/../Agent/');
        $arDir = $dir->getChildren();

        foreach ($arDir as $dirItem) {
            if ($dirItem->isFile() && !in_array($dirItem->getName(), self::IGNORE_FILE_NAME)) {
                $eventInterface = 'Vendor\\Module\\Agent\\AgentInterface';
                $className = $this->parseTokens(token_get_all(file_get_contents($dirItem->getPhysicalPath())));
                $agentClass = 'Vendor\\Module\\Agent\\' . $className;
                $eventOb = new $agentClass();

                if (!$eventOb instanceof AgentInterface) {
                    throw new SystemException(
                        $agentClass . ' агент должен реализовывать интерфейс ' . $eventInterface
                    );
                }

                $result[] = $eventOb;
            }
        }

        return $result;
    }
}
