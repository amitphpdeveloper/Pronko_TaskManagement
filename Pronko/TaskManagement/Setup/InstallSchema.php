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
 

namespace Pronko\TaskManagement\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
		$installer = $setup;
		$installer->startSetup();
		
		$setup->getConnection()->dropTable($setup->getTable('pronko_taskmanagement'));
		
		/**
         * Create table 'pronko_taskmanagement'
         */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('pronko_taskmanagement')
		)->addColumn(
			'task_id',
			Table::TYPE_INTEGER,
			null,
			['identity'=>true, 'unsigned' => true, 'nullable'=>false,'primary'=>true],
			'task_id'
		)->addColumn(
		  'task_name',
		  Table::TYPE_TEXT,
		  255,
		  ['nullable'=>false,'default'=>''],
		  'task_name'
		)->addColumn(
		  'task_description',
		  Table::TYPE_TEXT,
		  Table::MAX_TEXT_SIZE,
		  ['nullable'=>true],
		  'task_description'
		)->addColumn(
		  'start_time',
		  Table::TYPE_DATETIME,
		  null,
		  ['nullable'=>true],
		  'start_time'
		)->addColumn(
		  'end_time',
		  Table::TYPE_DATETIME,
		  null,
		  ['nullable'=>true],
		  'end_time'
		)->addColumn(
		  'assigned_person',
		  Table::TYPE_TEXT,
		  null,
		  ['nullable'=>false,'default'=>''],
		  'assigned_person'
		)->addColumn(
		    'status',
			Table::TYPE_SMALLINT,
			null,
			['nullable' => false, 'default' => 0],
			'status'
		)->setComment('Max Pronko Task Management System');
		
		$installer->getConnection()->createTable($table);
		
		$installer->endSetup();
	}
}
