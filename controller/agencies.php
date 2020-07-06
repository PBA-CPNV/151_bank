<?php
/**
 * @file      agencies.php
 * @brief     this controller is designed to manage agencys actions
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   12-MAY-2020
 */

/**
 * @brief This function is designed to display all agencys available in the e-shop
 */
function displayAgencies()
{
    try {
        require_once "model/agenciesManager.php";
        $agencies = getAgencies();
    } catch (ModelDataBaseException $ex) {
        $agencyErrorMessage = "Nous rencontrons temporairement un problème technique pour afficher nos produits. Désolé du dérangement !";
    } finally {
        require "view/agencies.php";
    }
}

/**
 * @brief This function is designed to display only a specific agency selected by the user
 * @param $agencyId : agency Code
 */
function displayAgencyDetail($agencyId)
{

    if (isset($agencyId))
    {
        try{
            require_once "model/agenciesManager.php";
            $agencyDetailToDisplay = getagencyDetail($agencyId);
        } catch (ModelDataBaseException $ex) {
            $agencyDetailErrorMessage = "Nous rencontrons temporairement un problème technique pour afficher le détail de ce produit. Désolé du dérangement !";
        } finally {
            require "view/agency-detail.php";
        }
    }
}

/**
 * @param $agencyRequest
 */
function addAgency($agencyRequest){
    try {
        //variable set
        if (isset($agencyRequest['inputAgencyName']) && isset($agencyRequest['inputAgencyCity'])) {

            //extract register parameters
            $agencyName = $agencyRequest['inputAgencyName'];
            $agencyCity = $agencyRequest['inputAgencyCity'];
            if (isset($agencyRequest['inputAgencyActive']))
                $agencyActive = $agencyRequest['inputAgencyActive'];
            else
                $agencyActive=0;

            require_once "model/agenciesManager.php";
            $idLastAgency = getLastIdAgency();
            $idLastAgency['id']++;
            if (newAgency( $idLastAgency['id'],$agencyName, $agencyCity, $agencyCity)) {
                 $agencyErrorMessage = null;
                 require "view/home.php";
            }
            else
            {
                require "view/home.php";
            }

        } else {
            $agencyErrorMessage = null;
            require "view/agency-add.php";
        }
    } catch (ModelDataBaseException $ex) {
        $agencyErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de s'enregistrer. Désolé du dérangement !";
        require "view/agency-add.php";
    }
}

/**
 * @param $id
 * @throws ModelDataBaseException
 */
function removeAgency($agencyId){
    try {
        if (isset($agencyId)) {
            require_once "model/agenciesManager.php";
            if (agencyHasCustomer($agencyId))
            {
                $agencyErrorMessage= "L'agence ne peut être supprimée car elle a des clients";
                require_once "model/agenciesManager.php";
                $agencies = getAgencies();
                require "view/agencies.php";
            }
            else {
                if (deleteAgency($agencyId)) {
                    require_once "model/agenciesManager.php";
                    $agencies = getAgencies();
                    require "view/agencies.php";
                }
            }
                    }
        } catch (ModelDataBaseException $ex) {
            $agencyErrorMessage = "Nous rencontrons temporairement un problème technique pour la suppression de produits. Désolé du dérangement !";
        }
}

/**
 * @param $agencyId
 */
function updateAgency($agencyId, $agencyUpdate){
    require_once "model/agenciesManager.php";
    $agency=getAgencyDetail($agencyId);
    if (isset($agencyId) && isset($agencyUpdate['inputAgencyName']) && isset($agencyUpdate['inputAgencyCity'])) {
         if (isset($agencyUpdate['inputAgencyActive']))
            $agencyUpdate['inputAgencyActive']=1;
         else
             $agencyUpdate['inputAgencyActive']=0;
         if (agencyUpdate($agencyId, $agencyUpdate['inputAgencyName'], $agencyUpdate['inputAgencyCity'], $agencyUpdate['inputAgencyActive'])) {
             require_once "model/agenciesManager.php";
             $agencies = getAgencies();
             require "view/agencies.php";
         }
         else{
             $agencies = getAgencies();
             require "view/agencies.php";
         }
     }
     else
     {
        require "view/agency-update.php";
     }
}
