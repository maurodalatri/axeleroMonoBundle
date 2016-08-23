<?php

namespace Axelero\MonoBundle\Log;

class Logger
{
    /**
     * @var array
     */
    private $logs = [];

    /**
     * @param string $message
     * @param int    $priority
     */
    public function log($message, $priority = LOG_INFO)
    {
        $this->logs[] = ['message' => $message, 'priority' => $priority];
    }

    /**
     * @param array $request
     * @param int   $priority
     */
    public function logRequest(array $request, $priority = LOG_INFO)
    {
        $this->log(serialize($request), $priority);
    }

    /**
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }
}
