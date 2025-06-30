<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'AdminLogin';
 
// Route for the login page
$route['Index'] = 'AdminLogin/Index'; 
$route['login'] = 'AdminLogin/login'; 
$route['logout'] = 'AdminLogin/logout'; 


//route for Dashboard page
$route['DashboardIndex'] = 'Dashboard_Controller/DashboardIndex';

//route for beneficiary page

//$route['index'] = 'Beneficiary_Controller/index';
$route['BeneficiaryIndex'] = 'Beneficiary_Controller/BeneficiaryIndex';
$route['create'] = 'Beneficiary_Controller/create';
$route['GetDataList'] = 'Beneficiary_Controller/GetDataList';
$route['upd_data'] = 'Beneficiary_Controller/upd_data';
$route['updatedata'] = 'Beneficiary_Controller/updatedata';
$route['upd'] = 'Beneficiary_Controller/upd';

///////////Routes for Masjid Management://///////
$route['MasjidIndex'] = 'Masjid_Controller/MasjidIndex';
$route['add'] = 'Masjid_Controller/add';
$route['GetList'] = 'Masjid_Controller/GetList';
$route['delete_id'] = 'Masjid_Controller/delete_id';
$route['updatedata'] = 'Masjid_Controller/updatedata';
$route['upd'] = 'Masjid_Controller/upd';


///////////Routes for Users Management://///////
$route['UsersIndex'] = 'Users_Controller/UsersIndex';
$route['add'] = 'Users_Controller/add';
$route['UsersList'] = 'Users_Controller/UsersList';
$route['del_user'] = 'Users_Controller/del_user';
$route['updatedata'] = 'Users_Controller/updatedata';
$route['upd'] = 'Users_Controller/upd';

/* Voucher Management */
$route['VoucherIndex'] = 'Voucher_Controller/VoucherIndex';
$route['createVoucher'] = 'Voucher_Controller/createVoucher';
$route['BulkUpload'] = 'Voucher_Controller/BulkUpload';
$route['GetListData'] = 'Voucher_Controller/GetListData';
$route['Del_data'] = 'Voucher_Controller/Del_data';
$route['updatedata'] = 'Voucher_Controller/updatedata';
$route['upd'] = 'Voucher_Controller/upd';
$route['GetBeneficiaryData'] = 'Voucher_Controller/GetBeneficiaryData';

/** Vendor Management **/
$route['VendorIndex'] = 'Vendor_Controller/VendorIndex';
$route['createVendor'] = 'Vendor_Controller/createVendor';
$route['GetVendorList'] = 'Vendor_Controller/GetVendorList';
$route['del_user'] = 'Vendor_Controller/del_user';
$route['updatedata'] = 'Vendor_Controller/updatedata';
$route['upd'] = 'Vendor_Controller/upd';

/* Funds Management */
$route['FundsIndex'] = 'Funds_Controller/FundsIndex';
$route['createFund'] = 'Funds_Controller/createFund';
$route['GetFundList'] = 'Funds_Controller/GetFundList';
$route['updatedata'] = 'Funds_Controller/updatedata';
$route['updateFund'] = 'Funds_Controller/updateFund';

/* Reports Management */
$route['BeneficiaryReport'] = 'Beneficiary_Report_Controller/BeneficiaryReport';
$route['GetReport'] = 'Beneficiary_Report_Controller/GetReport';
$route['Export'] = 'Beneficiary_Report_Controller/Export';
$route['GetListReport'] = 'Masjid_Report_Controller/GetListReport';
$route['MasjidReport'] = 'Masjid_Report_Controller/MasjidReport';
$route['ExportMasjids'] = 'Masjid_Report_Controller/ExportMasjids';

/* Transaction List */
$route['TransactionsList'] = 'Transactions_List_Controller/TransactionsList';
$route['GetTransactionsList'] = 'Transactions_List_Controller/GetTransactionsList';
$route['ExportTransactions'] = 'Transactions_List_Controller/ExportTransactions';
$route['Approvalupdate'] = 'Transactions_List_Controller/Approvalupdate';
$route['SettlementUpdate'] = 'Transactions_List_Controller/SettlementUpdate';
$route['BulkApproval'] = 'Transactions_List_Controller/BulkApproval';
$route['BulkSettlement'] = 'Transactions_List_Controller/BulkSettlement';

/* Settlement of Vouchers*/
$route['SettlementList'] = 'Settlement_Controller/SettlementList';
$route['GetVouchersList'] = 'Settlement_Controller/GetVouchersList';
$route['Approvalupdate'] = 'Settlement_Controller/Approvalupdate';
$route['SettlementUpdate'] = 'Settlement_Controller/SettlementUpdate';
$route['BulkApproval'] = 'Settlement_Controller/BulkApproval';
$route['BulkSettlement'] = 'Settlement_Controller/BulkSettlement';
$route['VouchersDetails'] = 'Settlement_Controller/VouchersDetails';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
