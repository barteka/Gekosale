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
 * $Id: countrieslist.php 438 2011-08-27 09:29:36Z gekosale $ 
 */

namespace Gekosale;

class CountriesListModel extends Component\Model
{

	public function getCountries ()
	{
		$sql = 'SELECT 
					C.idcountry as countryid, 
					C.name
				FROM country C';
		$stmt = Db::getInstance()->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getCountryForSelect ()
	{
		$results = $this->getCountries();
		$Data = Array();
		
		foreach ($results as $value){
			$Data[$value['countryid']] = $value['name'];
		}
		return $Data;
	}
}