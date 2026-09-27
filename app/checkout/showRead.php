<?php
    @session_start();

    include_once 'sbiz/lib/connection.php';

    $affiliateUsername = general::secureInput(trim(globalFunctionUri(2, 1)));
    $affiliateProductId = general::secureInput(trim(globalFunctionUri(2, 2)));

    $query = "select afs.id, afs.affiliate_id, afs.stuff_id, afs.link_product_brosur, afs.price, afs.price_basic,
                afs.fee_affiliate_nominal, afs.fee_affiliate_percent, afs.point,
                a.name as affiliate_name, a.username as affiliate_username, a.city as affiliate_city,
                s.id as stuff_id_real, s.sku, s.name, s.nickname, s.stock, s.price as price_master, s.category_id, s.description,
                (select sc.name from stuff_category as sc where sc.id = s.category_id) as category_name
              from affiliate_stuff as afs
              inner join affiliate as a
                on a.id = afs.affiliate_id
              inner join stuff as s
                on s.id = afs.stuff_id
              where a.username = '{$affiliateUsername}'
                and a.is_delete = '0'
                and a.is_active = '1'
                and afs.id = '{$affiliateProductId}'
                and afs.is_delete = '0'
                and s.is_delete = '0'
                and s.is_hidden = '0'";

    $tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
    $dataProduct = $tmp->fetch_array();

    $hasProduct = is_array($dataProduct) && isset($dataProduct['id']) ? true : false;

    $showName             = $hasProduct ? $dataProduct['name'] : '';
    $showSku              = $hasProduct ? $dataProduct['sku'] : '';
    $showStock            = $hasProduct ? (int)$dataProduct['stock'] : 0;
    $showCategoryName     = $hasProduct && strlen(trim($dataProduct['category_name'])) > 0 ? $dataProduct['category_name'] : '-';
    $showAffiliateName    = $hasProduct ? $dataProduct['affiliate_name'] : '';
    $showAffiliateCity    = $hasProduct && strlen(trim($dataProduct['affiliate_city'])) > 0 ? $dataProduct['affiliate_city'] : '-';

    $showPriceNow         = $hasProduct ? $dataProduct['price'] : '';
    $showDescription      = $hasProduct ? $dataProduct['description'] : '';
    $showLinkProductBrosur  = $hasProduct ? $dataProduct['link_product_brosur'] : '';

    // --- MENGAMBIL SEMUA FOTO PRODUK ---
    $showImages = [];
    $defaultNoPhoto = $config['app']['assets'] . 'img/no-photo.png';

    if ($hasProduct) {
        $stuffId = $dataProduct['stuff_id_real'];
        
        $queryPhoto = "select id, photo_thumail, photo, is_primary 
                       from stuff_photo 
                       where stuff_id = '{$stuffId}' 
                         and is_active = '1' 
                         and is_delete = '0' 
                       order by is_primary desc, id asc";
        
        $tmpPhoto = $globalConDBMySQL->query($queryPhoto) or die (mysqli_error($globalConDBMySQL));
        
        while ($rowPhoto = $tmpPhoto->fetch_assoc()) {
            $showImages[] = [
                'id'        => $rowPhoto['id'],
                'thumbnail' => !empty($rowPhoto['photo_thumail']) ? $config['app']['assets'].$rowPhoto['photo_thumail'] : $defaultNoPhoto,
                'photo'     => !empty($rowPhoto['photo']) ? $config['app']['assets'].$rowPhoto['photo'] : $defaultNoPhoto,
                'is_primary'=> $rowPhoto['is_primary']
            ];
        }
    }

    // Jika foto kosong, sediakan minimal 1 data default agar frontend tidak error/kosong
    if (empty($showImages)) {
        $showImages[] = [
            'id'        => 0,
            'thumbnail' => $defaultNoPhoto,
            'photo'     => $defaultNoPhoto,
            'is_primary'=> '1'
        ];
    }

    // Variabel shortcut untuk foto utama (bisa dipakai jika butuh 1 foto saja di bagian tertentu)
    $showImage = $showImages[0]['photo'];

    // --- PENGATURAN SETTING AFILIASI ---
    $query = "select id, code, value
              from affiliate_setting 
              where is_delete = '0'
               and is_active = '1'
               and code = '001'";

    $tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
    $dataAffiliateSetting = $tmp->fetch_array();

    $affiliateMasterLink = isset($dataAffiliateSetting['value']) ? $dataAffiliateSetting['value'] : $globalUrl;

    $showUrlOrder = $globalUrl.'checkout/order?affiliateProductId='.$affiliateProductId.'&affiliateUsername='.$affiliateUsername;   
    
    include_once 'sbiz/lib/connection-close.php';
?>