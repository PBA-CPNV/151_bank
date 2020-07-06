<?php
/**
 * @file      customersManager.php
 * @brief     This model is designed to implement the articles business logic
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   12-MAY-2020
 */

//<editor-fold desc="region test">
/**
 * @brief This function is designed to get all active articles
 * @return array : containing all information about the articles. Array can be empty.
 * @throws ModelDataBaseException : will be throw if something goes wrong with the database opening process
 */
function getcustomers()
{

    $agencieQuery = 'SELECT id, name, surname, city FROM customers';

    require_once 'model/dbConnector.php';

    return executeQuerySelect($agencieQuery);
}

//</editor-fold>

/**
 * @param $customerId
 * @return mixed
 * @throws ModelDataBaseException
 */
function getcustomerDetail($customerId)
{
    $strgSeparator = '\'';

    // Query to get the selected snow. Active must setted to avoid that user can view an non active snow by entering the code in the URL
    $querycustomerDetail = 'SELECT id, name, city, active FROM customers WHERE id='.$customerId;

    require 'model/dbConnector.php';
    $customerDetails = executeQuerySelect($querycustomerDetail);

    return $customerDetails[0];
}

/**
 * @return mixed
 * @throws ModelDataBaseException
 */
function getLastIdCustomer()
{
    $queryID="SELECT id FROM customers order by id DESC";
    require 'model/dbConnector.php';
    $articleDetail = executeQuerySelect($queryID);
    return $articleDetail[0];
}

/**
 * @param $customerName
 * @param $customerCity
 * @param $customerActive
 * @return bool
 * @throws ModelDataBaseException
 */
function newCustomer($id, $customerName,  $customerSurname, $customerCity)
{
    $strSeparator = '\'';

    $addcustomerQuery = 'INSERT INTO customers (`id`,`name`, `surname`, `city`) VALUES (' . $id . ',' . $strSeparator . $customerName . $strSeparator . ','. $strSeparator . $customerSurname . $strSeparator . ',' . $strSeparator . $customerCity . $strSeparator .')';

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addcustomerQuery);
    return $queryResult;
}

function customerHasCustomer($customerId){
    $strgSeparator = '\'';

    // Query to get the selected snow. Active must setted to avoid that user can view an non active snow by entering the code in the URL
    $querycustomerDetail = 'SELECT  ac.id FROM accounts ac INNER JOIN customers ag WHERE ac.id=ag.id AND id_customer='.$customerId;

    require 'model/dbConnector.php';
    $customerDetail = executeQuerySelect($querycustomerDetail);

    return $customerDetail;
}


/**
 * @param $id
 * @return mixed
 */
function deletecustomer($id){
    $strSeparator = '\'';
    $delcustomerQuery = 'DELETE FROM customers  WHERE id='.$id.';' ;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($delcustomerQuery);
    return $queryResult;
}

/**
 * @param $customerId
 * @param $customerName
 * @return bool|null
 * @throws ModelDataBaseException
 */
function customerUpdate($customerId, $name, $city, $active){
    $strSeparator = '\'';
    if (!isset($active)){
        $active=0;
    }
    $updcustomerQuery = 'UPDATE customers SET name='.$strSeparator .$name.$strSeparator .', city='.$strSeparator .$city.$strSeparator .', active='.(int)$active.'  WHERE id='.$customerId.';' ;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($updcustomerQuery);
    return $queryResult;
}