<?php
/* Copyright (C) 2019 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!class_exists('SeedObject'))
{
	/**
	 * Needed if $form->showLinkedObjectBlock() is call or for session timeout on our module page
	 */
	define('INC_FROM_DOLIBARR', true);
	require_once dirname(__FILE__).'/../config.php';
}


class StackBuilderConnector extends SeedObject
{
	public static function generateXML($object) {
		global $conf, $langs;
		$upload_dir = '';
		$qtyColis = 0;
		if($object->element == 'propal') $upload_dir = $conf->propal->multidir_output[$object->entity].'/'.dol_sanitizeFileName($object->ref);
		else if($object->element == 'commande') $upload_dir = $conf->commande->dir_output . "/" . dol_sanitizeFileName($object->ref);
		else if($object->element == 'shipping')  $upload_dir = $conf->expedition->dir_output . "/sending/" . dol_sanitizeFileName($object->ref);
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-1"?><STACKBUILDER/>');
		if(!empty($object->lines)) {
			foreach($object->lines as $line) {
				if(!empty($line->fk_product)) {
					$line->fetch_product();
					if(!empty($line->product->array_options['options_prod_per_col']) && !empty($line->qty)) $qtyColis = ceil(floatval($line->qty) / floatval($line->product->array_options['options_prod_per_col']));
					else if(empty($line->product->array_options['options_prod_per_col'])){
						setEventMessage($langs->trans('MissingProdPerCol'),'errors');
						break;
					}
					else if(empty($line->qty)) {
						setEventMessage($langs->trans('MissingQty'),'errors');
						break;
					}
					for($i = 0; $i<$qtyColis; $i++) {

					}
					exit;
				}
			}
		}
		$xml->asXML($upload_dir . '/stackbuilder-'.$object->ref.'.xml');


	}
}


//class StackBuilderConnectorDet extends SeedObject
//{
//    public $table_element = 'stackbuilderconnectordet';
//
//    public $element = 'stackbuilderconnectordet';
//
//
//    /**
//     * StackBuilderConnectorDet constructor.
//     * @param DoliDB    $db    Database connector
//     */
//    public function __construct($db)
//    {
//        $this->db = $db;
//
//        $this->init();
//    }
//}
