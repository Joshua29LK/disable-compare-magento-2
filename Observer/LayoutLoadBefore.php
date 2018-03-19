<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_DisableCompare
 * @author     Extension Team
 * @copyright  Copyright (c) 2016-2017 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */

namespace Bss\DisableCompare\Observer;

use Bss\DisableCompare\Helper\Data as ModuleHelper;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class LayoutLoadBefore implements ObserverInterface
{
    /**
     * @var ModuleHelper
     */
    private $moduleHelper;

    public function __construct(ModuleHelper $moduleHelper)
    {
        $this->moduleHelper = $moduleHelper;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $disableCompare = $this->moduleHelper->isEnabled();
        if($disableCompare){
            $layout = $observer->getData('layout');
            $layout->getUpdate()->addHandle('remove_compare_products');
        }
    }
}