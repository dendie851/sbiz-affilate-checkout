<?php 
	@session_start();

	include_once 'sbiz/lib/connection.php';

	// ---------------------------------------------------------------
	// Halaman Lacak Pesanan SBiZ Affiliate (Publik)
	// Parameter: ?noOrder=26000008 atau ?order=26000008
	// ---------------------------------------------------------------

	$orderParam = '';
	if(isset($_GET['noOrder']) && strlen(trim($_GET['noOrder'])) > 0) {
		$orderParam = general::secureInput(trim($_GET['noOrder']));
	} elseif(isset($_GET['order']) && strlen(trim($_GET['order'])) > 0) {
		$orderParam = general::secureInput(trim($_GET['order']));
	}

	$hasOrder = false;
	$dataOrder = array();
	$dataItems = array();
	$companyWhatsapp = '';
	$companyName = '';

	if(strlen($orderParam) > 0) {
		$query = "select so.id, so.no_order, so.name, so.phone, so.address_shipping,
					so.districts, so.city, so.province, so.postal_code,
					so.amount_sale, so.shipping_cost, so.description_payment,
					so.date_order, so.date_packing, so.date_shipping, so.date_payment,
					so.status_order, so.status_payment,
					so.no_resi, so.expedition_id,
					a.id as affiliate_id, a.name as affiliate_name, a.username as affiliate_username,
					a.phone_number as affiliate_phone,
					e.name as expedition_name
				  from sales_order as so
				  left join affiliate as a
				    on a.id = so.affiliate_id
				  left join expedition as e
				    on e.id = so.expedition_id
				  where (so.no_order = '{$orderParam}' or so.id = '{$orderParam}')
				    and so.is_delete = '0'
				  limit 1";

		$tmp = $globalConDBMySQL->query($query) or die (mysqli_error($globalConDBMySQL));
		if($tmp && $row = $tmp->fetch_assoc()) {
			$hasOrder = true;
			$dataOrder = $row;
			$salesOrderId = (int)$row['id'];

			// Ambil item produk
			$queryItems = "select sod.id, sod.name, sod.nickname, sod.amount, sod.price,
							sod.stuff_id
						   from sales_order_detail as sod
						   left join stuff as s
						     on s.id = sod.stuff_id
						   where sod.sales_order_id = '{$salesOrderId}'";
			$tmpItems = $globalConDBMySQL->query($queryItems) or die (mysqli_error($globalConDBMySQL));
			while($item = $tmpItems->fetch_assoc()) {
				$dataItems[] = $item;
			}
		}

		// Ambil data kontak CS / WhatsApp perusahaan
		$queryCompany = "select id, name, phone from company limit 1";
		$tmpCompany = $globalConDBMySQL->query($queryCompany) or die (mysqli_error($globalConDBMySQL));
		if($tmpCompany && $comp = $tmpCompany->fetch_assoc()) {
			$companyName = $comp['name'];
			$companyWhatsapp = trim($comp['phone']);
		}
	}

	include_once 'sbiz/lib/connection-close.php';

	// Mapping status order ke label & warna
	// 4 = Menunggu Pembayaran
	// 0 = Menunggu Konfirmasi / Pembayaran Masuk
	// 1 = Diproses / Packing
	// 2 = Dikirim / Dalam Perjalanan
	// 3 = Selesai
	function getTrackingStatusBadge($statusOrder, $statusPayment) {
		if($statusOrder == '4') {
			if($statusPayment == '1') {
				return '<span class="ac-badge ac-badge-info"><i class="fa fa-clock-o"></i> Menunggu Konfirmasi</span>';
			}
			return '<span class="ac-badge ac-badge-warning"><i class="fa fa-clock-o"></i> Menunggu Pembayaran</span>';
		} elseif($statusOrder == '0') {
			return '<span class="ac-badge ac-badge-info"><i class="fa fa-check-circle"></i> Pembayaran Diterima</span>';
		} elseif($statusOrder == '1') {
			return '<span class="ac-badge ac-badge-info"><i class="fa fa-cube"></i> Sedang Dikemas / Packing</span>';
		} elseif($statusOrder == '2') {
			return '<span class="ac-badge ac-badge-success"><i class="fa fa-truck"></i> Dalam Pengiriman</span>';
		} elseif($statusOrder == '3') {
			return '<span class="ac-badge ac-badge-success"><i class="fa fa-check"></i> Pesanan Selesai</span>';
		}
		return '<span class="ac-badge ac-badge-secondary">Status: '.$statusOrder.'</span>';
	}

	// Format nomor WA ke standard 62
	function trackingFormatWA($phone) {
		$clean = preg_replace('/[^0-9]/', '', (string)$phone);
		if(substr($clean, 0, 1) === '0') {
			$clean = '62'.substr($clean, 1);
		}
		return $clean;
	}

	$waMessage = '';
	if($hasOrder) {
		$orderCode = $dataOrder['no_order'];
		$custName = $dataOrder['name'];
		$totalFormatted = 'Rp ' . number_format((double)$dataOrder['amount_sale'], 0, ',', '.');
		$waMessage = "Halo Admin " . ($companyName ? $companyName : 'SBiZ') . ",\n\n"
				   . "Saya mau konfirmasi pembayaran pesanan affiliate:\n"
				   . "• No Order: *" . $orderCode . "*\n"
				   . "• Nama: *" . $custName . "*\n"
				   . "• Total: *" . $totalFormatted . "*\n\n"
				   . "Berikut saya lampirkan bukti transfer. Mohon diproses ya. Terima kasih!";
	}

	
	$targetWA = strlen($companyWhatsapp) > 0 ? trackingFormatWA($companyWhatsapp) : '';
	if(empty($targetWA) && isset($dataOrder['affiliate_phone']) && strlen($dataOrder['affiliate_phone']) > 0) {
		$targetWA = trackingFormatWA($dataOrder['affiliate_phone']);
	}

	// Ambil daftar rekening bank aktif untuk tujuan transfer
	$queryBank = "select id, name, phone
					from member
					where is_enabled = '1'
					  and position_id = '4'
					order by name asc";
	$tmpSupervisor = $globalConDBMySQL->query($queryBank) or die (mysqli_error($globalConDBMySQL));
	while($b = $tmpSupervisor->fetch_assoc()) {
		$waTargetNumber = $b['phone'];
		$waUrl[$waTargetNumber] = 'https://api.whatsapp.com/send?phone=' . $waTargetNumber . '&text=' . rawurlencode($waMessage);
	}


	$urlConfirmation = $globalUrl . 'checkout/confirmation?noOrder=' . (isset($dataOrder['no_order']) ? $dataOrder['no_order'] : '');
?>
