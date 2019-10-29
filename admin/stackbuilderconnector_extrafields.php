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
 *      \file       admin/stackbuilderconnector_extrafields.php
 *		\ingroup    stackbuilderconnector
 *		\brief      Page to setup extra fields of stackbuilderconnector
 */

$res = @include '../../main.inc.php'; // From htdocs directory
if (! $res) {
    $res = @include '../../../main.inc.php'; // From "custom" directory
}


/*
 * Config of extrafield page for StackBuilderConnector
 */
require_once '../lib/stackbuilderconnector.lib.php';
require_once '../class/stackbuilderconnector.class.php';
$langs->loadLangs(array('stackbuilderconnector@stackbuilderconnector', 'admin', 'other'));

$stackbuilderconnector = new StackBuilderConnector($db);
$elementtype=$stackbuilderconnector->table_element;  //Must be the $table_element of the class that manage extrafield

// Page title and texts elements
$textobject=$langs->transnoentitiesnoconv('StackBuilderConnector');
$help_url='EN:Help StackBuilderConnector|FR:Aide StackBuilderConnector';
$pageTitle = $langs->trans('StackBuilderConnectorExtrafieldPage');

// Configuration header
$head = stackbuilderconnectorAdminPrepareHead();



/*
 *  Include of extrafield page
 */

require_once dol_buildpath('abricot/tpl/extrafields_setup.tpl.php'); // use this kind of call for variables scope
