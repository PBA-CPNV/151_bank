<?php
/**
 * @file      index.php
 * @brief     This file is the application's rooter.
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

require "controller/agencies.php";
require "controller/customers.php";
require "controller/navigation.php";
require "controller/users.php";

session_start();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'home' :
            home();
            break;
        case 'displayAgencyDetail':
            displayArticleDetail($_GET['articleId']);
            break;
        case 'displayAgencies' :
            displayAgencies();
            break;
        case 'addAgency' :
            addAgency($_POST);
            break;
        case 'removeAgency' :
            removeAgency($_GET['id']);
            break;
        case 'updateAgency' :
            updateAgency($_GET['id'], $_POST);
            break;
        case 'displayCustomers' :
            displayCustomers();
            break;
        case 'addCustomer' :
            addCustomer($_POST);
            break;
        case 'removeCustomer' :
            removeCustomer($_GET['id']);
            break;
        case 'updateCustomer' :
            updateCustomer($_GET['id'], $_POST);
            break;
        case 'login' :
            login($_POST);
            break;
        case 'logout' :
            logout();
            break;
        default :
            lost();
    }
} else {
    home();
}