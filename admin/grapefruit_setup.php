<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
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
 * 	\file		admin/grapefruit.php
 * 	\ingroup	grapefruit
 * 	\brief		This file is an example module setup page
 * 				Put some comments here
 */
// Dolibarr environment
$res = @include("../../main.inc.php"); // From htdocs directory
if (! $res) {
    $res = @include("../../../main.inc.php"); // From "custom" directory
}

// Libraries
require_once DOL_DOCUMENT_ROOT . "/core/lib/admin.lib.php";
require_once '../lib/grapefruit.lib.php';

// Translations
$langs->load("grapefruit@grapefruit");
$langs->load("contract");
$langs->load("fournisseur");

// Access control
if (! $user->admin) {
    accessforbidden();
}

// Parameters
$action = GETPOST('action', 'alpha');

/*
 * Actions
 */
if (preg_match('/set_(.*)/',$action,$reg))
{
	$code=$reg[1];
	if (dolibarr_set_const($db, $code, GETPOST($code), 'chaine', 0, '', $conf->entity) > 0)
	{
		
		setEventMessage("ValuesUpdated");
		
		header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}
	
if (preg_match('/del_(.*)/',$action,$reg))
{
	$code=$reg[1];
	if (dolibarr_del_const($db, $code, 0) > 0)
	{
		Header("Location: ".$_SERVER["PHP_SELF"]);
		exit;
	}
	else
	{
		dol_print_error($db);
	}
}

/*
 * View
 */
$page_name = "GrapeFruitSetup";
llxHeader('', $langs->trans($page_name));

// Subheader
$linkback = '<a href="' . DOL_URL_ROOT . '/admin/modules.php">'
    . $langs->trans("BackToModuleList") . '</a>';
print_fiche_titre($langs->trans($page_name), $linkback);

// Configuration header
$head = grapefruitAdminPrepareHead();
dol_fiche_head(
    $head,
    'settings',
    $langs->trans("Module104997Name"),
    0,
    "grapefruit@grapefruit"
);

// Setup page goes here
$form=new Form($db);
$var=false;
print '<table class="noborder" width="100%">';
print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Project").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";

// Example with a yes / no select
/*$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("ParamLabel").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_CONSTNAME">';
print $form->selectyesno("CONSTNAME",$conf->global->CONSTNAME,1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';
*/
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_BUDGET_NEEDED").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_BUDGET_NEEDED">';
echo ajax_constantonoff('GRAPEFRUIT_BUDGET_NEEDED');
print '</form>';
print '</td></tr>';
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_DATEEND_NEEDED").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_DATEEND_NEEDED">';
echo ajax_constantonoff('GRAPEFRUIT_DATEEND_NEEDED');
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_PROJECT_AUTO_ADD_TASKS_ON_CREATE").'</td>';
print '<td colspan="2"  align="right">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_PROJECT_AUTO_ADD_TASKS_ON_CREATE">';
print '<textarea cols="80" rows="5" name="GRAPEFRUIT_PROJECT_AUTO_ADD_TASKS_ON_CREATE">'.$conf->global->GRAPEFRUIT_PROJECT_AUTO_ADD_TASKS_ON_CREATE.'</textarea>';
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Propal").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_PROPAL_DEFAULT_BANK_ACOUNT").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_PROPAL_DEFAULT_BANK_ACOUNT">';
print $form->select_comptes($conf->global->GRAPEFRUIT_PROPAL_DEFAULT_BANK_ACOUNT, 'GRAPEFRUIT_PROPAL_DEFAULT_BANK_ACOUNT', 0, '', 1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("SupplierOrder").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_SUPPLIER_FORCE_BT_ORDER_TO_INVOICE").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SUPPLIER_FORCE_BT_ORDER_TO_INVOICE">';
echo ajax_constantonoff('GRAPEFRUIT_SUPPLIER_FORCE_BT_ORDER_TO_INVOICE');
print '</form>';
print '</td></tr>';

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_SUPPLIER_CONTACT_SHIP_ADDRESS").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SUPPLIER_CONTACT_SHIP_ADDRESS">';
echo ajax_constantonoff('GRAPEFRUIT_SUPPLIER_CONTACT_SHIP_ADDRESS');
print '</form>';
print '</td></tr>';

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("CustomerOrder").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_ORDER_CONTACT_SHIP_ADDRESS").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_ORDER_CONTACT_SHIP_ADDRESS">';
echo ajax_constantonoff('GRAPEFRUIT_ORDER_CONTACT_SHIP_ADDRESS');
print '</form>';
print '</td></tr>';
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_ORDER_CREATE_BILL_ON_VALIDATE").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_ORDER_CREATE_BILL_ON_VALIDATE">';
echo ajax_constantonoff('GRAPEFRUIT_ORDER_CREATE_BILL_ON_VALIDATE');
print '</form>';
print '</td></tr>';

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Shipping").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID">';
echo ajax_constantonoff('GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID');
print '</form>';
print '</td></tr>';


dol_include_once('/product/class/html.formproduct.class.php');
$formProduct = new FormProduct($db);
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$langs->trans("set_GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID_WAREHOUSE").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID_WAREHOUSE">';
echo $formProduct->selectWarehouses($conf->global->GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID_WAREHOUSE,'GRAPEFRUIT_SHIPPING_CREATE_FROM_ORDER_WHERE_BILL_PAID_WAREHOUSE','',1);
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Contract").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_CONTRACT_DEFAUL_FOURN").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_CONTRACT_DEFAUL_FOURN">';
echo $form->select_thirdparty($conf->global->GRAPEFRUIT_CONTRACT_DEFAUL_FOURN, 'GRAPEFRUIT_CONTRACT_DEFAUL_FOURN', 'fournisseur=1');
print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';


if($conf->facture->enabled) {

print '<tr class="liste_titre">';
print '<td>'.$langs->trans("Bill").'</td>'."\n";
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";
$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.$langs->trans("set_GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE">';
echo ajax_constantonoff('GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE');
print '</form>';
print '</td></tr>';



$sql = "SELECT rowid, label, topic, content, lang";
$sql.= " FROM ".MAIN_DB_PREFIX.'c_email_templates';
$sql.= " WHERE type_template='facture_send'";
$sql.= " AND entity IN (".getEntity("c_email_templates").")";
$res = $db->query($sql);
while($obj = $db->fetch_object($res)) {
	$TModel[$obj->rowid] = $obj->label.( !empty($obj->lang) ? '('.$obj->lang.')' : '' );
}

$var=!$var;
print '<tr '.$bc[$var].'>';
print '<td>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$langs->trans("set_GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE_MODEL").'</td>';
print '<td align="center" width="20">&nbsp;</td>';
print '<td align="right" width="300">';
print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
print '<input type="hidden" name="action" value="set_GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE_MODEL">';

echo $form->selectarray('GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE_MODEL', $TModel, $conf->global->GRAPEFRUIT_SEND_BILL_BY_MAIL_ON_VALIDATE_MODEL);

print '<input type="submit" class="button" value="'.$langs->trans("Modify").'">';
print '</form>';
print '</td></tr>';

}

if($conf->agefodd->enabled) {

	print '<tr class="liste_titre">';
	print '<td>'.$langs->trans("Agefodd").'</td>'."\n";
	print '<td align="center" width="20">&nbsp;</td>';
	print '<td align="center" width="100">'.$langs->trans("Value").'</td>'."\n";

	$var=!$var;
	print '<tr '.$bc[$var].'>';
	print '<td>'.$langs->trans("set_GRAPEFRUIT_LINK_INVOICE_TO_SESSION_IF_PROPAL_IS").'</td>';
	print '<td align="center" width="20">&nbsp;</td>';
	print '<td align="right" width="300">';
	print '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
	print '<input type="hidden" name="token" value="'.$_SESSION['newtoken'].'">';
	print '<input type="hidden" name="action" value="set_GRAPEFRUIT_LINK_INVOICE_TO_SESSION_IF_PROPAL_IS">';
	echo ajax_constantonoff('GRAPEFRUIT_LINK_INVOICE_TO_SESSION_IF_PROPAL_IS');
	print '</form>';
	print '</td></tr>';

}

print '</table>';

llxFooter();

$db->close();
