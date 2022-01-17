<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="text-center">
        <h4> DAFTAR PENJUALAN TIKET DIVISI <div class="text-uppercase"><?= $tiket->nama_divisi; ?></div>
        </h4>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>TANGGAL ISSUED</th>
                <th>TANGGAL BERANGKAT</th>
                <th>NAMA</th>
                <th>NIP</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= $tiket->tgl_issued; ?></td>
                <td><?= $tiket->tgl_berangkat; ?></td>
                <td><?= $tiket->nama_customer; ?></td>
                <td><?= $tiket->nip_customer; ?></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2"></th>
                <th colspan="2">Biaya Materai :</th>
                <th>Rp. 15.000</th>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="2">Total : </th>
                <?php $total = $tiket->hpp+$tiket->service_fee+$tiket->biaya_lain+$tiket->harga_jual+15000; ?>
                <th>Rp. <?= number_format($total, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>