<?php ob_start(); ?>
    <?php include_once 'orderRead.php' ?>

    <!-- ==================== HEADER ==================== -->
    <div class="ac-header">
        <a href="<?php echo $orderUrlBack ?>" class="ac-header-back">
            <i class="fa fa-arrow-left"></i>
        </a>
        <div class="flex-grow-1" style="min-width: 0">
            <h1 class="ac-header-title">Form Pemesanan</h1>
            <div class="ac-header-brand">Lengkapi data pengiriman</div>
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

        <form action="<?php echo $orderUrlSave ?>" method="post" id="orderForm">
        <input type="hidden" name="affiliateUsername" value="<?php echo $affiliateUsername ?>">
        <input type="hidden" name="affiliateProductId" value="<?php echo $affiliateProductId ?>">
        <input type="hidden" name="stuffId" value="<?php echo $orderStuffId ?>">
        <input type="hidden" name="affiliateId" value="<?php echo $orderAffiliateId ?>">
        <input type="hidden" name="price" value="<?php echo $orderPriceNow ?>">
        <input type="hidden" name="priceBasic" value="<?php echo $orderPriceBasic ?>">
        <input type="hidden" name="feeAffiliateNominal" value="<?php echo $dataProduct['fee_affiliate_nominal'] ?>">
        <input type="hidden" name="feeAffiliatePercent" value="<?php echo $dataProduct['fee_affiliate_percent'] ?>">
        <input type="hidden" name="affiliatePoint" value="<?php echo $dataProduct['point'] ?>">
        <input type="hidden" name="feeSales" value="<?php echo $dataProduct['fee_sales'] ?>">
        <input type="hidden" name="expeditionId" value="<?php echo $orderExpeditionId ?>">

        <!-- data wilayah terpilih (hasil lookup AJAX) -->
        <input type="hidden" name="districtId" id="orderDistrictId" value="<?php echo $orderInputDistrictId ?>">
        <input type="hidden" name="districtName" id="orderDistrictName" value="<?php echo $orderInputDistrictName ?>">
        <input type="hidden" name="city" id="orderCity" value="<?php echo $orderInputCity ?>">
        <input type="hidden" name="province" id="orderProvince" value="<?php echo $orderInputProvince ?>">
        <input type="hidden" name="postalCode" id="orderPostalCode" value="<?php echo $orderInputPostalCode ?>">

        <div class="ac-wrapper">

            <?php if(isset($msgError) && count($msgError) > 0): ?>
                <div class="ac-alert ac-alert-danger">
                    <i class="fa fa-exclamation-circle"></i> Terdapat <b><?php echo count($msgError) ?></b> data yang perlu diperbaiki. Silakan periksa kembali.,
                    <?php if(isset($msgError['general'])): ?><?php echo $msgError['general'] ?><?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($orderStock < 1): ?>
                <div class="ac-alert ac-alert-warning">
                    <i class="fa fa-exclamation-triangle"></i> Stok produk sedang habis. Silakan hubungi penjual.
                </div>
            <?php endif; ?>

            <!-- ==================== RINGKASAN PRODUK ==================== -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-cubes"></i> Produk</div>
                    <div class="d-flex mb-2">
                        <div style="flex: 0 0 76px; margin-right: 12px">
                            <img src="<?php echo $orderImage ?>" alt="<?php echo $orderName ?>" style="width: 76px; height: 76px; object-fit: contain; border-radius: 8px; border: 1px solid #f0f1f3">
                        </div>
                        <div style="flex: 1; min-width: 0">
                            <div class="ac-product-name" style="font-size: 14px; margin-bottom: 4px"><?php echo $orderName ?></div>
                            <div class="ac-text-muted-sm">
                                <?php if(strlen(trim($orderSku)) > 0): ?>SKU : <?php echo $orderSku ?> &nbsp;|&nbsp; <?php endif; ?>
                                <?php echo $orderCategoryName ?>
                            </div>
                            <div class="ac-price-now" style="font-size: 16px">Rp <?php echo number_format($orderPriceNow, 0, ',', '.') ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== DATA PEMBELI ==================== -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-user"></i> Data Penerima</div>

                    <div class="ac-form-group">
                        <label>Nama Penerima <span style="color:#d32f2f">*</span></label>
                        <input type="text" name="name" class="ac-form-control" placeholder="Nama lengkap penerima" value="<?php echo $orderInputName ?>" required>
                        <?php if(isset($msgError['name'])): ?><div class="ac-form-error"><?php echo $msgError['name'] ?></div><?php endif; ?>
                    </div>

                    <div class="ac-form-group">
                        <label>No. Telepon / WhatsApp <span style="color:#d32f2f">*</span></label>
                        <input type="tel" name="phone" class="ac-form-control" placeholder="Contoh : 628123456789" value="<?php echo $orderInputPhone ?>" inputmode="tel" required>
                        <?php if(isset($msgError['phone'])): ?><div class="ac-form-error"><?php echo $msgError['phone'] ?></div><?php endif; ?>
                    </div>

                    <div class="ac-form-group">
                        <label>Alamat Pengiriman <span style="color:#d32f2f">*</span></label>
                        <textarea name="address" class="ac-form-control" placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan" required><?php echo $orderInputAddress ?></textarea>
                        <?php if(isset($msgError['address'])): ?><div class="ac-form-error"><?php echo $msgError['address'] ?></div><?php endif; ?>
                    </div>

                    <div class="ac-form-group mb-0">
                        <label>Kota / Kecamatan / Kode Pos <span style="color:#d32f2f">*</span></label>
                        <div class="ac-lookup-wrap">
                            <input type="text" id="orderRegionSearch" class="ac-form-control" placeholder="Ketik kota, kecamatan, atau kode pos" value="<?php echo $orderInputRegionLabel ?>" autocomplete="off" required>
                            <span class="ac-lookup-spinner" id="orderRegionSpinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>
                            <div class="ac-lookup-result" id="orderRegionResult" style="display:none"></div>
                        </div>
                        <div class="ac-text-muted-sm mt-1">Minimal 3 karakter. Pilih salah satu hasil untuk mengisi otomatis.</div>
                        <?php if(isset($msgError['region'])): ?><div class="ac-form-error"><?php echo $msgError['region'] ?></div><?php endif; ?>
                    </div>

                    <div id="orderRegionDetail" class="ac-region-box" style="<?php echo strlen($orderInputDistrictId) > 0 ? '' : 'display:none' ?>">
                        <div class="ac-info-row">
                            <div class="ac-info-label">Kode Pos</div>
                            <div class="ac-info-value" id="orderViewPostalCode"><?php echo $orderInputPostalCode ?></div>
                        </div>
                        <div class="ac-info-row">
                            <div class="ac-info-label">Provinsi</div>
                            <div class="ac-info-value" id="orderViewProvince"><?php echo $orderInputProvince ?></div>
                        </div>
                        <div class="ac-info-row">
                            <div class="ac-info-label">Kota / Kabupaten</div>
                            <div class="ac-info-value" id="orderViewCity"><?php echo $orderInputCity ?></div>
                        </div>
                        <div class="ac-info-row">
                            <div class="ac-info-label">Kecamatan</div>
                            <div class="ac-info-value" id="orderViewDistrict"><?php echo $orderInputDistrictName ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ==================== JUMLAH & PENGIRIMAN ==================== -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-shopping-basket"></i> Jumlah Beli</div>

                    <div class="ac-form-group mb-0">
                        <label>Jumlah Beli <span style="color:#d32f2f">*</span></label>
                        <div class="ac-qty">
                            <button type="button" onclick="orderQtyStep(-1)">−</button>
                            <input type="number" name="amount" id="orderAmount" value="<?php echo $orderInputAmount ?>" min="1" max="<?php echo $orderStock > 0 ? $orderStock : 999 ?>" inputmode="numeric" readonly>
                            <button type="button" onclick="orderQtyStep(1)">+</button>
                        </div>
                        <div class="ac-text-muted-sm mt-1">
                            Maksimal <?php echo number_format($orderStock, 0, ',', '.') ?> pcs sesuai stok tersedia
                        </div>
                        <?php if(isset($msgError['amount'])): ?><div class="ac-form-error"><?php echo $msgError['amount'] ?></div><?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ==================== CATATAN ==================== -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-comment"></i> Catatan (Opsional)</div>
                    <div class="ac-form-group mb-0">
                        <textarea name="note" class="ac-form-control" placeholder="Catatan tambahan untuk penjual, misal warna atau ukuran" style="min-height:70px"><?php echo $orderInputNote ?></textarea>
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== STICKY BOTTOM ACTION ==================== -->
        <div class="ac-bottom-bar">
            <div class="ac-bottom-bar-inner">
                <div class="ac-bottom-total">
                    <div class="ac-bottom-total-label">Total Pembayaran</div>
                    <div class="ac-bottom-total-value" id="orderTotalText">Rp <?php echo number_format($orderPriceNow * $orderInputAmount, 0, ',', '.') ?></div>
                </div>
                <div class="ac-bottom-action">
                    <?php if($orderStock > 0): ?>
                        <button type="submit" class="ac-btn ac-btn-success">
                            <i class="fa fa-check"></i> &nbsp;Pesan Sekarang
                        </button>
                    <?php else: ?>
                        <button type="button" class="ac-btn ac-btn-outline" disabled style="color:#9aa0a6; border-color:#dfe2e6">Stok Habis</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        </form>

    <?php endif; ?>

<?php $globalPageTitle = $hasProduct ? 'Pesan '.$orderName.' - SBiZ Affiliate' : 'Produk Tidak Ditemukan - SBiZ Affiliate' ?>
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    var orderPrice = <?php echo (double)$orderPriceNow ?>;
    var orderMaxAmount = <?php echo $orderStock > 0 ? $orderStock : 999 ?>;
    var orderLookupUrl = '<?php echo $orderUrlLookup ?>';
    var orderLookupTimer = null;
    var orderRegionSelected = <?php echo strlen($orderInputDistrictId) > 0 ? 'true' : 'false' ?>;

    function orderFormatRupiah(p) {
        var s = Math.round(p).toString();
        var r = '';
        while(s.length > 3) {
            r = '.' + s.substr(s.length - 3) + r;
            s = s.substr(0, s.length - 3);
        }
        return 'Rp ' + s + r;
    }

    function orderUpdateTotal() {
        var el = document.getElementById('orderAmount');
        var totalEl = document.getElementById('orderTotalText');
        if(!el || !totalEl) return;
        var amount = parseInt(el.value, 10);
        if(isNaN(amount) || amount < 1) { amount = 1; el.value = amount; }
        totalEl.innerHTML = orderFormatRupiah(orderPrice * amount);
    }

    function orderQtyStep(step) {
        var el = document.getElementById('orderAmount');
        if(!el) return;
        var amount = parseInt(el.value, 10);
        if(isNaN(amount)) { amount = 1; }
        amount = amount + step;
        if(amount < 1) { amount = 1; }
        if(amount > orderMaxAmount) { amount = orderMaxAmount; }
        el.value = amount;
        orderUpdateTotal();
    }

    // ---------------- Lookup wilayah via AJAX ----------------
    function orderLookupHide() {
        $('#orderRegionResult').hide().html('');
        $('#orderRegionSpinner').hide();
    }

    function orderLookupRender(rows) {
        var html = '';
        if(rows.length < 1) {
            html = '<div class="ac-lookup-info">Wilayah tidak ditemukan</div>';
        } else {
            for(var i = 0; i < rows.length; i++) {
                var r = rows[i];
                html += '<div class="ac-lookup-item" '
                     +  'data-id="' + r.id + '" '
                     +  'data-postal="' + r.postalCode + '" '
                     +  'data-district="' + r.district + '" '
                     +  'data-city="' + r.city + '" '
                     +  'data-province="' + r.province + '" '
                     +  'data-label="' + r.label + '">'
                     +  '<div class="ac-lookup-item-main">' + r.postalCode + ' &middot; ' + r.district + '</div>'
                     +  '<div class="ac-lookup-item-sub">' + r.city + ', ' + r.province + '</div>'
                     +  '</div>';
            }
        }
        $('#orderRegionResult').html(html).show();
    }

    function orderLookupSearch() {
        var keyword = $.trim($('#orderRegionSearch').val());
        if(keyword.length < 3) {
            orderLookupHide();
            return;
        }
        $('#orderRegionSpinner').show();
        $.ajax({
            url: orderLookupUrl,
            type: 'GET',
            dataType: 'json',
            data: { keyword: keyword },
            success: function(res) {
                $('#orderRegionSpinner').hide();
                orderLookupRender(res && res.data ? res.data : []);
            },
            error: function() {
                $('#orderRegionSpinner').hide();
                $('#orderRegionResult').html('<div class="ac-lookup-info">Gagal mengambil data wilayah</div>').show();
            }
        });
    }

    function orderRegionApply(el) {
        $('#orderDistrictId').val($(el).attr('data-id'));
        $('#orderDistrictName').val($(el).attr('data-district'));
        $('#orderCity').val($(el).attr('data-city'));
        $('#orderProvince').val($(el).attr('data-province'));
        $('#orderPostalCode').val($(el).attr('data-postal'));

        $('#orderViewPostalCode').text($(el).attr('data-postal'));
        $('#orderViewProvince').text($(el).attr('data-province'));
        $('#orderViewCity').text($(el).attr('data-city'));
        $('#orderViewDistrict').text($(el).attr('data-district'));

        $('#orderRegionSearch').val($(el).attr('data-label'));
        $('#orderRegionDetail').show();
        orderRegionSelected = true;
        orderLookupHide();
    }

    $(document).ready(function() {
        // pencarian dengan jeda (debounce) agar ramah koneksi mobile
        $('#orderRegionSearch').on('input', function() {
            orderRegionSelected = false;
            clearTimeout(orderLookupTimer);
            orderLookupTimer = setTimeout(orderLookupSearch, 350);
        });

        $('#orderRegionSearch').on('focus', function() {
            if($.trim($(this).val()).length >= 3 && !orderRegionSelected) {
                orderLookupSearch();
            }
        });

        $(document).on('click', '.ac-lookup-item', function() {
            orderRegionApply(this);
        });

        // tutup daftar hasil bila klik di luar area lookup
        $(document).on('click', function(e) {
            if(!$(e.target).closest('.ac-lookup-wrap').length) {
                orderLookupHide();
            }
        });

        // validasi: wilayah wajib dipilih dari hasil lookup
        $('#orderForm').on('submit', function() {
            if(<?php echo $orderStock ?> < 1) {
                return false;
            }
            if(!orderRegionSelected || $.trim($('#orderDistrictId').val()).length < 1) {
                alert('Silakan pilih kota / kecamatan dari daftar hasil pencarian.');
                $('#orderRegionSearch').focus();
                return false;
            }
            return true;
        });

        orderUpdateTotal();
    });
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/public.php' ?>
