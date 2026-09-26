<?php ob_start(); ?>
    <?php include_once 'showRead.php' ?>

    <!-- ==================== HEADER ==================== -->
    <div class="ac-header">
        <a href="javascript:history.back()" class="ac-header-back">
            <i class="fa fa-cubes"></i>
        </a>
        <div class="flex-grow-1" style="min-width: 0">
            <h1 class="ac-header-title">Produk</h1>
            <div class="ac-header-brand">Direkomendasikan oleh <?php echo $showAffiliateName ?></div>
        </div>
    </div>

    <?php if(!$hasProduct): ?>

        <!-- ==================== PRODUK TIDAK DITEMUKAN ==================== -->
        <div class="ac-wrapper">
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-empty">
                        <i class="fa fa-search-minus"></i>
                        <div class="font-weight-bold" style="color: #495057">Produk tidak ditemukan</div>
                        <div class="mt-2" style="font-size: 13px">Link afiliasi yang Anda buka sudah tidak berlaku atau produk sudah tidak dijual.</div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <!-- ==================== DETAIL PRODUK ==================== -->
        <div class="ac-wrapper">

            <?php if($showStock < 1): ?>
                <div class="ac-alert ac-alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> Stok produk sedang habis. Silakan hubungi penjual.
                </div>
            <?php endif; ?>

            <div class="ac-card">
                <div class="ac-product-image">
                    <img src="<?php echo $showImage ?>" alt="<?php echo $showName ?>">
                </div>
                <div class="ac-card-body">
                    <h2 class="ac-product-name"><?php echo $showName ?></h2>
                    <div class="ac-product-sku">
                        <?php if(strlen(trim($showSku)) > 0): ?>SKU : <?php echo $showSku ?> &nbsp;|&nbsp; <?php endif; ?>
                        <?php echo $showCategoryName ?>
                    </div>

                    <div class="d-flex align-items-center flex-wrap mb-2">
                        <span class="ac-price-now">Rp <?php echo number_format($showPriceNow, 0, ',', '.') ?></span>
                    </div>

                    <div class="mb-1">
                        <?php if($showStock > 0): ?>
                            <span class="ac-badge ac-badge-success"><i class="fa fa-check"></i> Stok tersedia (<?php echo number_format($showStock, 0, ',', '.') ?>)</span>
                        <?php else: ?>
                            <span class="ac-badge ac-badge-danger"><i class="fa fa-times"></i> Stok habis</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-info-circle"></i> Deskripsi Produk</div>
                     <div class="ac-info-row"> 
                        <?php echo $showDescription ?>
                    </div>
                </div>
            </div>

            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-user-circle"></i> Penjual / Referral</div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Nama Affiliate</div>
                        <div class="ac-info-value"><?php echo $showAffiliateName ?></div>
                    </div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Kode Referral</div>
                        <div class="ac-info-value"><?php echo $dataProduct['affiliate_username'] ?></div>
                    </div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Kota</div>
                        <div class="ac-info-value"><?php echo $showAffiliateCity ?></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== STICKY BOTTOM ACTION ==================== -->
        <div class="ac-bottom-bar">
            <div class="ac-bottom-bar-inner">
                <div class="ac-bottom-total">
                    <div class="ac-bottom-total-label">Harga</div>
                    <div class="ac-bottom-total-value">Rp <?php echo number_format($showPriceNow, 0, ',', '.') ?></div>
                </div>
                <div class="ac-bottom-action">
                    <?php if($showStock > 0): ?>
                        <a href="<?php echo $showUrlOrder ?>" class="ac-btn ac-btn-success">
                            <i class="fa fa-shopping-cart"></i> &nbsp;Beli Sekarang
                        </a>
                    <?php else: ?>
                        <button type="button" class="ac-btn ac-btn-outline" disabled style="color:#9aa0a6; border-color:#dfe2e6">Stok Habis</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php $globalPageTitle = $hasProduct ? $showName.' - SBiZ Affiliate' : 'Produk Tidak Ditemukan - SBiZ Affiliate' ?>
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        // Halaman detail produk affiliate tidak memerlukan interaksi khusus.
    });
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/public.php' ?>
