<div class="modal-body">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered">
            <thead>
                <tr style="color: darkslategrey;">
                    <th>No</th>
                    <th>Tanggal Invoice Issued</th>
                    <th>Tanggal Berangkat</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Divisi</th>
                    <th>NO Memo</th>
                    <th>Route</th>
                    <th>Kode Booking</th>
                    <th>Maskapai</th>
                    <th>Harga Jual</th>
                    <th>Service Fee</th>
                    <th>Hpp</th>
                    <th>Bookers</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $harga_jual= 0; $service_fee = 0; $hpp =0 ; ?>
                <?php foreach ($tiket as $t) : ?>
                    <?php $harga_jual += $t->harga_jual; $service_fee+=$t->service_fee; $hpp+=$t->hpp; ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $t->tgl_issued; ?></td>
                        <td><?= $t->tgl_berangkat; ?></td>
                        <td><?= $t->nama_customer; ?></td>
                        <td><?= $t->nip_customer; ?></td>
                        <td><?= $t->nama_divisi; ?></td>
                        <td><?= $t->no_memo; ?></td>
                        <td><?= $t->kd_route ?></td>
                        <td><?= $t->kode_booking; ?></td>
                        <td><?= $t->nama_maskapai; ?></td>
                        <td>Rp. <?= number_format($t->harga_jual, 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($t->service_fee, 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($t->hpp, 0, ',', '.'); ?></td>
                        <td><?= $t->bookers; ?></td>
                        <td><a href="<?= base_url('Generate_pdf_controller/tiket/' . $t->tiket_id) ?>"" class="btn btn-info btn-sm btn-circle" target="_blank">cetak tiket</a></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="10">Total:</td>
                        <td>Rp. <?= number_format($harga_jual, 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($service_fee, 0, ',', '.') ?></td>
                        <td>Rp. <?= number_format($hpp, 0, ',', '.') ?></td>
                        <td></td>
                        <td></td>
                    </tr>
            </tbody>
            <tfoot style="background: darkslategrey;">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal-footer">
    <a href="#" id="cetak_customer" class="btn btn-info btn-circle btn-sm" target="_blank">Cetak customer</a>
    <a href="#" id="cetak_akunting" class="btn btn-info btn-circle btn-sm" target="_blank">Cetak Akunting</a>
</div>