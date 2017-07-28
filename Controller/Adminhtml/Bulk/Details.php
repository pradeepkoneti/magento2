<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\AsynchronousOperations\Controller\Adminhtml\Bulk;

/**
 * Class View Opertion Details Controller
 * @since 2.2.0
 */
class Details extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     * @since 2.2.0
     */
    private $resultPageFactory;

    /**
     * @var \Magento\AsynchronousOperations\Model\AccessValidator
     * @since 2.2.0
     */
    private $accessValidator;

    /**
     * Details constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\AsynchronousOperations\Model\AccessValidator $accessValidator
     * @since 2.2.0
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\AsynchronousOperations\Model\AccessValidator $accessValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->accessValidator = $accessValidator;
        parent::__construct($context);
    }

    /**
     * @inheritDoc
     * @since 2.2.0
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Logging::system_magento_logging_bulk_operations')
            && $this->accessValidator->isAllowed($this->getRequest()->getParam('uuid'));
    }
    
    /**
     * Bulk details action
     *
     * @return \Magento\Framework\View\Result\Page
     * @since 2.2.0
     */
    public function execute()
    {
        $bulkId = $this->getRequest()->getParam('uuid');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->initLayout();
        $this->_setActiveMenu('Magento_Logging::system_magento_logging_events');
        $resultPage->getConfig()->getTitle()->prepend(__('Action Details - #' . $bulkId));

        return $resultPage;
    }
}
