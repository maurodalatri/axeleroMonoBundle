<?php

namespace Axelero\MonoBundle\DataCollector;

use Axelero\MonoBundle\Log\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class MonoDataCollector extends DataCollector
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @param Logger $logger
     * @param string $username
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->data['logs'] = [];
        $this->data['logCount'] = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data['logs'] = $this->logger->getLogs();
        $this->data['logCount'] = count($this->data['logs']);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'mono';
    }

    /**
     * Get the log entries.
     *
     * @return array
     */
    public function getLogs()
    {
        return array_map(function ($log) {
            if (isset($log['message'])) {
                return unserialize($log['message']);
            }

            return $log;
        }, $this->data['logs']);
    }

    /**
     * How many log entries became logged.
     *
     * @return int
     */
    public function countLogs()
    {
        return $this->data['logCount'];
    }
}
