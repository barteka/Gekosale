<?php
/**
 * Gekosale, Open Source E-Commerce Solution
 * http://www.gekosale.pl
 *
 * Copyright (c) 2009-2013 WellCommerce sp. z o.o.. Zabronione jest usuwanie informacji o licencji i autorach.
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * 
 * $Revision: 54 $
 * $Author: krzotr $
 * $Date: 2011-04-09 09:52:26 +0200 (So, 09 kwi 2011) $
 * $Id: cache.class.php 54 2011-04-09 07:52:26Z krzotr $
 */

namespace Gekosale;

class Cache
{

	public $storage;

	public function __construct ($storage)
	{
		$this->storage = $storage;
	}

	public function save ($name, $value, $time = 0)
	{
		$this->storage->save($name, $this->serialize($value), $time);
	}

	public function load ($name)
	{
		return $this->unserialize($this->storage->load($name));
	}

	public function delete ($name)
	{
		$this->storage->delete($name);
	}

	public function deleteAll ()
	{
		$this->storage->deleteAll();
	}

	public function serialize ($content)
	{
		return serialize($content);
	}

	public function unserialize ($content)
	{
		return unserialize($content);
	}

}
