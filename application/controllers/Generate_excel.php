<?php defined('BASEPATH') or die('No direct script access allowed');

require('./application/third_party/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment as StyleAlignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Menggunakan PhpSpreadsheet
// Dokumentasi lengkap dapat di lihat disini
// https://phpspreadsheet.readthedocs.io/en/latest/
class Generate_excel extends MY_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('Tiket_model');
   }

   // Excel Customer
   public function exportCustomer($no_invoice, $divisi_id)
   {
      $semua_tiket = $this->Tiket_model->invoiceListTiket($no_invoice, $divisi_id); // ambil data tiker

      $spreadsheet = new Spreadsheet;

      // mengatur style border, font dan aligment pada excel
      $styleArray = [
         'font' => [
            'bold' => true,
            'size' => 20,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'shrinkToFit' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_FILL,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      $styleArray2 = [
         'font' => [
            'bold' => true,
            'size' => 14,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      $styleArray3 = [
         'font' => [
            'size' => 12,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      // END

      // Mengambil tahun dan bulan saja
      $time = strtotime($semua_tiket[0]->tgl_issued);
      $month = date("F", $time);
      $year = date("Y", $time);

      $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:H3'); // merge cell pada excel
      $spreadsheet->getActiveSheet()->getStyle('A1:H3')->applyFromArray($styleArray); // menerapkan style untuk cell A1:H3
      $spreadsheet->getActiveSheet()->getCell('A1')->setValue("DAFTAR PENJUALAN TIKET DIVISI " . $semua_tiket[0]->nama_divisi . ' BULAN ' . $month . ' ' . $year); // Header Excel

      // Membuat cell menjadi autosize
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
      // end

      $spreadsheet->getActiveSheet()->getStyle('A4:H4')->applyFromArray($styleArray2); // Set styel untuk cell di bawah;
      $spreadsheet->getActiveSheet()->getCell('A4')->setValue("NO");
      $spreadsheet->getActiveSheet()->getCell('B4')->setValue("TANGGAL ISSUED");
      $spreadsheet->getActiveSheet()->getCell('C4')->setValue("TANGGAL BERANGKAT");
      $spreadsheet->getActiveSheet()->getCell('D4')->setValue("NAMA");
      $spreadsheet->getActiveSheet()->getCell('E4')->setValue("NIP");
      $spreadsheet->getActiveSheet()->getCell('F4')->setValue("MASKAPAI");
      $spreadsheet->getActiveSheet()->getCell('G4')->setValue("HARGA TOTAL");
      $spreadsheet->getActiveSheet()->getCell('H4')->setValue("BOOKERS");
      //end

      $kolom = 5; // Nomor cell
      $nomor = 1; // Nomor
      $harga_total = 0; // Menghitung total

      // loop data tiket
      foreach ($semua_tiket as $tiket) {

         $harga_total += $tiket->harga_jual; // penjumlahan total

         // Generat data tiket ke dalam excel
         $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom, $tiket->tgl_issued)
            ->setCellValue('C' . $kolom, $tiket->tgl_berangkat)
            ->setCellValue('D' . $kolom, $tiket->nama_customer)
            ->setCellValue('E' . $kolom, $tiket->nip_customer)
            ->setCellValue('F' . $kolom, $tiket->nama_maskapai)
            ->setCellValue('G' . $kolom, 'Rp.' . number_format($tiket->harga_jual, 0, ',', '.'))
            ->setCellValue('H' . $kolom, $tiket->bookers);

         $kolom++;
         $nomor++;
      }

      $a = $kolom + 3; // Digunakan untuk menempatkan cell biaya materai dan area border;
      $b = $a - 1; // Digunakan untuk menempatkan cell total;

      // Biaya materai dan total;
      $spreadsheet->getActiveSheet()->getCell('D' . $b)->setValue('Biaya Materai');
      $spreadsheet->getActiveSheet()->getCell('D' . $a)->setValue('Total');
      $spreadsheet->getActiveSheet()->getCell('G' . $b)->setValue('Rp. 15.000');
      $spreadsheet->getActiveSheet()->getCell('G' . $a)->setValue('Rp.' . number_format($harga_total+15000, 0, ',', '.'));
      // end

      // Area border data tiket
      $spreadsheet->getActiveSheet()->getStyle('A5:H' . $a)->applyFromArray($styleArray3);
      // end

      // Rata kiri harga materai dan total
      $spreadsheet->getActiveSheet()->getStyle('D'.$b)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);
      $spreadsheet->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);
      // end

      // rata kanan harga materai dan jumlah total
      $spreadsheet->getActiveSheet()->getStyle('G'.$b)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('G'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      // end

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Cetak_customer ' . $semua_tiket[0]->nama_divisi . ' ' . $month . '-' . $year . '.xlsx"'); // atur nama file excel disini
      header('Cache-Control: max-age=0');

      $writer->save('php://output'); // download file excel;
   }


   // Excel Akunting
   public function exportAkunting($no_invoice, $divisi_id){
      $semua_tiket = $this->Tiket_model->invoiceListTiket($no_invoice, $divisi_id); // ambil data tiket;

      $spreadsheet = new Spreadsheet;

      // mengatur style border, font dan aligment pada excel
      $styleArray = [
         'font' => [
            'bold' => true,
            'size' => 20,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            'shrinkToFit' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_FILL,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      $styleArray2 = [
         'font' => [
            'bold' => true,
            'size' => 14,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      $styleArray3 = [
         'font' => [
            'size' => 12,
         ],
         'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
         ],
         'borders' => [
            'allBorders' => [
               'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
               'color' => ['argb' => '00000000'],
            ],
         ],
      ];
      // end

      // Mengambil tahun dan bulan saja
      $time = strtotime($semua_tiket[0]->tgl_issued);
      $month = date("F", $time);
      $year = date("Y", $time);
      // end

      $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:J3'); // merge cell pada excel
      $spreadsheet->getActiveSheet()->getStyle('A1:J3')->applyFromArray($styleArray); // menerapkan style untuk cell A1:H3
      $spreadsheet->getActiveSheet()->getCell('A1')->setValue("DAFTAR PENJUALAN TIKET DIVISI " . $semua_tiket[0]->nama_divisi . ' BULAN ' . $month . ' ' . $year); // Header Excel

      // Membuat cell menjadi autosize
      $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
      $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
      // end

      $spreadsheet->getActiveSheet()->getStyle('A4:J4')->applyFromArray($styleArray2); // Set styel untuk cell di bawah;
      $spreadsheet->getActiveSheet()->getCell('A4')->setValue("NO");
      $spreadsheet->getActiveSheet()->getCell('B4')->setValue("TANGGAL ISSUED");
      $spreadsheet->getActiveSheet()->getCell('C4')->setValue("TANGGAL BERANGKAT");
      $spreadsheet->getActiveSheet()->getCell('D4')->setValue("NAMA");
      $spreadsheet->getActiveSheet()->getCell('E4')->setValue("NIP");
      $spreadsheet->getActiveSheet()->getCell('F4')->setValue("MASKAPAI");
      $spreadsheet->getActiveSheet()->getCell('G4')->setValue("HARGA TOTAL");
      $spreadsheet->getActiveSheet()->getCell('H4')->setValue("SERVICE FEE");
      $spreadsheet->getActiveSheet()->getCell('I4')->setValue("HPP");
      $spreadsheet->getActiveSheet()->getCell('J4')->setValue("BOOKERS");
      // end

      $kolom = 5; // Nomor cell
      $nomor = 1; // Nomor
      $harga_total = 0; // Menghitung total
      $total_service_fee = 0; // Menghitung service fee
      $total_hpp = 0; // Menghitung hpp

      // loop data tiket
      foreach ($semua_tiket as $tiket) {

         $harga_total += $tiket->harga_jual; // menjumlahkan harga jual
         $total_service_fee +=$tiket->service_fee; // menjumlahkam service fee
         $total_hpp += $tiket->hpp; // menjumlahkan hpp

         // Generat data tiket ke dalam excel
         $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom, $tiket->tgl_issued)
            ->setCellValue('C' . $kolom, $tiket->tgl_berangkat)
            ->setCellValue('D' . $kolom, $tiket->nama_customer)
            ->setCellValue('E' . $kolom, $tiket->nip_customer)
            ->setCellValue('F' . $kolom, $tiket->nama_maskapai)
            ->setCellValue('G' . $kolom, 'Rp.' . number_format($tiket->harga_jual, 0, ',', '.'))
            ->setCellValue('H' . $kolom, 'Rp.' . number_format($tiket->service_fee, 0, ',', '.'))
            ->setCellValue('I' . $kolom, 'Rp.' . number_format($tiket->hpp, 0, ',', '.'))
            ->setCellValue('J' . $kolom, $tiket->bookers);

         $kolom++;
         $nomor++;
      }

      $a = $kolom + 3; // Digunakan untuk menempatkan cell biaya materai dan area border;
      $b = $a - 1; // Digunakan untuk menempatkan cell total;

      // Biaya materai dan total;
      $spreadsheet->getActiveSheet()->getCell('D' . $b)->setValue('Biaya Materai');
      $spreadsheet->getActiveSheet()->getCell('D' . $a)->setValue('Total');
      $spreadsheet->getActiveSheet()->getCell('G' . $b)->setValue('Rp. 15.000');
      $spreadsheet->getActiveSheet()->getCell('G' . $a)->setValue('Rp.' . number_format($harga_total+15000, 0, ',', '.'));
      $spreadsheet->getActiveSheet()->getCell('H' . $a)->setValue('Rp.' . number_format($total_service_fee, 0, ',', '.'));
      $spreadsheet->getActiveSheet()->getCell('I' . $a)->setValue('Rp.' . number_format($total_hpp, 0, ',', '.'));
      // end

      // Area border data tiket
      $spreadsheet->getActiveSheet()->getStyle('A5:J' . $a)->applyFromArray($styleArray3);
      // end

      // Rata kiri harga materai dan total
      $spreadsheet->getActiveSheet()->getStyle('D'.$b)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);
      $spreadsheet->getActiveSheet()->getStyle('D'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_LEFT);
      // end
      
      // Rata kanan harga materai dan total
      $spreadsheet->getActiveSheet()->getStyle('G'.$b)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('G'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('H'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('I'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      $spreadsheet->getActiveSheet()->getStyle('J'.$a)->getAlignment()->setHorizontal(StyleAlignment::HORIZONTAL_RIGHT);
      // end

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="Cetak_akunting ' . $semua_tiket[0]->nama_divisi . ' ' . $month . '-' . $year . '.xlsx"'); // ubah nama file excel disini
      header('Cache-Control: max-age=0');

      $writer->save('php://output'); //download file excel
   }
}
