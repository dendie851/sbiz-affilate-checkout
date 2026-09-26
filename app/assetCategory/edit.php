<?php ob_start(); ?>
    <?php include_once 'editRead.php' ?>

    <form action="<?php echo $globalUrl ?>assetCategory/editSave" method="post" id="validation-form" >
    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">        
    <div class="layout-content">
      <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                  <div class="col-md-4">                                                      
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
                        <button type="button" class="btn btn-default" onclick="window.location='<?php echo $globalUrl ?>assetCategory/index'">Batal</button>                    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>    
            </div>     

            <div class="row">
                    <div class="col-md-12">
                        <div class="card d-flex w-100 mb-4">
                            <div class="row no-gutters row-bordered row-border-light h-100">
                                <div class="d-flex col-md-12 align-items-center">                             
                                    <div class="card-body">  
                                        <div class="form-group">
                                            <label class="form-label">Nama</label> 
                                            <input name="name" required type="text" class="form-control" value="<?php echo $data['name']  ?>"  >
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Status Aktif</label>
                                            <select name="isActive" class="form-control">
                                                <option value="1" <?php echo $data['is_active'] == '1' ? 'selected' : '' ?>>Aktif</option>
                                                <option value="0" <?php echo $data['is_active'] == '0' ? 'selected' : '' ?>>Tidak Aktif</option>
                                            </select>
                                        </div>                                                                                
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        <!-- [ content ] End -->
        </div>
      </div>     

<?php $templateContent = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

<?php include_once 'app/template/main.php' ?>
