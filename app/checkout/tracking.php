<?php ob_start(); ?>
    <?php include_once 'trackingRead.php' ?>

    <!-- ==================== HEADER ==================== -->
    <div class="ac-header">
        <?php if($hasOrder && !empty($dataOrder['affiliate_username'])): ?>
            <a href="<?php echo $globalUrl . $dataOrder['affiliate_username'] ?>" class="ac-header-back" title="Kembali ke Toko">
                <i class="fa fa-arrow-left"></i>
            </a>
        <?php else: ?>
            <a href="javascript:history.back()" class="ac-header-back">
                <i class="fa fa-arrow-left"></i>
            </a>
        <?php endif; ?>
        <div class="flex-grow-1" style="min-width: 0">
            <h1 class="ac-header-title">Lacak Pesanan</h1>
            <div class="ac-header-brand"><?php echo !empty($companyName) ? htmlspecialchars($companyName) : 'SBiZ Affiliate' ?></div>
        </div>
    </div>

    <?php if(!$hasOrder): ?>

        <!-- ==================== FORM CARI PESANAN / TIDAK DITEMUKAN ==================== -->
        <div class="ac-wrapper">
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-search"></i> Cari Pesanan Anda</div>
                    <p style="font-size: 13px; color: #6c757d; margin-top: -6px; margin-bottom: 16px;">
                        Masukkan nomor order yang Anda dapatkan saat checkout untuk melacak status pesanan Anda.
                    </p>
                    <form method="GET" action="<?php echo $globalUrl; ?>checkout/tracking">
                        <div class="ac-form-group">
                            <label class="ac-label">Nomor Order</label>
                            <input type="text" name="noOrder" class="ac-input" placeholder="Contoh: 26000008" value="<?php echo htmlspecialchars($orderParam); ?>" required>
                        </div>
                        <button type="submit" class="ac-btn ac-btn-primary" style="width: 100%;">
                            <i class="fa fa-search"></i> &nbsp;Lacak Sekarang
                        </button>
                    </form>
                    <?php if(strlen($orderParam) > 0): ?>
                        <div class="alert alert-warning mt-3 mb-0" style="font-size: 13px; border-radius: 8px;">
                            <i class="fa fa-exclamation-triangle"></i> Pesanan dengan nomor <b><?php echo htmlspecialchars($orderParam); ?></b> tidak ditemukan. Mohon periksa kembali.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php else: ?>

        <?php
            // Hitung active step index:
            // 0: Menunggu Pembayaran (status_order = 4)
            // 1: Pembayaran Diverifikasi / Diproses (status_order = 0 atau 1)
            // 2: Sedang Dikirim (status_order = 2)
            // 3: Selesai (status_order = 3)
            $st = $dataOrder['status_order'];
            $stepIndex = 0;
            if($st == '4') {
                $stepIndex = 0;
            } elseif($st == '0' || $st == '1') {
                $stepIndex = 1;
            } elseif($st == '2') {
                $stepIndex = 2;
            } elseif($st == '3') {
                $stepIndex = 3;
            }
        ?>

        <div class="ac-wrapper">

            <!-- Card Status Header -->
            <div class="ac-card">
                <div class="ac-card-body" style="padding: 16px;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="font-weight-bold" style="font-size: 14px; color: #495057;">
                            No. Order #<?php echo htmlspecialchars($dataOrder['no_order']); ?>
                        </span>
                        <?php echo getTrackingStatusBadge($dataOrder['status_order'], $dataOrder['status_payment']); ?>
                    </div>
                    <div style="font-size: 12px; color: #6c757d;">
                        <i class="fa fa-calendar-alt"></i> Tanggal Order: <?php echo htmlspecialchars($dataOrder['date_order']); ?>
                    </div>
                </div>
            </div>

            <!-- Card Progress Milestones -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-tasks"></i> Progres Pesanan</div>

                    <div class="ac-step-milestones">
                        <!-- Step 1: Pesanan Dibuat -->
                        <div class="ac-milestone-item <?php echo $stepIndex >= 0 ? ($stepIndex == 0 ? 'current' : 'completed') : ''; ?>">
                            <div class="ac-milestone-dot"><i class="fa <?php echo $stepIndex > 0 ? 'fa-check' : 'fa-receipt'; ?>"></i></div>
                            <div class="ac-milestone-title">Order Dibuat</div>
                        </div>

                        <!-- Step 2: Diproses / Dikemas -->
                        <div class="ac-milestone-item <?php echo $stepIndex >= 1 ? ($stepIndex == 1 ? 'current' : 'completed') : ''; ?>">
                            <div class="ac-milestone-dot"><i class="fa <?php echo $stepIndex > 1 ? 'fa-check' : 'fa-box'; ?>"></i></div>
                            <div class="ac-milestone-title">Proses Pengemasan</div>
                        </div>

                        <!-- Step 3: Proses untuk Dikirim -->
                        <div class="ac-milestone-item <?php echo $stepIndex >= 2 ? ($stepIndex == 2 ? 'current' : 'completed') : ''; ?>">
                            <div class="ac-milestone-dot"><i class="fa <?php echo $stepIndex > 2 ? 'fa-check' : 'fa-truck'; ?>"></i></div>
                            <div class="ac-milestone-title">Proses Pengiriman</div>
                        </div>

                        <!-- Step 4: Sudah dikirim ke ekspedisi -->
                        <div class="ac-milestone-item <?php echo $stepIndex >= 3 ? 'completed' : ''; ?>">
                            <div class="ac-milestone-dot"><i class="fa fa-check-circle"></i></div>
                            <div class="ac-milestone-title">Paket di Ekspedisi</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Informasi Ekspedisi & Resi -->
            <?php if(!empty($dataOrder['no_resi']) || !empty($dataOrder['expedition_name'])): ?>
                <div class="ac-card" style="border-left: 4px solid #198754;">
                    <div class="ac-card-body">
                        <div class="ac-card-title" style="color: #198754;"><i class="fa fa-truck"></i> Informasi Pengiriman</div>
                        
                        <div class="ac-info-row">
                            <div class="ac-info-label">Ekspedisi / Kurir</div>
                            <div class="ac-info-value font-weight-bold"><?php echo htmlspecialchars($dataOrder['expedition_name'] ? $dataOrder['expedition_name'] : '-'); ?></div>
                        </div>

                        <div class="ac-info-row">
                            <div class="ac-info-label">Nomor Resi</div>
                            <div class="ac-info-value d-flex align-items-center justify-content-end" style="gap: 6px;">
                                <?php if(!empty($dataOrder['no_resi'])): ?>
                                    <span class="font-weight-bold" style="font-size: 14px; letter-spacing: 0.5px;"><?php echo htmlspecialchars($dataOrder['no_resi']); ?></span>
                                    <button type="button" class="ac-copy-btn" onclick="copyTrackingText('<?php echo htmlspecialchars($dataOrder['no_resi']); ?>', this)">
                                        <i class="fa fa-copy"></i> Salin
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted" style="font-style: italic;">Resi sedang disiapkan</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if(!empty($dataOrder['date_shipping'])): ?>
                            <div class="ac-info-row">
                                <div class="ac-info-label">Waktu Pengiriman</div>
                                <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['date_shipping']); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Card Riwayat Timeline Status -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-history"></i> Riwayat Status</div>
                    
                    <ul class="ac-timeline">
                        <?php if($st == '3'): ?>
                            <li class="is-active">
                                <div class="ac-tl-title">Pesanan Dalam Pengiriman</div>
                                <div class="ac-tl-desc">Paket Sudah diserahkan ke Ekspedisi</div>
                                <div class="ac-tl-desc">
                                    Paket telah diserahkan ke pihak kurir ekspedisi<?php echo !empty($dataOrder['expedition_name']) ? ' (' . htmlspecialchars($dataOrder['expedition_name']) . ')' : ''; ?>.
                                </div>
                                <?php if(!empty($dataOrder['date_shipping'])): ?>
                                    <div class="ac-tl-time"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($dataOrder['date_shipping']); ?></div>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php if($st == '2' || $st == '3'): ?>
                            <li class="<?php echo $st == '2' ? 'is-active' : ''; ?>">
                                <div class="ac-tl-title">Proses Pengiriman</div>
                                <div class="ac-tl-desc">
                                    Paket disiapkan untuk diberikan ke ekspedisi
                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if($st == '1' || $st == '2' || $st == '3'): ?>
                            <li class="<?php echo $st == '1' ? 'is-active' : ''; ?>">
                                <div class="ac-tl-title">Pesanan Dikemas (Packing)</div>
                                <div class="ac-tl-desc">Pesanan Anda sedang dipersiapkan dan dikemas oleh tim gudang kami.</div>
                                <?php if(!empty($dataOrder['date_packing'])): ?>
                                    <div class="ac-tl-time"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($dataOrder['date_packing']); ?></div>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <?php if($st == '0' || $st == '1' || $st == '2' || $st == '3' || ($st == '4' && $dataOrder['status_payment'] == '1')): ?>
                            <li class="<?php echo ($st == '0' || ($st == '4' && $dataOrder['status_payment'] == '1')) ? 'is-active' : ''; ?>">
                                <div class="ac-tl-title">Pembayaran Diterima / Menunggu Konfirmasi</div>
                                <div class="ac-tl-desc">Bukti pembayaran telah masuk ke sistem dan dalam tahap validasi admin.</div>
                                <?php if(!empty($dataOrder['date_payment'])): ?>
                                    <div class="ac-tl-time"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($dataOrder['date_payment']); ?></div>
                                <?php endif; ?>
                            </li>
                        <?php endif; ?>

                        <li class="<?php echo ($st == '4' && $dataOrder['status_payment'] != '1') ? 'is-active' : ''; ?>">
                            <div class="ac-tl-title">Pesanan Berhasil Dibuat</div>
                            <div class="ac-tl-desc">Menunggu penyelesaian pembayaran dari pembeli.</div>
                            <?php if(!empty($dataOrder['date_order'])): ?>
                                <div class="ac-tl-time"><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($dataOrder['date_order']); ?></div>
                            <?php endif; ?>
                        </li>
                    </ul>

                    <?php if($st == '4'): ?>
                        <div class="mt-3 text-center">
                            <a href="<?php echo $urlConfirmation; ?>" class="ac-btn ac-btn-warning" style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none; width: 100%;">
                                <i class="fa fa-credit-card"></i>
                                <span>Bayar / Konfirmasi Pembayaran Sekarang</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card Rincian Produk & Pengiriman -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-shopping-basket"></i> Produk yang Dipesan</div>

                    <?php if(count($dataItems) > 0): ?>
                        <div class="mb-3">
                            <?php foreach($dataItems as $item): ?>
                                <div class="ac-info-row">
                                    <div style="flex: 1; padding-right: 12px;">
                                        <div style="font-weight: 600; color: #212529; font-size: 13.5px;"><?php echo htmlspecialchars($item['name']); ?></div>
                                        <div style="font-size: 12px; color: #6c757d; margin-top: 2px;">
                                            <?php echo (int)$item['amount']; ?> barang &times; Rp <?php echo number_format((double)$item['price'], 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                    <div style="font-weight: 600; color: #212529; white-space: nowrap;">
                                        Rp <?php echo number_format((double)$item['price'] * (int)$item['amount'], 0, ',', '.'); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="ac-info-row">
                        <div class="ac-info-label">Penerima</div>
                        <div class="ac-info-value font-weight-bold"><?php echo htmlspecialchars($dataOrder['name']); ?> (<?php echo htmlspecialchars($dataOrder['phone']); ?>)</div>
                    </div>

                    <div class="ac-info-row">
                        <div class="ac-info-label">Alamat Pengiriman</div>
                        <div class="ac-info-value" style="max-width: 60%; text-align: right;">
                            <?php echo htmlspecialchars($dataOrder['address_shipping']); ?><br>
                            <small class="text-muted">
                                <?php 
                                    $regionParts = array_filter(array(
                                        $dataOrder['districts'],
                                        $dataOrder['city'],
                                        $dataOrder['province'],
                                        $dataOrder['postal_code']
                                    ));
                                    echo htmlspecialchars(implode(', ', $regionParts));
                                ?>
                            </small>
                        </div>
                    </div>

                    <div class="ac-info-row">
                        <div class="ac-info-label">Total Tagihan</div>
                        <div class="ac-info-value" style="font-size: 15px; font-weight: 700; color: #0d47a1;">
                            Rp <?php echo number_format((double)$dataOrder['amount_sale'], 0, ',', '.'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Salin Tautan / Link Halaman Tracking -->
            <div class="ac-card">
                <div class="ac-card-body" style="padding: 16px;">
                    <div style="font-size: 13px; font-weight: 600; color: #333; margin-bottom: 8px;">
                        <i class="fa fa-share-alt text-primary mr-1"></i> Bagikan atau Simpan Halaman Lacak Ini
                    </div>
                    <div style="font-size: 11px; color: #6c757d; margin-bottom: 12px;">
                        Salin tautan halaman ini untuk memantau status pesanan kapan saja tanpa harus memasukkan nomor order ulang.
                    </div>
                    
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" id="pageShareUrl" readonly value="<?php echo htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" class="form-control" style="font-size: 12px; background: #f8f9fa; color: #495057; border: 1px solid #ced4da; border-radius: 4px; padding: 6px 10px; height: auto; flex-grow: 1;" />
                        <button type="button" class="ac-copy-btn" onclick="copyTrackingText(document.getElementById('pageShareUrl').value, this)" style="white-space: nowrap; padding: 7px 12px; background: #e7f1ff; color: #0d47a1; border: 1px solid #b6d4fe; border-radius: 4px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s;">
                            <i class="fa fa-link"></i> Salin Link
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- ==================== STICKY BOTTOM ACTION ==================== -->
        <div class="ac-bottom-bar">
            <div class="ac-bottom-bar-inner">
                <div class="ac-bottom-total">
                    <div class="ac-bottom-total-label">No. Order</div>
                    <div class="ac-bottom-total-value" style="font-size: 15px;">#<?php echo htmlspecialchars($dataOrder['no_order']); ?></div>
                </div>
                <div class="ac-bottom-action">
                    <?php if($st == '4'): ?>
                        <a href="<?php echo $urlConfirmation; ?>" class="ac-btn ac-btn-warning" style="text-decoration: none;">
                            <i class="fa fa-credit-card"></i> &nbsp;Bayar Sekarang
                        </a>
                    <?php elseif(!empty($waUrl) && is_array($waUrl)): ?>
                        <div style="display: flex; gap: 6px; align-items: center;">
                            <select id="waSelectTarget" class="ac-btn" style="width: 220px; background: #fff; color: #333; border: 1px solid #ddd; cursor: pointer; padding: 6px 10px; font-size: 14px; height: auto;">
                                <option value="" disabled selected>-- Pilih CS WA --</option>
                                <?php foreach($waUrl as $index => $url): ?>
                                    <option value="<?php echo $url; ?>">CS WA <?php echo $index + 1; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <a href="#" id="btnWaKonfirmasi" target="_blank" rel="noopener noreferrer" class="ac-btn ac-btn-success" style="text-decoration: none; pointer-events: none; opacity: 0.5;">
                                <i class="fa fa-phone"></i> &nbsp;Hubungi
                            </a>
                        </div>

                        <!-- Script untuk mengaktifkan tombol Hubungi sesuai pilihan dropdown -->
                        <script>
                            document.getElementById('waSelectTarget').addEventListener('change', function() {
                                var selectedUrl = this.value;
                                var btn = document.getElementById('btnWaKonfirmasi');
                                if(selectedUrl) {
                                    btn.href = selectedUrl;
                                    btn.style.pointerEvents = 'auto';
                                    btn.style.opacity = '1';
                                } else {
                                    btn.href = '#';
                                    btn.style.pointerEvents = 'none';
                                    btn.style.opacity = '0.5';
                                }
                            });
                        </script>
                    <?php else: ?>
                        <a href="javascript:location.reload()" class="ac-btn ac-btn-outline" style="text-decoration: none;">
                            <i class="fa fa-refresh"></i> &nbsp;Segarkan
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php endif; ?>

<?php $globalPageTitle = ($hasOrder ? 'Lacak Pesanan #' . $dataOrder['no_order'] . ' - ' : 'Lacak Pesanan - ') . ($companyName ? $companyName : 'SBiZ Affiliate'); ?>
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    function copyTrackingText(text, btnEl) {
        if (!text) return;
        
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                showTrackingCopyFeedback(btnEl);
            }).catch(function() {
                fallbackTrackingCopy(text, btnEl);
            });
        } else {
            fallbackTrackingCopy(text, btnEl);
        }
    }

    function fallbackTrackingCopy(text, btnEl) {
        var tempInput = document.createElement('input');
        tempInput.style.position = 'fixed';
        tempInput.style.opacity = '0';
        tempInput.value = text;
        document.body.appendChild(tempInput);
        tempInput.focus();
        tempInput.select();
        try {
            var success = document.execCommand('copy');
            if (success) {
                showTrackingCopyFeedback(btnEl);
            } else {
                alert('Teks: ' + text);
            }
        } catch (err) {
            alert('Teks: ' + text);
        }
        document.body.removeChild(tempInput);
    }

    function showTrackingCopyFeedback(btnEl) {
        if (!btnEl) return;
        var originalHtml = $(btnEl).html();
        $(btnEl).addClass('copied').html('<i class="fa fa-check"></i> Tersalin!');
        setTimeout(function() {
            $(btnEl).removeClass('copied').html(originalHtml);
        }, 2000);
    }
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/public.php' ?>