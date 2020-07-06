<?php

/**
 * @file      customers.php
 * @brief     This controller is designed to manage all customers actions
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY - PASCAL BENZONANA
 * @version   14-JUN-2020
*/

/**
 * @brief This function is designed to display all customers available in the e-shop
 */
function displayCustomers()
{
    try {
        require_once "model/customerManager.php";
        $customers = getcustomers();
    } catch (ModelDataBaseException $ex) {
        $customerErrorMessage = "Nous rencontrons temporairement un problème technique pour afficher nos produits. Désolé du dérangement !";
    } finally {
        require "view/customers.php";
    }
}


/**
 * @param $customerRequest
 */
function addCustomer($customerRequest){
    try {
        //variable set
        if (isset($customerRequest['inputCustomerName']) && isset($customerRequest['inputCustomerSurname']) && isset($customerRequest['inputCustomerCity'])) {

            //extract register parameters
            $customerName = $customerRequest['inputCustomerName'];
            $customerSurname = $customerRequest['inputCustomerSurname'];
            $customerCity = $customerRequest['inputCustomerCity'];

            require_once "model/customerManager.php";
            $idLastCustomer = getLastIdCustomer();
            $idLastCustomer['id']++;
            if (newcustomer( $idLastCustomer['id'],$customerName, $customerSurname, $customerCity)) {
                $customerErrorMessage = null;
                require "view/home.php";
            }
            else
            {
                require "view/home.php";
            }

        } else {
            $customerErrorMessage = null;
            require "view/customer-add.php";
        }
    } catch (ModelDataBaseException $ex) {
        $customerErrorMessage = "Nous rencontrons actuellement un problème technique. Il est temporairement impossible de s'enregistrer. Désolé du dérangement !";
        require "view/customer-add.php";
    }
}

/**
 * @param $id
 * @throws ModelDataBaseException
 */
function removeCustomer($customerId){
    try {
        if (isset($customerId)) {
            require_once "model/customerManager.php";
            if (customerHasCustomer($customerId))
            {
                $customerErrorMessage= "L'agence ne peut être supprimée car elle a des clients";
                require_once "model/customersManager.php";
                $customers = getcustomers();
                require "view/customers.php";
            }
            else {
                if (deletecustomer($customerId)) {
                    require_once "model/customersManager.php";
                    $customers = getcustomers();
                    require "view/customers.php";
                }
            }
        }
    } catch (ModelDataBaseException $ex) {
        $customerErrorMessage = "Nous rencontrons temporairement un problème technique pour la suppression de produits. Désolé du dérangement !";
    }
}

/**
 * @param $customerId
 */
function updateCustomer($customerId, $customerUpdate){
    require_once "model/customerManager.php";
    $customer=getcustomerDetail($customerId);
    if (isset($customerId) && isset($customerUpdate['inputcustomerName']) && isset($customerUpdate['inputcustomerCity'])) {
        if (customerUpdate($customerId, $customerUpdate['inputcustomerName'], $customerUpdate['inputcustomerCity'], $customerUpdate['inputcustomerActive'])) {
            require_once "model/customerManager.php";
            $customers = getcustomers();
            require "view/customers.php";
        }
        else{
            $customers = getcustomers();
            require "view/customers.php";
        }
    }
    else
    {
        require "view/customer-update.php";
    }
}
