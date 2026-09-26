<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <!-- TAMBAHAN CSS UNTUK RESPONSIVE MOBILE -->
    <style>
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        /* Memaksa teks/link panjang untuk turun ke baris baru agar tidak merusak tabel */
        .wrap-link {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal;
            min-width: 150px;
        }
        /* Penyesuaian tombol untuk mobile */
        .btn-action-mobile {
            margin-top: 5px;
            white-space: nowrap;
        }
    </style>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                        
                        <h4 class="font-weight-bold py-3 mb-0">Product</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item">Product</li>
                            </ol>
                        </div>                               
                  </div>
            </div>      

            <?php if(isset($_GET['msg'])): ?>   
                <?php if($_GET['msg'] == 'addSuccess'): ?>   
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil disimpan
                    </div>   
                <?php endif; ?>   
                <?php if($_GET['msg'] == 'editSuccess'): ?>   
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil simpan
                    </div>   
                <?php endif; ?>   
                <?php if($_GET['msg'] == 'deleteSuccess'): ?>   
                    <div class="alert alert-dark-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Data berhasil dihapus
                    </div>   
                <?php endif; ?>                                    
            <?php endif; ?>

            <?php if(mysqli_num_rows($data) < 1) : ?>
                    <div class="alert alert-dark-warning alert-dismissible fade show">
                        Belum ada data 
                    </div>   
            <?php else: ?>   
                <div class="card">
                    <div class="card-datatable table-responsive" style="padding: 20px 10px 10px 10px">
                    <table id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th width="20%" style="text-align: center"><b>PRODUK</b></th>
                                <!--
                                <th width="10%" style="text-align: center"><b>KOMISI PERSEN</b></th>
                                -->
                                <th width="10%" style="text-align: center"><b>KOMISI NOMINAL</b></th>
                                <th width="10%" style="text-align: center"><b>POIN</b></th>
                                <th width="25%" style="text-align: center"><b>LINK REFERRAL</b></th>  
                                <th width="" style="text-align: center"><b>LINK BROSUR PRODUK</b></th>                               
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                     <td>
                                        <?php echo $i ?>                 
                                    </td> 
                                    <td>
                                        <?php echo $val['name'] ?>                 
                                    </td> 
                                    <!--
                                    <td align="center">            
                                        <?php echo $val['fee_affiliate_percent'] ?>
                                    </td>   
                                    -->                                            
                                    <td align="center">            
                                        <?php echo number_format($val['fee_affiliate_nominal']) ?>
                                    </td>
                                    <td align="center">            
                                        <?php echo $val['point'] ?>
                                    </td>                                  
                                    <td align="center" class="wrap-link">          
                                        <?php $linkUrlLinkRefferal = $affiliateSetting.'/'.$val['username'].'/'.$val['affiliate_stuff_id'] ?>   
                                        <a href="<?php echo $linkUrlLinkRefferal ?>" target="_blank">
                                            <?php echo $linkUrlLinkRefferal ?>
                                        </a>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-action-mobile" onclick="copyToClipboard('<?php echo $linkUrlLinkRefferal ?>')">
                                            <i class="fa fa-copy"></i> Copy
                                        </button>
                                    </td>
                                    <td align="center" class="wrap-link">       
                                        <?php $link_product_brosur = $val['link_product_brosur'] ?>
                                        <!-- PERBAIKAN: ditambah perintah echo pada href -->
                                        <a href="<?php echo $link_product_brosur ?>" target="_blank">
                                            <?php echo $link_product_brosur ?> 
                                        </a>  
                                        <br>
                                         <button type="button" class="btn btn-sm btn-outline-primary btn-action-mobile" onclick="copyToClipboard('<?php echo $link_product_brosur ?>')">
                                            <i class="fa fa-copy"></i> Copy
                                        </button>                                        
                                    </td>                                  
                                </tr>
                            <?php $i++ ?>   
                            <?php endwhile; ?>                          
                        </tbody>
                    </table>
                    </div>
                </div>
            <?php endif; ?>   
        </div>   
    </div>     

   
<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            scrollX: true, // PERBAIKAN: Tambahkan ini agar tabel bisa di-scroll horizontal di HP
            lengthMenu: [
                [ 50, 100, 200, -1 ],
                [ '50 Data', '100 Data', '200 Data', 'Tampilkan Semua' ]
            ], 
        });
    });  

    function deleteConfirm(p) {
      bootbox.confirm({
        message: 'Anda yakin akan menghapus ?',
        className: 'bootbox-xs',
        callback: function(result) {
            if(result) {
                window.location='<?php echo $globalUrl ?>employee/delete?id='+p;
            }   
        },
      });
    }          

    function copyToClipboard(text) {
        // Cek apakah browser mendukung Clipboard API yang modern dan berjalan di HTTPS (Secure Context)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(function() {
                alert("Tautan berhasil disalin:\n" + text);
            }).catch(function(err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            });
        } else {
            // Fallback (Cadangan) menggunakan cara lama untuk browser lama / HTTP
            var tempInput = document.createElement("input");
            tempInput.style.position = "absolute";
            tempInput.style.left = "-1000px";
            tempInput.style.top = "-1000px";
            tempInput.value = text;
            
            document.body.appendChild(tempInput);
            tempInput.select();
            
            try {
                document.execCommand("copy");
                alert("Tautan berhasil disalin:\n" + text);
            } catch (err) {
                console.error("Gagal menyalin: ", err);
                alert("Gagal menyalin tautan.");
            }
            
            document.body.removeChild(tempInput);
        }
    }
    
    // FUNGSI COPYTOCLIPBOARD KEDUA (DUPLIKAT) SUDAH DIHAPUS DI SINI
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>