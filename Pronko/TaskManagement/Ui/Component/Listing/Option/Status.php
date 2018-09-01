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

namespace Pronko\TaskManagement\Ui\Component\Listing\Option;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionHash() {
        return array(
            \Pronko\TaskManagement\Model\Source\Status::TO_DO => __('To Do'),
            \Pronko\TaskManagement\Model\Source\Status::IN_PROGRESS => __('In Progress'),
			\Pronko\TaskManagement\Model\Source\Status::DONE => __('Done')
        );
    }
	
	
	 public function toOptionArray() {
        $options = array();
        foreach ($this->toOptionHash() as $value => $label) {
            $options[] = array(
                'value' => $value,
                'label' => $label,
            );
        }
		
        return $options;
    }
}