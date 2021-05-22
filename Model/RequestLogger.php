<?php
/**
 *
 */
declare(strict_types=1);

namespace FishPig\NoRouteLogger\Model;

class RequestLogger
{
    /**
     * @const string
     */
    const DATA_ITEM_SPACER = '  ';
    
    /**
     *
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->request = $request;
    }
    
    /**
     *
     */
    public function log404()
    {        
        return $this->log('404');
    }

    /**
     *
     */
    private function log($httpCode)
    {
        $logPath = BP . '/var/log';
        $logFile = 'noroute-' . (int)$httpCode . '.log';

        try {
            if (!is_dir($logPath)) {
                if (!is_writable(dirname($logPath))) {
                    throw new \Exception('Unable to create log directory at ' . $logPath); 
                }
                
                mkdir($logPath, true, 0755);
            }
            
            file_put_contents(
                $logPath . '/' . $logFile,
                $this->getCurrentRequestData() . PHP_EOL,
                FILE_APPEND
            );
        } catch (\Exception $e) {

        }
        
        return $this;
    }
    
    /**
     *
     */
    private function getCurrentRequestData()
    {
        $data = [
            date('Y/m/d H:i:s'),
            str_pad($this->request->getClientIp(), 15, ' '),
            str_pad($this->request->getMethod(), 4, ' ', STR_PAD_LEFT) . ' ' . $this->request->getRequestUri(),
        ];
        
        return implode(self::DATA_ITEM_SPACER, $data);
    }
}