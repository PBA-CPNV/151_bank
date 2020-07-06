<?php
/**
 * @file      agencies.php
 * @brief     This view is designed to display articles
 * @author    Created by Pascal.BENZONANA
 * @author    Updated by Nicolas.GLASSEY
 * @version   13-APR-2020
 */

$title = "SnowPoint . Articles";

ob_start();
$rows = 0; // Column count
?>
    <!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(view/content/images/home_slide_2.jpg);">
        <h2 class="l-text2 t-center">
            Nos snows
        </h2>
    </section>


    <!-- Content page -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">

                <!-- Product -->

                <div class="row">
                    <?php if (isset($articleErrorMessage)) : ?>
                        <h5><span style="color:red"><?= $articleErrorMessage; ?></span></h5>
                    <?php else : ?>
                        <?php foreach ($articles as $article) : ?>
                            <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                                <!-- Block2 -->
                                <div class="block2">


                                    <?php // test if page number exists to know if it's the first page
                                    if(!isset($_GET['page'])) : ?>

                                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                            <?php if(is_file($article['photo'])) : ?>
                                                <img src="<?= $article['photo']; ?>" alt="<?= $article['code']; ?>" alt="IMG-PRODUCT">
                                            <?php else : ?>
                                                <img src="view/content/images/no_image_snow_small.png" alt="no image" alt="IMG-PRODUCT">
                                            <?php endif; ?>

                                            <div class="block2-overlay trans-0-4">
                                                <a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                                    <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                                    <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                                </a>

                                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                                    <form action="index.php?action=cartAddItem" method="post" >
                                                        <!-- Button -->
                                                        <button type="submit" class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                            <input readonly type="hidden" type="text" name="inputUserArticleId" value="<?php echo $article['code']; ?>">
                                                            <input readonly type="hidden" type="text" name="inputUserQuantityToAdd" value="1">
                                                            Ajouter au panier
                                                            </a>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block2-txt p-t-20">
                                            <a href="index.php?action=displayArticleDetail&articleId=<?= $article['code']; ?>" class="block2-name dis-block s-text3 p-b-5">
                                                <strong><?= $article['brand']; ?> <?= $article['model']; ?></strong></a>
                                            <strong>Disponibilité : </strong><?= $article['qtyAvailable']; ?><br>

                                            <span class="block2-price m-text6 p-r-5">
										CHF <?= $article['price']; ?>.-
									</span>
                                        </div>
                                    <?php else: ?>
                                        <div class="block2-txt p-t-20">

                                            <a href="index.php?action=displayArticleDetail&code=<?= $article['code']; ?>" class="block2-name dis-block s-text3 p-b-5">
                                                <strong><?= $article['brand']; ?> <?= $article['model']; ?></strong></a>
                                            <strong>Disponibilité : </strong><?= $article['qtyAvailable']; ?><br>

                                            <span class="block2-price m-text6 p-r-5">
										CHF <?= $article['price']; ?>.-
									</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
                <!--</div>-->
            </div>
        </div>
    </section>


<?php
$content = ob_get_clean();
require 'gabarit.php';
?>