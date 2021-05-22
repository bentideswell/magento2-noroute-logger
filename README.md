# FishPig_NoRouteLogger
Logs Magento 404's to var/log/noroute-404.log

## Composer installation
    composer require fishpig/magento2-noroute-logger
    bin/magento module:enable FishPig_NoRouteLogger

If you're in production mode, you will need to recompile:

    bin/magento setup:di:compile
