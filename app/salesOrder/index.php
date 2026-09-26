<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <!-- Tambahan CSS agar tabel responsif di mobile -->
    <style>
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                        
                        <h4 class="font-weight-bold py-3 mb-0">Riwayat Penjualan</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/dashboard"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>commission/index">Komisi</a></li>
                                <li class="breadcrumb-item">Detail Komisi</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>commission/index'">Kembali</button>                    
                  </div>    
            </div>      

            <?php if(mysqli_num_rows($data) < 1) : ?>
                    <div class="alert alert-dark-warning alert-dismissible fade show">
                        Belum ada data
                    </div>   
            <?php else: ?>    
                <div class="card">
                    <div class="card-datatable table-responsive" style="padding: 20px 10px 10px 10px">
                    <table  id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th width="5%" style="text-align: center"><b>NO</b></th>
                                <th width="20%" style="text-align: center"><b>NO SALES ORDER</b></th>
                                <th width="20%"style="text-align: center"><b>NAMA PEMBELI</b></th>
                                <th style="text-align: center"><b>TANGGAL ORDER</b></th>
                                <th width="15%" style="text-align: center"></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php $totalFee = 0 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td align="center"><?php echo $i ?></td>
                                    
                                    <!-- Link Print diubah memanggil Modal Bootstrap -->
                                    <td><?php echo $val['no_order'] ?></td>
                                    <td><?php echo $val['name'] ?></td>
                                    <td align="center"><?php echo $val['date_order'] ?></td>
                                    <td align="center"><i  class="fa fa-eye" style="font-size: 17px" onclick="showPrintModal('<?php echo $globalUrl ?>commission/print?salesOrderId=<?php echo $val['id'] ?>')"></td>
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

    <!-- MODAL BOOTSTRAP UNTUK PRINT -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Detail Sales Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0"> 
                    <iframe id="printIframe" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL BOOTSTRAP -->

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php ob_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            // Aktifkan paging agar fitur jumlah baris per halaman bisa bekerja
            "paging": true, 
            
            // Set default jumlah data yang tampil menjadi 100
            "pageLength": 100, 
            
            // (Opsional) Mengatur pilihan jumlah data di dropdown agar user bisa mengubahnya
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"] ],
            
            // Matikan pencarian jika memang tidak dibutuhkan
            "searching": false,
            
            // Memastikan tabel bisa digeser kiri-kanan di perangkat mobile
            "scrollX": true 
        });
    });

    // FUNGSI UNTUK MEMUNCULKAN MODAL PRINT
    function showPrintModal(url) {
        // Set URL ke iframe
        $('#printIframe').attr('src', url);
        // Tampilkan modal
        $('#printModal').modal('show');
    }

    // Bersihkan URL iframe saat modal ditutup agar tidak membebani memori browser
    $('#printModal').on('hidden.bs.modal', function () {
        $('#printIframe').attr('src', '');
    });
</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>