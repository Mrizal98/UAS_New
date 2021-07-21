<?php 
 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\PelayananModel;
use App\Models\AntrianModel;
 
class Antrian extends Controller
{
 
    public function __construct() {
 
        // Mendeklarasikan class ProductModel menggunakan $this->product
        $this->layanan = new PelayananModel();
        $this->antrian = new AntrianModel();
        /* Catatan:
        Apa yang ada di dalam function construct ini nantinya bisa digunakan
        pada function di dalam class Product 
        */
    }
 
    public function index()
    {
         $data['layanan'] = $this->layanan->getData();
        echo view('antrian', $data);
    } 

    public function insert () {
    
    $id_pelayanan = $this->request->getPost('id_pelayan');
    $tanggal = $this->request->getPost('tanggal');
    $no_antrian = $this->request->getPost('no_antrian');
 
    // // Membuat array collection yang disiapkan untuk insert ke table
    $data = [
        'pelayanan_id' => $id_pelayanan,
        'tanggal' => $tanggal,
        'no_antrian' => $no_antrian,
        'status' => 'belum',
        'waktu_selesai' => null,
        'waktu_panggil' => null
    ];
 
    /* 
    Membuat variabel simpan yang isinya merupakan memanggil function 
    insert_product dan membawa parameter data 
    */
     $this->antrian->insert_data($data);
    
     $res = ['status' => 'insert sukses'];

     return json_encode($data);
 
 
    // // Jika simpan berhasil, maka ...

    }
}