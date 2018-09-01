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
 

namespace Pronko\TaskManagement\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Pronko\TaskManagement\Model\ResourceModel\TaskManagement\CollectionFactory;


class MassDelete extends Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $data;

    /**
     * MassDelete constructor.
     * @param Filter $filter
     * @param Action\Context $context
     *
     */
    public function __construct(
        Filter $filter,
        Action\Context $context,
        CollectionFactory $data
    )
    {
        $this->filter = $filter;
        $this->data = $data;
          parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
         
        try {
            $collection = $this->filter->getCollection($this->data->create());
            $deleted = 0;
            foreach ($collection->getItems() as $item) {
                $item->delete();
                $deleted++;
            }
        } catch (\Exception $e) {
            $this->messageManager->addError(
                __('We can\'t process your request right now. %1', $e->getMessage())
            );
            $this->_redirect('taskmanagement/index/');
            return;
        }
        $this->messageManager->addSuccessMessage(
            __('A total of %1 record(s) have been deleted.', $deleted)
        );

        return $resultRedirect->setPath('taskmanagement/index/');
    }
	
	/**
     * Determine if authorized to perform group actions.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Pronko_TaskManagement::TaskManagement_delete');
    }
}
