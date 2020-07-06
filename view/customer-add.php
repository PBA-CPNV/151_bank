<?php
/**
 * @file      customer-add.php
 * @brief     This view is designed to display the login form
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY - PBA
 * @version   14-JUN-2020
 */

$title = 'Bank-point . Ajout de client';

ob_start();
?>

    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(view/content/images/banner_business.jpg);">
        <h2 class="l-text2 t-center">
            Ajout d'un client
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-60">
        <div class="container">
            <div class="row">

                <div class="col-md-12 p-b-30">
                    <?php if (isset($loginErrorMessage)) : ?>
                        <h5><span style="color:red"><?= $loginErrorMessage; ?></span></h5>
                    <?php endif ?>

                    <form class="leave-comment" action="index.php?action=addCustomer" method="post" >
                        <h4 class="m-text26 p-b-36 p-t-15">
                            Données de la nouvelle agence
                        </h4>

                        Nom : <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="inputCustomerName" placeholder="Nom">
                        </div>

                        Prénom : <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="inputCustomerSurname" placeholder="Prénom">
                        </div>

                        Ville : <div class="bo4 of-hidden size15 m-b-20">
                            <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="inputCustomerCity" placeholder="Ville">
                        </div>

                        </div class="md-12">
                            <input type="submit" value="Ajouter le client" class="flex-c-m size10 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php
$content = ob_get_clean();
require 'gabarit.php';
?>