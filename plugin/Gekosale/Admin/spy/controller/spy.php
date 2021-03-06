<?php
/**
 * Gekosale, Open Source E-Commerce Solution
 * http://www.gekosale.pl
 *
 * Copyright (c) 2008-2013 WellCommerce sp. z o.o.. Zabronione jest usuwanie informacji o licencji i autorach.
 *
 * This library is free software; you can redistribute it and/or 
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version. 
 * 
 * 
 * $Revision: 438 $
 * $Author: gekosale $
 * $Date: 2011-08-27 11:29:36 +0200 (So, 27 sie 2011) $
 * $Id: spy.php 438 2011-08-27 09:29:36Z gekosale $ 
 */

namespace Gekosale;
use FormEngine;

class SpyController extends Component\Controller\Admin
{

	public function index ()
	{
		$this->registry->xajax->registerFunction(array(
			'LoadAllSpy',
			$this->model,
			'getSpyForAjax'
		));
		$this->renderLayout(array('datagrid_filter' => $this->model->getDatagridFilterData()));
	}

	public function edit ()
	{
		$orderModel = App::getModel('order');
		$clientModel = App::getModel('client');
		$rawSpyData = $this->model->getSessionData($this->id);
		if (! empty($rawSpyData['clientid'])){
			$clientData = $clientModel->getClientView($rawSpyData['clientid']);
			$clientOrderHistory = $orderModel->getclientOrderHistory($rawSpyData['clientid']);
			$this->registry->template->assign('clientData', $clientData);
			$this->registry->template->assign('clientOrderHistory', $clientOrderHistory);
		}
		$this->registry->template->assign('cart', $rawSpyData['cart']);
		$this->registry->xajax->processRequest();
		$this->registry->template->assign('xajax', $this->registry->xajax->getJavascript());
		$this->registry->template->display($this->loadTemplate('edit.tpl'));
	}
}