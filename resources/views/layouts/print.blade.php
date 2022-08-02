<!DOCTYPE html>
<html dir="rtl" lang="fa-IR">
<link type="text/css" rel="stylesheet" id="dark-mode-custom-link">
<link type="text/css" rel="stylesheet" id="dark-mode-general-link">
<style lang="en" type="text/css" id="dark-mode-custom-style"></style>
<style lang="en" type="text/css" id="dark-mode-native-style"></style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    <meta name="fontiran.com:license" content="62ATP3">
    <style type="text/css">
        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: normal;
            src: url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/eot/IRANSansWeb.eot');
            src: url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/eot/IRANSansWeb.eot?#iefix') format('embedded-opentype'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/woff2/IRANSansWeb.woff2') format('woff2'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/woff/IRANSansWeb.woff') format('woff'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/ttf/IRANSansWeb.ttf') format('truetype');
        }

        @font-face {
            font-family: IRANSans;
            font-style: normal;
            font-weight: bold;
            src: url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/eot/IRANSansWeb_Bold.eot');
            src: url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/eot/IRANSansWeb_Bold.eot?#iefix') format('embedded-opentype'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/woff2/IRANSansWeb_Bold.woff2') format('woff2'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/woff/IRANSansWeb_Bold.woff') format('woff'),
            url('https://alvandpakhsh.ir/wp-content/plugins/woocommerce-invoice-pro/assets/fonts/iransans/ttf/IRANSansWeb_Bold.ttf') format('truetype');
        }

    </style>
    <style type="text/css">@media (max-width: 576px) {
            .table-responsive thead {
                display: none; }
            .table-responsive td {
                width: 100%;
                display: block; } }
        @media (max-width: 576px) {
            .table-bordered th, .table-bordered td {
                border: none !important; }
            .table-bordered tbody tr:not(:last-child) td:last-child {
                border-bottom: 1px solid #000; } }

        @media (max-width: 576px) {
            .products-table td .td-title {
                display: block !important; } }
        @media (max-width: 576px) {
            .total-table tbody tr:not(:last-child) td:last-child {
                display: table-cell;
                width: auto; }
            .total-table tbody tr:not(:last-child) th {
                border-bottom: 1px solid #000; } }
        @media (max-width: 576px) {
            .products-table .row {
                display: none; }
            .products-table td {
                min-height: 54px;
                text-align: right; }
            .products-table td .td-title {
                font-weight: bold;
                float: left;
                margin-right: 5px; }
            .products-table tbody tr.even td {
                background: rgba(72, 72, 72, 0.25); }
            .products-table tfoot {
                display: none; }

            .rtl .products-table td {
                text-align: left; }
            .rtl .products-table td .td-title {
                float: right;
                margin-right: 0;
                margin-left: 5px; } }
        @media (max-width: 576px) {
            .table-responsive td.to-word {
                display: table-cell; } }

        /*# sourceMappingURL=responsive.css.map */
    </style>        <style type="text/css">
        pre.xdebug-var-dump {
            direction: ltr;
            text-align: left;
            font-family: monospace; }

        @page {
            size: auto;
            margin: 0; }
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact; } }
        @media print {
            html, body {
                height: 99%;
                page-break-after: avoid;
                page-break-before: avoid; } }
        * {
            box-sizing: border-box; }

        html, body, div, span, object, iframe,
        h1, h2, h3, h4, h5, h6, p, blockquote, pre,
        abbr, address, cite, code, del, dfn, em,
        img, ins, kbd, q, samp, small, strong, sub,
        sup, var, b, i, dl, dt, dd, ol, ul, li,
        fieldset, form, label, legend, table, caption,
        tbody, tfoot, thead, tr, th, td, article,
        aside, canvas, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section,
        summary, time, mark, audio, video {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent; }

        body {
            line-height: 34px;
            color: #000;
            font-size: 16px;
            font-family: Tahoma, Arial, sans-serif; }

        article, aside, details, figcaption, figure,
        footer, header, hgroup, menu, nav, section {
            display: block; }

        a {
            color: #000;
            margin: 0;
            padding: 0;
            font-size: 100%;
            vertical-align: baseline;
            background: transparent;
            text-decoration: none; }

        ul {
            list-style: none; }

        ins {
            text-decoration: none;
            display: block; }

        del {
            text-decoration: line-through;
            display: block; }

        img {
            max-width: 100%;
            height: auto; }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            max-width: 100%; }
        table th, table td {
            vertical-align: middle;
            padding: 10px; }
        table.table-fixed {
            table-layout: fixed; }

        .button {
            background: #FF6348;
            color: #FFF;
            text-align: center;
            border-radius: 2px;
            line-height: 46px;
            cursor: pointer;
            padding: 0 15px;
            display: inline-block;
            border: none;
            font-size: 100%; }

        /*@media (max-width: $break_point) {
            .table-responsive {
                thead {
                    display: none;
                }
                td {
                    width: 100%;
                    display: block;
                }
            }
        }*/
        .table-bordered {
            border: 1px solid #000;
            /*@media (max-width: $break_point) {
                th, td {
                    border: none;
                }
                tbody tr:not(:last-child) td:last-child {
                    border-bottom: 1px solid #000;
                }
            }*/ }
        .table-bordered th, .table-bordered td {
            border: 1px solid #000; }

        /*@media (max-width: $break_point) {
            .total-table {
                tbody tr:not(:last-child) td:last-child {
                    display: table-cell;
                    width: auto;
                }
                tbody tr:not(:last-child) th {
                    border-bottom: 1px solid #000;
                }
            }
        }*/
        .clearfix:after {
            content: '';
            display: block;
            clear: both; }

        .container {
            position: relative;
            border: 1px solid transparent;
            padding: 10px; }

        .component {
            margin: 0 5px; }
        .component .title {
            font-weight: bold;
            display: inline-block;
            margin: 0 5px; }
        .component .content {
            display: inline-block; }

        .barcode > * {
            margin: auto; }
        .barcode desc {
            display: none !important; }

        .products-table td .td-title {
            display: none; }
        .products-table img.wp-post-image {
            max-width: 100px; }
        .products-table .product-attributes li {
            display: inline-block; }

        /*@media (max-width: $break_point) {
            .products-table {
                .row {
                    display: none;
                }

                td {
                    min-height: 54px;
                    text-align: right;
                }

                td .td-title {
                    font-weight: bold;
                    float: left;
                    margin-right: 5px;
                }

                tbody tr.even td {
                    background: rgba(72, 72, 72, 0.25);
                }

                tfoot {
                    display: none;
                }
            }
            .rtl .products-table td {
                text-align: left;

                .td-title {
                    float: right;
                    margin-right: 0;
                    margin-left: 5px;
                }
            }
        }*/
        .profit-wrapper {
            text-align: right;
            margin: 10px 0; }
        .profit-wrapper > div {
            display: inline-block;
            padding: 0 10px;
            line-height: 20px; }
        .profit-wrapper .profit {
            border-right: 1px solid #000; }

        .signature-table td {
            vertical-align: top; }
        .signature-table .shop-signature .title,
        .signature-table .signature-customer .title {
            display: block;
            margin-bottom: 10px; }

        img.watermark {
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
            z-index: 999; }

        .print {
            text-align: center;
            margin: 10px 0; }
        @media print {
            .print {
                display: none; } }

        .condensed {
            line-height: 20px; }
        .condensed table th, .condensed table td {
            padding: 1px; }
        .condensed .profit-wrapper {
            margin-top: 0;
            margin-bottom: 0; }

        /*@media (max-width: $break_point) {
            td.to-word {
                display: table-cell;
            }
        }*/
        .post-label .total-table {
            border: none; }
        .post-label .total-table tbody {
            display: flex;
            justify-content: center; }
        .post-label .total-table tbody th, .post-label .total-table tbody td {
            border: none;
            padding-top: 0;
            padding-bottom: 0; }
        .post-label .total-table tbody tr:not(:last-child) td {
            border-right: 1px solid #000000; }

        .rtl {
            text-align: right;
            direction: rtl; }
        .rtl .container {
            text-align: right;
            direction: rtl; }
        .rtl .profit-wrapper .profit {
            border-left: 1px solid #000;
            border-right: none; }
        .rtl.post-label .total-table tbody tr:not(:last-child) td {
            border-right: none;
            border-left: 1px solid #000000; }

        .invoice .top-line {
            height: 15px;
            background: #000; }
        @media (min-width: 576px) {
            .invoice .template-8 .table-bordered th, .invoice .template-8 .table-bordered td {
                border-color: #000; } }
        .invoice .template-8.container {
            padding: 0 20px 20px 20px; }
        .invoice .template-8 .header-table {
            /*@media (max-width: $break_point) {
                text-align: center;
            }*/ }
        .invoice .template-8 .header-table .invoice-title {
            text-align: center;
            font-weight: bold;
            font-size: 200%; }
        @media (min-width: 576px) {
            .invoice .template-8 .header-table .print-date {
                text-align: right; } }
        .invoice .template-8 .shop-customer-table {
            border-collapse: unset;
            border: none;
            border-spacing: 5px;
            margin-bottom: 20px; }
        .invoice .template-8 .shop-customer-table th {
            background: rgba(72, 72, 72, 0.25); }
        .invoice .template-8 .shop-customer-table th span {
            text-align: center;
            white-space: nowrap;
            transform-origin: 50% 50%;
            transform: rotate(-90deg);
            display: inline-block; }
        .invoice .template-8 .shop-customer-table .order-id {
            font-size: 150%;
            font-weight: bold; }
        .invoice .template-8 .shop-customer-table td.info .component {
            display: inline-block; }
        .invoice .template-8 .shop-customer-table td.last {
            text-align: center; }
        .invoice .template-8 .shop-customer-table td.last .content .title {
            display: none; }
        .invoice .template-8 .shop-customer-table tbody tr:first-child th {
            border-top-left-radius: 12px; }
        .invoice .template-8 .shop-customer-table tbody tr:first-child td:last-child {
            border-top-right-radius: 12px; }
        .invoice .template-8 .shop-customer-table tbody tr:last-child th {
            border-bottom-left-radius: 12px; }
        .invoice .template-8 .shop-customer-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 12px; }
        .invoice .template-8 .products-table th, .invoice .template-8 .products-table td {
            text-align: center; }
        .invoice .template-8 td.note-cell {
            vertical-align: top; }
        .invoice .template-8 td.note-cell .component, .invoice .template-8 td.note-cell .title {
            margin: 0; }
        .invoice .template-8 td.total-cell {
            padding-left: 0;
            padding-right: 0; }
        @media (min-width: 576px) {
            .invoice.rtl .template-8 .header-table .print-date {
                text-align: left; } }
        .invoice.rtl .template-8 .shop-customer-table tbody tr:first-child th {
            border-top-right-radius: 12px;
            border-top-left-radius: 0; }
        .invoice.rtl .template-8 .shop-customer-table tbody tr:first-child td:last-child {
            border-top-right-radius: 0;
            border-top-left-radius: 12px; }
        .invoice.rtl .template-8 .shop-customer-table tbody tr:last-child th {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 12px; }
        .invoice.rtl .template-8 .shop-customer-table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 12px; }
        .invoice.condensed .template-8 .shop-customer-table {
            margin-bottom: 5px; }

        /*# sourceMappingURL=invoice-8.css.map */
        *, body, select, input {
            font-family: 'IRANSans', Tahoma, Arial, sans-serif !important;
        }

        .container {
            margin: 20px;
        }

        .container {
            border-color: #000;
        }

    </style>
    <style type="text/css">@media (max-width: 576px) {
            .table-responsive thead {
                display: none; }
            .table-responsive td {
                width: 100%;
                display: block; } }
        @media (max-width: 576px) {
            .invoice .template-1 .shop-info tfoot, .invoice .template-1 .shop-info tfoot tr {
                display: block; } }
        @media (max-width: 576px) {
            .invoice .template-1 .total-table {
                width: 100%; } }
        @media (max-width: 576px) {
            .invoice .template-2 .sender-customer-table td {
                margin-bottom: 15px; } }
        @media (max-width: 576px) {
            .invoice .template-2 .total-table {
                width: 100%; }
            .invoice .template-2 .total-table tbody tr:not(:last-child) td:last-child {
                border-bottom: none; } }
        @media (max-width: 576px) {
            .invoice .template-3 .sender-customer-table td {
                margin-bottom: 15px; } }
        @media (max-width: 576px) {
            .invoice .template-3 .total-table {
                width: 100%; }
            .invoice .template-3 .total-table tbody tr:not(:last-child) td:last-child {
                border-bottom: none; } }
        @media (max-width: 576px) {
            .invoice .template-4 .sender-customer-table td {
                margin-bottom: 15px; } }
        @media (max-width: 576px) {
            .invoice .template-4 .total-table {
                width: 100%; }
            .invoice .template-4 .total-table tbody tr:not(:last-child) td:last-child,
            .invoice .template-4 .total-table tbody tr:not(:last-child) th {
                border-bottom: none; } }
        @media (max-width: 576px) {
            .invoice .template-6 .shop-info > tbody > tr > td:first-child {
                border-bottom: 2px dashed #000; } }
        @media (max-width: 576px) {
            .invoice .template-6 .shop-info table td {
                width: auto;
                display: table-cell;
                vertical-align: top; }
            .invoice .template-6 .shop-info table .component.title .title, .invoice .template-6 .shop-info table .component.address .title, .invoice .template-6 .shop-info table .component.print-date .title, .invoice .template-6 .shop-info table .component.phone .title {
                display: none; }
            .invoice .template-6 .shop-info table tr > td:nth-child(2) {
                text-align: right; } }
        @media (max-width: 576px) {
            .invoice .template-6 .products-table .row {
                display: table-cell; }
            .invoice .template-6 .products-table.table-responsive td {
                width: auto;
                display: table-cell; }
            .invoice .template-6 .products-table tbody tr.even td {
                background: transparent; }
            .invoice .template-6 .products-table.table-bordered tbody tr:not(:last-child) td:last-child {
                border-bottom: none; } }
        @media (max-width: 576px) {
            .invoice .template-6 .total-table tbody tr:not(:last-child) th {
                border-bottom: none; }
            .invoice .template-6 .total-table tbody tr:not(:last-child) td:last-child {
                border-bottom: none; } }
        @media (max-width: 576px) {
            .invoice.rtl .template-6 .shop-info table tr > td:nth-child(2) {
                text-align: left; } }
        @media (max-width: 576px) {
            .invoice .template-7 .header-table table {
                table-layout: fixed;
                margin-top: 15px; } }
        @media (max-width: 576px) {
            .invoice .template-7 .header-table table td {
                display: table-cell; } }
        @media (max-width: 576px) {
            .invoice .template-7 .total-table td.final {
                background: transparent;
                color: #000;
                width: 100%; } }
        @media (max-width: 576px) {
            .invoice .template-8 .header-table {
                text-align: center; } }

        @media (max-width: 576px) {
            .pre-invoice .template-1 .shop-info tfoot, .pre-invoice .template-1 .shop-info tfoot tr {
                display: block; } }
        @media (max-width: 576px) {
            .pre-invoice .template-1 .cart-total-table {
                width: 100%; } }

        /*# sourceMappingURL=responsive-invoice.css.map */
    </style>
    <livewire:styles/>
</head>
<body class="invoice processing condensed rtl">

{{$slot}}

</body>
<livewire:scripts/>
</html>
