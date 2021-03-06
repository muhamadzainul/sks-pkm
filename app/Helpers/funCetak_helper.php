<?php

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        // $image_file = K_PATH_IMAGES . 'Logo-Mojokerto.png';
        // $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $image_file = "<img src=\"/gambar/Logo-Mojokerto.png\" width=\"45px\"/>";
        $image_file2 = "<img src=\"/gambar/Logo_Puskesmas.png\" width=\"45px\"/>";
        $this->SetY(10);
        $this->SetFont('helvetica', 'I', 7);
        // Page number
        $this->Cell(0, 10, date('d F Y'), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Surat Kesehatan UPT Puskesmas Dawarblandong', 0, false, 'R', 0, '', 0, false, 'T', 'M');
        $isi_header = "<small style=\"text-align: right;\"><i></i></small><br><br><br>
                    <table align=\"left\">
                        <tr>
                            <td>" . $image_file . "</td>
                            <td colspan=\"5\" align=\"center\">
                                <b style=\"font-size: 12px; font-family: 'helvetica', sans-serif;\" >
                                PEMERINTAH KABUPATEN MOJOKERTO<br>
                                DINAS KESEHATAN<br>
                                UPT PUSKESMAS DAWARBLANDONG
                                </b>
                                <br>
                                <small style=\"font-size: 7px;\">Jl. Mayjen Sungkono No.17, Sidokerto, Dawarblandong, Dawar Blandong, Kabupaten Mojokerto, Jawa Timur 61354</small><br>
                                <small style=\"font-size: 7px;\">Email : pkmdawar@gmail.com Telp : 082332680507</small>
                            </td>
                            <td align=\"right\">" . $image_file2 . " </td>
                        <hr>
                        </tr>
                    </table>";
        $this->writeHTML($isi_header, true, false, false, false, '');
        // // Set font
        // $this->SetFont('helvetica', 'B', 16);
        // // Title
        // $this->Cell(0, 15, 'Dinas Kesehatan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Surat Kesehatan UPT Puskesmas Dawarblandong', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Cek Validasi : ' . base_url() . '/validasi', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
class MYPDF2 extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        // $image_file = K_PATH_IMAGES . 'Logo-Mojokerto.png';
        // $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // $image_file = "<img src=\"/gambar/Logo-Mojokerto.png\" width=\"45px\"/>";
        // $image_file2 = "<img src=\"/gambar/Logo_Puskesmas.png\" width=\"45px\"/>";
        $this->SetY(10);
        $isi_header = "<small style=\"text-align: right;\"><i>Surat Izin UPT Puskesmas Dawarblandong</i></small><br><br>
                    ";
        $this->writeHTML($isi_header, true, false, false, false, '');
        // // Set font
        // $this->SetFont('helvetica', 'B', 16);
        // // Title
        // $this->Cell(0, 15, 'Dinas Kesehatan', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Surat Izin UPT Puskesmas Dawarblandong', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, base_url() . '/validasi', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
