<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate_pdf_controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Invoice_model");
		$this->load->model("Tiket_model");
		$this->load->library('form_validation');
		$this->load->library('Pdf'); // Pdf library
	}

	// Invoice tiket
	public function index($id)
	{
		$data['title_pdf'] = 'Laporan Invoice'; // title
		$data['invoice'] = $this->Invoice_model->getPdfData($id);
		$data['tiket'] = $this->Tiket_model->invoiceListTiket($data['invoice']->no_invoice, $data['invoice']->divisi_id);

		$inv = $data['invoice'];
		$total = $inv->total_hpp + $inv->total_service_fee + $inv->total_biaya_lain + $inv->total_harga_jual; // menjumlahkan total;

		$data['terbilang'] = $this->terbilang($total); // fungsi terbilang;

		// ubah status invoice jika masih unprocess
		// if ($inv->status == 0) {
		// 	$this->update_status_invoice($id);
		// }

		// Mengambil tahun dan bulan saja
		$time = strtotime($inv->created_date);
		$date = date('d', $time);
		$month = date("m", $time);
		$year = date("Y", $time);
		// end

		$file_pdf = 'INV-' . $year . '-' . $month . '-' . $date . '-' . $inv->no_invoice; // ubah nama file pdf disini
		$paper = 'A4'; // tipe ukuran kertas pdf
		$orientation = "portrait"; // pdf orientation

		$html = $this->load->view('pdf/generatePdf', $data, true); // ambil html yang digunakan untuk pdf

		$this->pdf->generate($html, $file_pdf, $paper, $orientation); // ubah html menjadi view pdf;
	}

	// Pdf per tiket
	public function tiket($id)
	{
		$tiket = $this->Tiket_model;
		$data['tiket'] = $tiket->getById($id);
		$data['title_pdf'] = 'Laporan Tiket';

		$file_pdf = $data['tiket']->kode_booking; // ubah nama pdf disini
		$paper = 'A4'; // tipe ukuran pdf
		$orientation = "portrait"; // pdf orientation

		$html = $this->load->view('pdf/generatePdfTiket', $data, true); // ambil html yang digunakan untuk pdf

		$this->pdf->generate($html, $file_pdf, $paper, $orientation); // ubah html menjadi view pdf;
	}

	// conversi number menjadi terbilang
	public function penyebut($nilai)
	{
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " " . $huruf[$nilai];
		} else if ($nilai < 20) {
			$temp = $this->penyebut($nilai - 10) . " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
		}
		return $temp;
	}

	public function terbilang($nilai)
	{
		if ($nilai < 0) {
			$hasil = "minus " . trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}
		return $hasil;
	}

	// update status invoice
	public function update_status_invoice($id)
	{
		$this->db->where('id', $id);
		$this->db->update('invoice2', ['status' => 1]);
	}
}
