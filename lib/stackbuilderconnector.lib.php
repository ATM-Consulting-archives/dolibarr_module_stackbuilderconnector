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
 *	\file		lib/stackbuilderconnector.lib.php
 *	\ingroup	stackbuilderconnector
 *	\brief		This file is an example module library
 *				Put some comments here
 */

/**
 * @return array
 */
function stackbuilderconnectorAdminPrepareHead()
{
    global $langs, $conf;

    $langs->load('stackbuilderconnector@stackbuilderconnector');

    $h = 0;
    $head = array();

    $head[$h][0] = dol_buildpath("/stackbuilderconnector/admin/stackbuilderconnector_setup.php", 1);
    $head[$h][1] = $langs->trans("Parameters");
    $head[$h][2] = 'settings';
    $h++;
    $head[$h][0] = dol_buildpath("/stackbuilderconnector/admin/stackbuilderconnector_extrafields.php", 1);
    $head[$h][1] = $langs->trans("ExtraFields");
    $head[$h][2] = 'extrafields';
    $h++;
    $head[$h][0] = dol_buildpath("/stackbuilderconnector/admin/stackbuilderconnector_about.php", 1);
    $head[$h][1] = $langs->trans("About");
    $head[$h][2] = 'about';
    $h++;

    // Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    //$this->tabs = array(
    //	'entity:+tabname:Title:@stackbuilderconnector:/stackbuilderconnector/mypage.php?id=__ID__'
    //); // to add new tab
    //$this->tabs = array(
    //	'entity:-tabname:Title:@stackbuilderconnector:/stackbuilderconnector/mypage.php?id=__ID__'
    //); // to remove a tab
    complete_head_from_modules($conf, $langs, $object, $head, $h, 'stackbuilderconnector');

    return $head;
}

/**
 * Return array of tabs to used on pages for third parties cards.
 *
 * @param 	StackBuilderConnector	$object		Object company shown
 * @return 	array				Array of tabs
 */
function stackbuilderconnector_prepare_head(StackBuilderConnector $object)
{
    global $langs, $conf;
    $h = 0;
    $head = array();
    $head[$h][0] = dol_buildpath('/stackbuilderconnector/card.php', 1).'?id='.$object->id;
    $head[$h][1] = $langs->trans("StackBuilderConnectorCard");
    $head[$h][2] = 'card';
    $h++;
	
	// Show more tabs from modules
    // Entries must be declared in modules descriptor with line
    // $this->tabs = array('entity:+tabname:Title:@stackbuilderconnector:/stackbuilderconnector/mypage.php?id=__ID__');   to add new tab
    // $this->tabs = array('entity:-tabname:Title:@stackbuilderconnector:/stackbuilderconnector/mypage.php?id=__ID__');   to remove a tab
    complete_head_from_modules($conf, $langs, $object, $head, $h, 'stackbuilderconnector');
	
	return $head;
}

/**
 * @param Form      $form       Form object
 * @param StackBuilderConnector  $object     StackBuilderConnector object
 * @param string    $action     Triggered action
 * @return string
 */
function getFormConfirmStackBuilderConnector($form, $object, $action)
{
    global $langs, $user;

    $formconfirm = '';

    if ($action === 'valid' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmValidateStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmValidateStackBuilderConnectorTitle'), $body, 'confirm_validate', '', 0, 1);
    }
    elseif ($action === 'accept' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmAcceptStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmAcceptStackBuilderConnectorTitle'), $body, 'confirm_accept', '', 0, 1);
    }
    elseif ($action === 'refuse' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmRefuseStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmRefuseStackBuilderConnectorTitle'), $body, 'confirm_refuse', '', 0, 1);
    }
    elseif ($action === 'reopen' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmReopenStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmReopenStackBuilderConnectorTitle'), $body, 'confirm_refuse', '', 0, 1);
    }
    elseif ($action === 'delete' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmDeleteStackBuilderConnectorBody');
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmDeleteStackBuilderConnectorTitle'), $body, 'confirm_delete', '', 0, 1);
    }
    elseif ($action === 'clone' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmCloneStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmCloneStackBuilderConnectorTitle'), $body, 'confirm_clone', '', 0, 1);
    }
    elseif ($action === 'cancel' && !empty($user->rights->stackbuilderconnector->write))
    {
        $body = $langs->trans('ConfirmCancelStackBuilderConnectorBody', $object->ref);
        $formconfirm = $form->formconfirm($_SERVER['PHP_SELF'] . '?id=' . $object->id, $langs->trans('ConfirmCancelStackBuilderConnectorTitle'), $body, 'confirm_cancel', '', 0, 1);
    }

    return $formconfirm;
}
