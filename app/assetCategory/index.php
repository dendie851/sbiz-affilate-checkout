<?php ob_start(); ?>
    <?php include_once 'indexRead.php' ?>

    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-8">                                                      
                        <h4 class="font-weight-bold py-3 mb-0">Kategori Asset</h4>   
                        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>home/member"><i class="fa fa-home"></i></a></li> 
                                <li class="breadcrumb-item"><a href="<?php echo $globalUrl ?>assetCategory/index">Pengelolaan Asset</a></li>
                                <li class="breadcrumb-item">Kategori Asset</li>
                            </ol>
                        </div>                               
                  </div>
                  <div class="col-md-4" style="text-align:right; padding-top:30px; padding-right:20px; padding-bottom: 10px">
                        <button type="button" class="btn btn-primary" onclick="window.location='<?php echo $globalUrl ?>assetCategory/add'">Tambah</button>
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
                    <table  id="datatables" class="table table-striped table-bordered" data-toolbar="#bootstrap-table-toolbar" data-search="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-minimum-count-columns="3"
                        data-show-pagination-switch="false" data-pagination="true" data-id-field="id" >
                        <thead>
                            <tr>
                                <th style="text-align: center"><b>NAMA</b></th>
                                <th width="20%" style="text-align: center">STATUS AKTIF</th>
                                <th width="15%" style="text-align: center"></th>
                            </tr>                                               
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php while($val = $data->fetch_array()): ?>
                                <tr style="cursor: pointer;">
                                    <td >              
                                        <?php echo ucfirst($val['name']) ?>
                                    </td>
                                    <td align="center">
                                        <?php if($val['is_active'] == '1'): ?>                              
                                           <a href="javascript:void(0)" class="badge badge-outline-info" style="font-size: 12px; margin: 5px; padding: 6px">AKTIF</a>
                                        <?php else: ?>      
                                           <a href="javascript:void(0)" class="badge badge-outline-danger" style="font-size: 12px; margin: 5px; padding: 6px">TIDAK AKTIF</a>
                                        <?php endif; ?>                                                                              
                                    </td>    
                                    <td align="center" style="width: 50px; vertical-align: middle;" > 
									    <i  class="fa fa-edit" style="font-size: 17px" onclick="window.location='<?php echo $globalUrl ?>assetCategory/edit?id=<?php echo $val['id'] ?>'"></i>			                            
                                        <i  class="fa fa-trash" style="font-size: 17px" onclick="deleteConfirm(<?php echo $val['id'] ?>)"></i>                                                 
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
        $('#datatables').DataTable();
    });   


    function deleteConfirm(p) {
      bootbox.confirm({
        message: 'Anda yakin akan menghapus ?',
        className: 'bootbox-xs',

        callback: function(result) {
            if(result) {
                window.location='<?php echo $globalUrl ?>assetCategory/delete?id='+p;
            }    
        },
      });
    }    

</script>
<?php $embedCssJS = ob_get_contents(); ?>
<?php ob_end_clean(); ?>



<?php include_once 'app/template/main.php' ?>
