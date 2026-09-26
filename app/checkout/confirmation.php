<?php ob_start(); ?>
    <?php include_once 'confirmationRead.php' ?>

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
            <h1 class="ac-header-title">Konfirmasi Pembayaran</h1>
            <div class="ac-header-brand"><?php echo !empty($companyName) ? htmlspecialchars($companyName) : 'SBiZ Affiliate' ?></div>
        </div>
    </div>

    <?php if(!$hasOrder): ?>

        <!-- ==================== PESANAN TIDAK DITEMUKAN ==================== -->
        <div class="ac-wrapper">
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-empty">
                        <i class="fa fa-search-minus"></i>
                        <div class="font-weight-bold" style="color: #495057; font-size: 16px;">Pesanan Tidak Ditemukan</div>
                        <div class="mt-2 text-muted" style="font-size: 13px;">Nomor pesanan yang Anda cari tidak terdaftar atau link salah. Silakan periksa kembali tautan Anda.</div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>

        <div class="ac-wrapper">

            <!-- Card Status & Ucapan Terima Kasih -->
            <div class="ac-card">
                <div class="ac-card-body text-center" style="padding: 22px 16px 18px 16px;">
                    <div style="width: 58px; height: 58px; border-radius: 50%; background: #e7f1ff; color: #0d47a1; display: inline-flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 12px;">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <h2 style="font-size: 17px; font-weight: 700; color: #212529; margin-bottom: 4px;">Pesanan Anda Berhasil Dibuat!</h2>
                    <p style="font-size: 13px; color: #6c757d; margin-bottom: 12px;">
                        Silakan lakukan pembayaran sesuai total tagihan agar pesanan Anda dapat segera kami proses.
                    </p>
                    <div class="d-flex justify-content-center align-items-center flex-wrap" style="gap: 8px;">
                        <?php echo getStatusOrderBadge($dataOrder['status_order'], $dataOrder['status_payment']); ?>
                        <span class="ac-badge ac-badge-secondary">No. Order: #<?php echo htmlspecialchars($dataOrder['no_order']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Card Total Pembayaran -->
            <div class="ac-card" style="border-left: 4px solid #0d47a1;">
                <div class="ac-card-body">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span style="font-size: 12px; color: #6c757d; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Total Tagihan Pembayaran</span>
                        <button type="button" class="ac-copy-btn" onclick="copyText('<?php echo (int)$dataOrder['amount_sale']; ?>', this)">
                            <i class="fa fa-copy"></i> Salin Nominal
                        </button>
                    </div>
                    <div style="font-size: 24px; font-weight: 700; color: #0d47a1; letter-spacing: -0.5px;">
                        Rp <?php echo number_format((double)$dataOrder['amount_sale'], 0, ',', '.'); ?>
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 12px; line-height: 1.4;">
                        <i class="fa fa-info-circle text-primary"></i> Pastikan mentransfer tepat hingga digit terakhir agar mempermudah verifikasi.
                    </div>
                </div>
            </div>

            <!-- Card Rekening Tujuan Transfer -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-credit-card"></i> Rekening Tujuan Transfer</div>
                    <p style="font-size: 12.5px; color: #6c757d; margin-top: -6px; margin-bottom: 14px;">
                        Silakan transfer ke salah satu rekening resmi kami di bawah ini:
                    </p>

                    <?php if(count($dataBanks) > 0): ?>
                        <?php foreach($dataBanks as $bank): ?>
                            <?php 
                                $accNo = !empty($bank['account_number']) ? trim($bank['account_number']) : '';
                                $bankLabel = htmlspecialchars($bank['name']);
                            ?>
                            <div class="ac-bank-item">
                                <div class="ac-bank-name">
                                    <span><i class="fa fa-university text-primary" style="margin-right: 6px;"></i><?php echo $bankLabel; ?></span>
                                    <?php if(!empty($accNo)): ?>
                                        <button type="button" class="ac-copy-btn" onclick="copyText('<?php echo htmlspecialchars($accNo); ?>', this)">
                                            <i class="fa fa-copy"></i> Salin Rekening
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($accNo)): ?>
                                    <div class="ac-bank-account"><?php echo htmlspecialchars($accNo); ?></div>
                                <?php endif; ?>
                                <?php if(!empty($bank['description'])): ?>
                                    <div class="ac-bank-holder"><?php echo nl2br(htmlspecialchars($bank['description'])); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="ac-bank-item">
                            <div class="ac-bank-name">Rekening Belum Ditentukan</div>
                            <div class="ac-bank-holder">Silakan hubungi WhatsApp kami untuk informasi rekening transfer.</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card Petunjuk & Cara Konfirmasi -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-shield-alt"></i> Cara Konfirmasi Pembayaran</div>
                    
                    <div class="ac-accordion-header active" onclick="toggleAccordion(this)">
                        <span><i class="fa fa-whatsapp text-success" style="font-size: 15px; margin-right: 6px;"></i> Konfirmasi Cepat via WhatsApp</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="ac-accordion-body" style="display: block;">
                        <ol class="ac-steps">
                            <li>Lakukan transfer sesuai nominal tagihan <b>Rp <?php echo number_format((double)$dataOrder['amount_sale'], 0, ',', '.'); ?></b>.</li>
                            <li>Simpan atau <i>screenshot</i> bukti struk pembayaran / mutasi m-banking Anda.</li>
                            <li>Pilih salah satu nomor CS WhatsApp dan klik tombol <b>"Hubungi"</b> di bagian bawah.</li>
                            <li>Kirim pesan otomatis yang sudah disiapkan beserta lampiran foto bukti transfer.</li>
                            <li>Admin kami akan memvalidasi pesanan dan mengubah status menjadi diproses/dikirim.</li>
                        </ol>
                    </div>

                    <div class="ac-accordion-header" onclick="toggleAccordion(this)">
                        <span><i class="fa fa-info-circle text-primary" style="font-size: 14px; margin-right: 6px;"></i> Ketentuan & Batas Pembayaran</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <div class="ac-accordion-body">
                        <ul class="ac-steps" style="list-style-type: disc;">
                            <li>Pesanan akan diproses maksimal 1x24 jam setelah pembayaran berhasil diverifikasi.</li>
                            <li>Nomor resi pengiriman akan diperbarui secara otomatis dan dapat Anda lacak di halaman <b>Lacak Pesanan</b>.</li>
                            <li>Jika ada kendala pembayaran, silakan hubungi customer service kami melalui WhatsApp.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Card Ringkasan Pesanan & Alamat Pengiriman -->
            <div class="ac-card">
                <div class="ac-card-body">
                    <div class="ac-card-title"><i class="fa fa-list-alt"></i> Rincian Pesanan</div>

                    <!-- Item Produk -->
                    <?php if(count($dataItems) > 0): ?>
                        <div class="mb-3">
                            <?php foreach($dataItems as $item): ?>
                                <div class="ac-info-row">
                                    <div style="flex: 1; padding-right: 12px;">
                                        <div style="font-weight: 600; color: #212529;"><?php echo htmlspecialchars($item['name']); ?></div>
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
                        <div class="ac-info-label">Nomor Order</div>
                        <div class="ac-info-value font-weight-bold">#<?php echo htmlspecialchars($dataOrder['no_order']); ?></div>
                    </div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Tanggal Pemesanan</div>
                        <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['date_order']); ?></div>
                    </div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Nama Pembeli</div>
                        <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['name']); ?></div>
                    </div>
                    <div class="ac-info-row">
                        <div class="ac-info-label">Nomor HP / WhatsApp</div>
                        <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['phone']); ?></div>
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
                    <?php if(!empty($dataOrder['expedition_name'])): ?>
                        <div class="ac-info-row">
                            <div class="ac-info-label">Kurir Pengiriman</div>
                            <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['expedition_name']); ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($dataOrder['affiliate_name'])): ?>
                        <div class="ac-info-row">
                            <div class="ac-info-label">Affiliate Referral</div>
                            <div class="ac-info-value"><?php echo htmlspecialchars($dataOrder['affiliate_name']); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card Salin Tautan / Link Halaman & Navigasi Tracking -->
            <div class="ac-card">
                <div class="ac-card-body" style="padding: 16px;">
                    <div style="font-size: 13px; font-weight: 600; color: #333; margin-bottom: 8px;">
                        <i class="fa fa-share-alt text-primary mr-1"></i> Bagikan atau Simpan Halaman Ini
                    </div>
                    <div style="font-size: 12px; color: #6c757d; margin-bottom: 12px;">
                        Salin tautan halaman konfirmasi ini untuk memudahkan Anda mengaksesnya kembali nanti.
                    </div>
                    
                    <div style="display: flex; gap: 8px; align-items: center; margin-bottom: 14px;">
                        <input type="text" id="pageShareUrl" readonly value="<?php echo htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" class="form-control" style="font-size: 12px; background: #f8f9fa; color: #495057; border: 1px solid #ced4da; border-radius: 4px; padding: 6px 10px; height: auto; flex-grow: 1;" />
                        <button type="button" class="ac-copy-btn" onclick="copyText(document.getElementById('pageShareUrl').value, this)" style="white-space: nowrap; padding: 7px 12px; background: #e7f1ff; color: #0d47a1; border: 1px solid #b6d4fe; border-radius: 4px; font-weight: 600; font-size: 12px; cursor: pointer; transition: all 0.2s;">
                            <i class="fa fa-link"></i> Salin Link
                        </button>
                    </div>

                    <div style="border-top: 1px solid #eee; padding-top: 12px; margin-top: 4px;">
                        <div style="font-size: 13px; color: #6c757d; margin-bottom: 8px;">
                            Ingin memeriksa progres pengiriman barang pesanan Anda?
                        </div>
                        <a href="<?php echo $urlTracking; ?>" class="ac-btn ac-btn-outline" style="display: flex; align-items: center; justify-content: center; gap: 8px; text-decoration: none; width: 100%;">
                            <i class="fa fa-truck text-primary"></i>
                            <span>Lihat Status & Lacak Pesanan</span>
                            <i class="fa fa-chevron-right" style="font-size: 11px; margin-left: auto;"></i>
                        </a>
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
                    <!-- Bungkus select dan tombol agar sejajar rapi mengikuti style ac-bottom-action -->
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
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $globalPageTitle = ($hasOrder ? 'Konfirmasi Pesanan #' . $dataOrder['no_order'] . ' - ' : 'Konfirmasi Pembayaran - ') . ($companyName ? $companyName : 'SBiZ Affiliate'); ?>
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    function copyText(text, btnEl) {
        if (!text) return;
        
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                showCopyFeedback(btnEl);
            }).catch(function() {
                fallbackCopy(text, btnEl);
            });
        } else {
            fallbackCopy(text, btnEl);
        }
    }

    function fallbackCopy(text, btnEl) {
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
                showCopyFeedback(btnEl);
            } else {
                alert('Teks: ' + text);
            }
        } catch (err) {
            alert('Teks: ' + text);
        }
        document.body.removeChild(tempInput);
    }

    function showCopyFeedback(btnEl) {
        if (!btnEl) return;
        var originalHtml = $(btnEl).html();
        $(btnEl).addClass('copied').html('<i class="fa fa-check"></i> Tersalin!');
        setTimeout(function() {
            $(btnEl).removeClass('copied').html(originalHtml);
        }, 2000);
    }

    function toggleAccordion(headerEl) {
        var $header = $(headerEl);
        var $body = $header.next('.ac-accordion-body');
        if ($body.is(':visible')) {
            $body.slideUp(180);
            $header.removeClass('active');
        } else {
            $body.slideDown(180);
            $header.addClass('active');
        }
    }
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/public.php' ?>