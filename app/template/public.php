<!DOCTYPE html>

<html lang="en" class="material-style layout-fixed">

<head>
    <title><?php echo isset($globalPageTitle) ? $globalPageTitle : 'SBiZ Affiliate' ?></title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="description" content="Checkout Produk Affiliate" />
    <meta name="keywords" content="Affiliate, Checkout, Produk">
    <meta name="author" content="Srthemesvilla" />
    <meta name="theme-color" content="#0d47a1">
    <link rel="icon" type="image/x-icon" href="<?php echo $config['app']['assets'] ?>img/favicon.png">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/fontawesome.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/ionicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/linearicons.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/open-iconic.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>fonts/feather.css">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/bootstrap-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/shreerang-material.css">
    <link rel="stylesheet" href="<?php echo $config['app']['assets'] ?>css/uikit.css">

    <style>
        /* =============================================================
           SBiZ Affiliate Checkout - Public Mobile First Stylesheet
           ============================================================= */
        html, body {
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
        }

        body.affiliate-checkout-body {
            background-color: #f4f5f7;
            padding-bottom: calc(78px + env(safe-area-inset-bottom));
            font-size: 14px;
            overflow-x: hidden;
        }

        /* ---------- Header ---------- */
        .ac-header {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .08);
            padding: 10px 12px;
            padding-top: calc(10px + env(safe-area-inset-top));
            display: flex;
            align-items: center;
            min-height: 56px;
        }
        .ac-header .ac-header-back {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #333;
            font-size: 18px;
            text-decoration: none;
        }
        .ac-header .ac-header-title {
            flex: 1;
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: #212529;
            line-height: 1.25;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .ac-header .ac-header-brand {
            font-size: 12px;
            color: #8a8f99;
            line-height: 1.2;
        }

        /* ---------- Wrapper ---------- */
        .ac-wrapper {
            width: 100%;
            max-width: 640px;
            margin: 0 auto;
            padding: 12px;
        }

        /* ---------- Card ---------- */
        .ac-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .07);
            margin-bottom: 12px;
            overflow: hidden;
        }
        .ac-card-body {
            padding: 14px;
        }
        .ac-card-title {
            font-size: 14px;
            font-weight: 600;
            color: #212529;
            margin: 0 0 10px 0;
        }

        /* ---------- Product Image ---------- */
        .ac-product-image {
            position: relative;
            width: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }
        .ac-product-image img {
            width: 100%;
            max-width: 420px;
            height: auto;
            max-height: 340px;
            object-fit: contain;
            border-radius: 10px;
        }

        /* ---------- Typography ---------- */
        .ac-product-name {
            font-size: 17px;
            font-weight: 600;
            line-height: 1.35;
            color: #212529;
            margin: 0 0 6px 0;
        }
        .ac-product-sku {
            font-size: 12px;
            color: #8a8f99;
            margin-bottom: 10px;
        }
        .ac-price-now {
            font-size: 22px;
            font-weight: 700;
            color: #d32f2f;
            line-height: 1.2;
        }
        .ac-price-strike {
            font-size: 13px;
            color: #9aa0a6;
            text-decoration: line-through;
            margin-left: 8px;
        }
        .ac-text-muted-sm {
            font-size: 12px;
            color: #8a8f99;
        }

        /* ---------- Badges & Info rows ---------- */
        .ac-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1.4;
        }
        .ac-badge-success { background: #e6f4ea; color: #1e7e34; }
        .ac-badge-danger  { background: #fdecea; color: #c62828; }
        .ac-badge-info    { background: #e7f1ff; color: #0d47a1; }
        .ac-badge-warning { background: #fff8e1; color: #f57c00; }
        .ac-badge-secondary { background: #f1f3f4; color: #5f6368; }

        .ac-info-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid #f0f1f3;
            font-size: 13px;
        }
        .ac-info-row:last-child { border-bottom: 0; }
        .ac-info-row .ac-info-label {
            color: #8a8f99;
            padding-right: 10px;
            flex: 0 0 42%;
        }
        .ac-info-row .ac-info-value {
            color: #212529;
            font-weight: 500;
            flex: 1;
            text-align: right;
            word-break: break-word;
        }

        /* ---------- Qty stepper (touch friendly) ---------- */
        .ac-qty {
            display: inline-flex;
            align-items: center;
            border: 1px solid #dfe2e6;
            border-radius: 10px;
            overflow: hidden;
        }
        .ac-qty button {
            width: 44px;
            height: 44px;
            border: 0;
            background: #f7f8fa;
            color: #212529;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            line-height: 1;
        }
        .ac-qty button:active { background: #e9ecef; }
        .ac-qty input {
            width: 56px;
            height: 44px;
            border: 0;
            border-left: 1px solid #dfe2e6;
            border-right: 1px solid #dfe2e6;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
            color: #212529;
            -moz-appearance: textfield;
        }
        .ac-qty input::-webkit-outer-spin-button,
        .ac-qty input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* ---------- Form ---------- */
        .ac-form-group {
            margin-bottom: 14px;
        }
        .ac-form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 6px;
            display: block;
        }
        .ac-form-control {
            width: 100%;
            min-height: 46px;
            padding: 10px 12px;
            font-size: 15px;
            color: #212529;
            background-color: #fff;
            border: 1px solid #dfe2e6;
            border-radius: 10px;
            line-height: 1.4;
            -webkit-appearance: none;
            appearance: none;
        }
        .ac-form-control:focus {
            border-color: #0d47a1;
            outline: 0;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .12);
        }
        textarea.ac-form-control {
            min-height: 90px;
            resize: vertical;
        }
        .ac-form-error {
            color: #c62828;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ---------- Region lookup (AJAX autocomplete) ---------- */
        .ac-lookup-wrap {
            position: relative;
        }
        .ac-lookup-spinner {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #0d47a1;
            font-size: 15px;
            pointer-events: none;
        }
        .ac-lookup-result {
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            z-index: 1050;
            margin-top: 4px;
            background: #fff;
            border: 1px solid #dfe2e6;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, .12);
            max-height: 260px;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .ac-lookup-item {
            padding: 11px 12px;
            border-bottom: 1px solid #f0f1f3;
            cursor: pointer;
            font-size: 13px;
            line-height: 1.4;
            color: #212529;
        }
        .ac-lookup-item:last-child {
            border-bottom: 0;
        }
        .ac-lookup-item:active,
        .ac-lookup-item.is-active {
            background: #e7f1ff;
        }
        .ac-lookup-item .ac-lookup-item-main {
            font-weight: 600;
        }
        .ac-lookup-item .ac-lookup-item-sub {
            font-size: 12px;
            color: #8a8f99;
            margin-top: 2px;
        }
        .ac-lookup-info {
            padding: 11px 12px;
            font-size: 13px;
            color: #8a8f99;
            text-align: center;
        }
        .ac-region-box {
            background: #f8f9fb;
            border: 1px solid #eef0f3;
            border-radius: 10px;
            padding: 4px 12px;
            margin-top: 12px;
        }

        /* ---------- Buttons ---------- */
        .ac-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 18px;
            border-radius: 10px;
            border: 0;
            font-size: 15px;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            text-decoration: none;
            line-height: 1.2;
        }
        .ac-btn-primary { background: #0d47a1; color: #fff; }
        .ac-btn-primary:active { background: #093575; color: #fff; }
        .ac-btn-success { background: #1e7e34; color: #fff; }
        .ac-btn-success:active { background: #166028; color: #fff; }
        .ac-btn-outline {
            background: #fff;
            color: #0d47a1;
            border: 1px solid #0d47a1;
        }
        .ac-btn-block-mobile { width: 100%; }

        /* ---------- Sticky bottom action bar ---------- */
        .ac-bottom-bar {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1040;
            background: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, .08);
            padding: 10px 12px;
            padding-bottom: calc(10px + env(safe-area-inset-bottom));
        }
        .ac-bottom-bar-inner {
            max-width: 640px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }
        .ac-bottom-bar .ac-bottom-total {
            flex: 1;
            min-width: 0;
            padding-right: 10px;
        }
        .ac-bottom-bar .ac-bottom-total .ac-bottom-total-label {
            font-size: 11px;
            color: #8a8f99;
            line-height: 1.2;
        }
        .ac-bottom-bar .ac-bottom-total .ac-bottom-total-value {
            font-size: 17px;
            font-weight: 700;
            color: #d32f2f;
            line-height: 1.3;
            white-space: nowrap;
        }
        .ac-bottom-bar .ac-bottom-action {
            flex: 0 0 auto;
            min-width: 150px;
        }
        .ac-bottom-bar .ac-bottom-action .ac-btn {
            min-height: 46px;
            padding: 10px 16px;
        }

        /* ---------- Alerts / empty state ---------- */
        .ac-alert {
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 12px;
            line-height: 1.5;
        }
        .ac-alert-success { background: #e6f4ea; color: #1e7e34; }
        .ac-alert-warning { background: #fff7e6; color: #8a6d3b; }
        .ac-alert-danger  { background: #fdecea; color: #c62828; }

        .ac-empty {
            text-align: center;
            padding: 40px 20px;
            color: #8a8f99;
        }
        .ac-empty i {
            font-size: 46px;
            display: block;
            margin-bottom: 12px;
            color: #c9ced6;
        }

        /* ---------- Tracking timeline ---------- */
        .ac-timeline {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .ac-timeline li {
            position: relative;
            padding: 0 0 18px 30px;
            border-left: 2px solid #e9ecef;
            margin-left: 8px;
        }
        .ac-timeline li:last-child {
            border-left-color: transparent;
            padding-bottom: 0;
        }
        .ac-timeline li::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 2px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #c9ced6;
            border: 2px solid #fff;
        }
        .ac-timeline li.is-done::before { background: #1e7e34; }
        .ac-timeline li.is-current::before { background: #0d47a1; }
        .ac-timeline li.is-canceled::before { background: #c62828; }
        .ac-timeline .ac-timeline-title {
            font-size: 13px;
            font-weight: 600;
            color: #212529;
            line-height: 1.4;
        }
        .ac-timeline .ac-timeline-desc {
            font-size: 12px;
            color: #616161;
            margin-top: 3px;
            line-height: 1.4;
        }
        .ac-timeline .ac-timeline-date {
            font-size: 12px;
            color: #8a8f99;
            margin-top: 2px;
        }
        .ac-timeline li.is-pending .ac-timeline-title { color: #9aa0a6; }
        .ac-timeline li.is-canceled .ac-timeline-title { color: #c62828; }

        /* ---------- Copy button & Bank card components ---------- */
        .ac-bank-item {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 10px;
        }
        .ac-bank-item:last-child { margin-bottom: 0; }
        .ac-bank-name {
            font-weight: 700;
            font-size: 13px;
            color: #1a202c;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .ac-bank-account {
            font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #0d47a1;
            margin: 4px 0;
            word-break: break-all;
        }
        .ac-bank-holder { font-size: 12px; color: #718096; }
        .ac-copy-btn {
            background: #fff;
            border: 1px solid #ced4da;
            color: #495057;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all .15s ease-in-out;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            line-height: 1.4;
        }
        .ac-copy-btn:hover, .ac-copy-btn:active {
            background: #e7f1ff;
            border-color: #0d47a1;
            color: #0d47a1;
        }
        .ac-copy-btn.copied {
            background: #e6f4ea !important;
            border-color: #1e7e34 !important;
            color: #1e7e34 !important;
        }

        /* ---------- Instruction Steps & Accordion ---------- */
        .ac-steps { padding-left: 20px; margin-bottom: 0; }
        .ac-steps li {
            font-size: 13px;
            color: #495057;
            margin-bottom: 8px;
            line-height: 1.5;
        }
        .ac-steps li:last-child { margin-bottom: 0; }
        .ac-accordion-header {
            cursor: pointer;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f1f3;
            font-weight: 600;
            font-size: 13px;
            color: #212529;
        }
        .ac-accordion-header:last-child { border-bottom: 0; }
        .ac-accordion-header .fa-chevron-down {
            transition: transform .2s ease;
            font-size: 11px;
            color: #8a8f99;
        }
        .ac-accordion-header.active .fa-chevron-down {
            transform: rotate(180deg);
        }
        .ac-accordion-body {
            display: none;
            padding: 10px 0 14px 0;
            font-size: 12.5px;
            color: #495057;
            line-height: 1.5;
            border-bottom: 1px solid #f0f1f3;
        }

        /* ---------- Step Milestones Bar (Tracking) ---------- */
        .ac-step-milestones {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            padding: 10px 6px;
            margin-bottom: 16px;
        }
        .ac-step-milestones::before {
            content: '';
            position: absolute;
            top: 25px;
            left: 25px;
            right: 25px;
            height: 3px;
            background: #e9ecef;
            z-index: 1;
        }
        .ac-milestone-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 25%;
        }
        .ac-milestone-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #e9ecef;
            color: #8a8f99;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            border: 2px solid #fff;
            transition: all .2s;
        }
        .ac-milestone-label {
            font-size: 11px;
            font-weight: 600;
            color: #8a8f99;
            margin-top: 6px;
            line-height: 1.2;
        }
        .ac-milestone-item.is-done .ac-milestone-icon { background: #1e7e34; color: #fff; }
        .ac-milestone-item.is-done .ac-milestone-label { color: #1e7e34; }
        .ac-milestone-item.is-current .ac-milestone-icon {
            background: #0d47a1;
            color: #fff;
            box-shadow: 0 0 0 4px rgba(13, 71, 161, 0.15);
        }
        .ac-milestone-item.is-current .ac-milestone-label { color: #0d47a1; font-weight: 700; }
        .ac-milestone-item.is-canceled .ac-milestone-icon { background: #c62828; color: #fff; }
        .ac-milestone-item.is-canceled .ac-milestone-label { color: #c62828; }

        /* ---------- Mobile specific tweaks ---------- */
        @media (max-width: 575.98px) {
            .ac-bottom-bar .ac-bottom-action { min-width: 130px; }
            .ac-bottom-bar .ac-bottom-total .ac-bottom-total-value { font-size: 16px; }
            .ac-product-name { font-size: 16px; }
            .ac-price-now { font-size: 20px; }
            .ac-wrapper { padding: 10px; }
        }

        /* ---------- Small tablet & up ---------- */
        @media (min-width: 576px) {
            body.affiliate-checkout-body { font-size: 15px; }
            .ac-card-body { padding: 18px; }
        }
    </style>
</head>

<body class="affiliate-checkout-body">
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>

    <?php echo $templateContent ?>

    <!-- Core scripts -->
    <script src="<?php echo $config['app']['assets'] ?>js/pace.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/jquery-3.4.1.min.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>libs/popper/popper.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/bootstrap.js"></script>
    <script src="<?php echo $config['app']['assets'] ?>js/material-ripple.js"></script>

    <?php echo isset($embedCssJS) ? $embedCssJS : '' ?>
</body>

</html>
