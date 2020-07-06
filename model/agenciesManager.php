<?php
/**
 * @file      agenciesManager.php
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
function getAgencies()
{

    $agencieQuery = 'SELECT id, name, city, active FROM agencies';

    require_once 'model/dbConnector.php';

    return executeQuerySelect($agencieQuery);
}

//</editor-fold>

/**
 * @param $agencyId
 * @return mixed
 * @throws ModelDataBaseException
 */
function getAgencyDetail($agencyId)
{
    $strgSeparator = '\'';

    // Query to get the selected snow. Active must setted to avoid that user can view an non active snow by entering the code in the URL
    $queryAgencyDetail = 'SELECT id, name, city, active FROM agencies WHERE id='.$agencyId;

    require 'model/dbConnector.php';
    $agencyDetails = executeQuerySelect($queryAgencyDetail);

    return $agencyDetails[0];
}

/**
 * @return mixed
 * @throws ModelDataBaseException
 */
function getLastIdAgency()
{
    $queryID="SELECT id FROM agencies order by id DESC";
    require 'model/dbConnector.php';
    $articleDetail = executeQuerySelect($queryID);
    return $articleDetail[0];
}

/**
 * @param $agencyName
 * @param $agencyCity
 * @param $agencyActive
 * @return bool
 * @throws ModelDataBaseException
 */
function newAgency($id, $agencyName, $agencyCity, $agencyActive)
{
    $strSeparator = '\'';

    $addAgencyQuery = 'INSERT INTO agencies (`id`,`name`, `city`,  `active`) VALUES (' . $id . ',' . $strSeparator . $agencyName . $strSeparator . ',' . $strSeparator . $agencyCity . $strSeparator . ',0)';

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($addAgencyQuery);
    return $queryResult;
}

function agencyHasCustomer($agencyId){
    $strgSeparator = '\'';

    // Query to get the selected snow. Active must setted to avoid that user can view an non active snow by entering the code in the URL
    $queryAgencyDetail = 'SELECT  ac.id FROM accounts ac INNER JOIN agencies ag WHERE ac.id=ag.id AND id_agency='.$agencyId;

    require 'model/dbConnector.php';
    $agencyDetail = executeQuerySelect($queryAgencyDetail);

    return $agencyDetail;
}


/**
 * @param $id
 * @return mixed
 */
function deleteAgency($id){
    $strSeparator = '\'';
    $delAgencyQuery = 'DELETE FROM agencies  WHERE id='.$id.';' ;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($delAgencyQuery);
    return $queryResult;
}

/**
 * @param $agencyId
 * @param $agencyName
 * @return bool|null
 * @throws ModelDataBaseException
 */
function agencyUpdate($agencyId, $name, $city, $active){
    $strSeparator = '\'';
    if (!isset($active)){
        $active=0;
    }
    $updAgencyQuery = 'UPDATE agencies SET name='.$strSeparator .$name.$strSeparator .', city='.$strSeparator .$city.$strSeparator .', active='.(int)$active.'  WHERE id='.$agencyId.';' ;

    require_once 'model/dbConnector.php';
    $queryResult = executeQuery($updAgencyQuery);
    return $queryResult;
}