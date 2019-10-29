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

/**
 * \file    class/actions_stackbuilderconnector.class.php
 * \ingroup stackbuilderconnector
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class ActionsStackBuilderConnector
 */
class ActionsStackBuilderConnector
{
    /**
     * @var DoliDb		Database handler (result of a new DoliDB)
     */
    public $db;

	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
     * @param DoliDB    $db    Database connector
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    $object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          $action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	public function addMoreActionsButtons($parameters, &$object, &$action, $hookmanager)
	{
		global $langs;
		$langs->load('stackbuilderconnector@stackbuilderconnector');
		$TContext = explode(':', $parameters['context']);
		if ( (in_array('propalcard',$TContext) && $object->statut >= Propal::STATUS_VALIDATED)
			|| (in_array('ordercard',$TContext) && $object->statut >= Commande::STATUS_VALIDATED)
			|| (in_array('expeditioncard',$TContext) && $object->statut >= Expedition::STATUS_VALIDATED) )
		{
			print '<a class="butAction" href="' . $_SERVER["PHP_SELF"] . '?id=' . $object->id . '&amp;action=stackbuilderdownload">'.$langs->trans('DowloadStackBuilderFile').'</a>';

		}
		return 0; // or return 1 to replace standard code
	}
}
