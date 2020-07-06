<?php
/**
 * @file      cart.php
 * @brief     This view is designed to display a cart
 * @author    Updated by Nicolas.GLASSEY
 * @version   14-MAY-2020
 */

$title = "BankManager - Gestion des agences ";

ob_start();
?>


    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(view/content/images/banner_business.jpg);">
        <h2 class="l-text2 t-center">
            Gestion des agences
        </h2>
    </section>

    <!-- Content page -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">

                <!-- Agencie's List -->
                <section class="cart bgwhite p-t-70 p-b-100">
                    <div class="container">
                    <?php if((isset($_GET['code']))&&($_GET['action']=="updateAgency")) : ?>
                        <h5><span style="color:#008000">L'agence n°<?= $_GET['id']; ?> a bien été supprimée</span></h5>
                        <br>
                    <?php endif; ?>

                    <?php if((isset($_GET['code']))&&($_GET['action']=="removeAgency") && !isset($agencyErrorMessage)) : ?>
                        <h5><span style="color:#ffa037">L'agence n°<?= $_GET['id']; ?> a bien été supprimée</span></h5>
                        <br>
                    <?php endif; ?>


                     <?php if (isset($agencyErrorMessage)) : ?>
                        <h5><span style="color:#ff0000"><?= $agencyErrorMessage; ?></span></h5>
                    <?php else : ?>
                                         <!-- agencies List -->
                        <div class="container-table-cart pos-relative">
                            <div class="wrap-table-shopping-cart bgwhite">
                                <table id="cart" class="table-shopping-cart">
                                    <tr class="table-head">
                                        <th class="column-1">ID</th>
                                        <th class="column-2">Nom de l'agence</th>
                                        <th class="column-2">Ville</th>
                                        <th class="column-2">Active</th>
                                        <th class="column-2"><a href="index.php?action=addAgency">Ajouter</a></th>
                                    </tr>
                                <?php foreach ($agencies as $agency) : ?>

                                    <tr id="B101" class="table-row">
                                        <td class="column-1"><?=$agency['id'];?></td>
                                        <td class="column-2"><?=$agency['name']; ?></td>
                                        <td class="column-2"><?=$agency['city']; ?></td>
                                        <td class="column-2"><?=$agency['active']; ?></td>

                                        <td class="column-2">
                                            <a href="index.php?action=removeAgency&id=<?=$agency['id'];?>" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                                <img src="view/content/images/icons/bin2.png" alt="delete">
                                            </button></a><br>
                                            <a href="index.php?action=updateAgency&id=<?=$agency['id'];?>">
                                             <button onclick="updateItem('<?=$agency['id']; ?>')" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                                 <img src="view/content/images/icons/pencil2.png" alt="update">
                                             </button></a>
                                        </td>
                                    </tr>
                                        <!-- End of list item -->
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>

                           <?php endif; ?>
                </section>
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
require 'gabarit.php';
?>