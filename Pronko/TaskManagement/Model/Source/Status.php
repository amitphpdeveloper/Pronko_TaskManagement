<?php

/**
 * MaxPronko Consulting
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@eadesign.ro so we can send you a copy immediately.
 *
 * @category    MaxPronko_TaskManagement
 * @copyright   Copyright (c) 2018 MaxPronko Consulting.
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
 
namespace Pronko\TaskManagement\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class MeasurementUnit
 * @package Pronko\TaskManagement\Model\Source
 */

class Status implements OptionSourceInterface
{

    const TO_DO = '0';
    const IN_PROGRESS = '1';
	const DONE = '2';

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = [
            self::TO_DO => __('To Do'),
            self::IN_PROGRESS => __('In Progress'),
			self::DONE => __('Done')
        ];
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
