<?php
/**
 *
 */
declare(strict_types=1);

namespace FishPig\NoRouteLogger\Plugin\Magento\Cms\Controller\NoRoute;

use Magento\Cms\Controller\NoRoute\Index;
use Magento\Framework\Controller\AbstractResult;

class IndexPlugin
{
    /**
     *
     */
    public function __construct(
        \FishPig\NoRouteLogger\Model\RequestLogger $requestLogger
    ) {
        $this->requestLogger = $requestLogger;
    }
    
    /**
     *
     */
    public function afterExecute(Index $subject, AbstractResult $resultPage) : AbstractResult
    {
        if ($resultPage instanceof \Magento\Framework\View\Result\Page) {
            $this->requestLogger->log404();
        }
        
        return $resultPage;
    }
}