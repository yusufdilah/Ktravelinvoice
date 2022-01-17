<form action="<?= base_url('Invoice_controller/update/'.$invoice->invoice_id); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="divisi">Divisi</label>
                    <select name="divisi" id="divisiEdit" class="form-control" required>
                        <?php foreach($divisi as $d): ?>
                            <option value="<?= $d->divisi_id ?>" data-perusahaan_id="<?= $d->perusahaan_id; ?>" <?= $d->divisi_id == $invoice->divisi_id ? 'selected' : '' ?>><?= $d->nama_divisi ?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo form_error('divisiEdit')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="group_head">Group Head</label>
                    <input type="text" name="group_head" id="group_headEdit" class="form-control" readonly value="<?= $invoice->nm_group_head ?>">
                </div>
                <div class="form-group">
                    <label for="periode">Periode Issued</label>
                    <br>
                    <small>From</small>
                    <input type="date" name="from_periode" id="from_periodeEdit" class="form-control">
                    <div class="invalid-feedback">
                        <?php echo form_error('from_periodeEdit')?>
                    </div>
                </div>
                <div class="form-group">
                    <small>To</small>
                    <input type="date" name="to_periode" id="to_periodeEdit" class="form-control">
                    <div class="invalid-feedback">
                        <?php echo form_error('to_periodeEdit')?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label for="perusahaan">Perusahaan</label>
                    <select name="perusahaan" id="perusahaanEdit" class="form-control" required>
                        <?php foreach($perusahaan as $p): ?>
                            <option value="<?= $p->perusahaan_id ?>"><?= $p->nm_perusahaan ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo form_error('perusahaanEdit')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pic">PIC</label>
                    <select name="pic" id="picEdit" class="form-control" required>
                        <?php foreach($pic as $pic): ?>
                            <option value="<?= $pic->pic_id ?>" <?= $pic->pic_id == $invoice->pic_id ? 'selected' : ''; ?>><?= $pic->pic ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo form_error('picEdit')?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamatEdit" cols="30" rows="6" class="form-control" readonly><?= $invoice->alamat_perusahaan; ?></textarea>
                </div>
                <button type="button" class="btn btn-secondary" id="list-tiket-edit">Generate List Tiket</button>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="table-responsive">
            <table id="example1" class="table table-hover">
                <thead>
                    <tr style="color: darkslategrey;">
                        <th><input type="checkbox" name="cheack-all" id="check-all-edit"></th>
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
                    </tr>
                </thead>
                <tbody id="tiketEdit">
                    <?php $no=1; ?>
                    <?php foreach($tiket as $t): ?>
                        <tr>
                            <td><input checked type="checkbox" name="tiket_id[]" id="tiket-<?=$t->tiket_id;?>" data-tiket_id="<?= $t->tiket_id; ?>" class="tiket_id" value="<?= $t->tiket_id; ?>"></td>
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
                            <td><?= $t->harga_jual ?></td>
                            <td><?= $t->service_fee; ?></td>
                            <td><?= $t->hpp; ?></td>
                            <td><?= $t->bookers; ?></td>
                            <td id="x-<?= $t->tiket_id;?>"><a href="#" class="btn btn-danger btn-sm hapus" data-id_tiket="<?= $t->tiket_id ?>">x</a></td>
                        </tr>
                    <?php endforeach; ?>
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
        <button type="submit" class="btn btn-secondary" id="submit-invoice">Generate Invoice</button>
    </div>
</form>