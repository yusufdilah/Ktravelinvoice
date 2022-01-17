<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title><?= $title_pdf;?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <style>
        /* mengatur font size untuk seluruh halaman */
        body {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td class="text-left">
                    <br>
                    <!-- Logo di ubah menggunakan base64 -->
                    <img style="width: 15rem; height: 15rem;" src="data:image/jpeg;base64,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nn6qkwJ2gWN6GKEXWfv8VNP58j+1Aa5LAGXPJQTbOskW7C3n0gopFFHEPfnUftTYXAHB3q2w4AOx6SCIID8Vpo6QnZA0dwkFc0e2anJmRaVIeIppjelJxr9qireXBMsZ70/MkZUgx2l9In5Tb0A/lN9fm9/rHrv3jTk/NHoTRjBPFAohzH2g7epStv7i01D5UkA5FnmiD59BWKawMxj/AJwRQYAg2qdEpFL9P3U98xUfLb3Gj9RGpyu7Vsq+swWzxUp7sFRfnKACNdql9MLdpImnFCU+aaMmTCfQ1C2Sleg9yKNoLOkb7CtoI4H5dqHKl0XKJy6j1Lodoez6PgYnADVqA0wYQ6XODj6IsuuhehuEGJowQ8prCLwqyld2nzirpx6rQNf6ujhA0PpkoCrkXOx8qhfvc0G50EFB6B6V2Bvbk9yaJSwD8C3xUwRmO653tRnxgEAbUsVAO5RuK62tQ0RPWgGP+rWhGyByUNSRd19HUHqk1kbokv7L4a8OUJrb7klY3i6D9qhu42oBAQfxmTlko96JnUFybf8Asv/aAAwDAQACAAMAAAAQ888888888888888888488888888p2KwLx8888888oWIOgd888888efLmSnK+3bw88t7Kngpd5sU4a8ls7aqayBTfTL8TGz1KdCaYWy/8sIfH6VCK6W4Z+8sbkKS71Oc88888M8s8888888888888888888888888888888888//EACkRAQABBAECBQQDAQAAAAAAAAERACExQWFRcRCBkbHBIDCh0UBQ4fD/2gAIAQMBAT8Q/ltqBgdJYn3KOEg64ez4S2RJj/sUvXFnv9mAjKAqG8lPWQ2Zf1zWqqFw+t0BK/B1tR0N7QUWKpavelYBytFFvgmw469qFRQ657UYbRRSE11JyiadphioNyl8hPCDNI0s/D/tPJk2POhOR9Y6F8ux1SSg06vfjqdmqwSZk55MWelBQmMOpBc5pvTKzOrszULFUvrz7UsJMYcQXOakpVpQRET+WnlEKnwZvAUG7Abe9KxLFzyqQBZ1mFdrJCaoRgNvjblhYnDUkWlxzgIi0b1uhTlZwXtBUkFkyOaFVXXQty1czw5qBgI9Eu9qZRR6PgKCblqLqTi5TuDGbzQ7A7HD+q2UgG9rYKLm9g7fulF3J6RSGzu9bfNTktI+00CUEPsURd6PxX5r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" alt="">
                <td class="text-right font-size">
                    <br>
                    <p>WISMA ANTARA LANTAI 8</p>
                    <p>JL. MEDAN MERDEKA SELATAN NO.17</p>
                    <p>JAKARTA 10110, INDONESIA</p>
                    <p>TELP. 021-31180707</p>
                    <p>E-mail : ktravel@kopkarbsm.co.id</p>
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        <p><strong>Date : <?= $invoice->created_date; ?></strong></p>
        <p><strong>Invoice : INV-<?= $invoice->created_date . '-' . $invoice->no_invoice; ?></strong></p>
    </div>
    <div class="text-left font-size">
        <p><strong>SOLD TO</strong></p>
        <p><strong>Divisi : <?= $invoice->nama_divisi; ?></strong></p>
        <p><strong><?= $invoice->nm_perusahaan; ?></strong></p>
        <br>
        <p><strong><?= $invoice->nm_group_head; ?></strong></p>
        <p><strong><?= $invoice->pic; ?></strong></p>
        <p><strong><?= $invoice->alamat_divisi; ?></strong></p>
    </div>
    <!-- <h1 class="text-center bg-info">Generate PDF from View using DomPDF</h1> -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th class="text-center"><strong>NO</strong></th>
                <th class="text-center"><strong>Divisi</strong></th>
                <th class="text-center"><strong>Amount</strong></th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($tiket as $t) : ?>
                <tr class="text-center">
                    <td><?= $no++; ?></td>
                    <td><?= $t->nama_divisi; ?></td>
                    <td>Rp. <?= number_format($t->harga_jual, 0, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        <tbody>
        <tfoot>
            <tr class="text-center">
                <td colspan="2" class="text-center">
                    <p><strong>Grand Total</strong></p>
                </td>
                <td><?php
                    $total = $invoice->total_harga_jual;
                    echo 'Rp. ' . number_format($total, 0, ',', '.');
                    ?>
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="3">
                    <p>Terbilang : <?= $terbilang; ?></p>
                </td>
            </tr>
        </tfoot>
    </table>
    <div>
        <p>
            Pembayaran mohon ditransfer ke :
            <br>
            <?= $invoice->bank_cabang; ?>
            <br>
            No. Rekening : <?= $invoice->no_rekening; ?>
            <br>
            Atas nama : <?= $invoice->atas_nama; ?>
            <br>
            <br>
            Pembayaran paling lambat 3 hari setelah invoice diterima
            Mohon di cantumkan nomor invoice pada saat pembayaran /
            Mohon dikirimkan bukti pembayaran ke email :
            <?= $invoice->email; ?>
            <br>
            <br>
            <?= $invoice->nm_perusahaan; ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            Ardiansyah
            Manajer Bisnis
        </p>
    </div>
</body>

</html>