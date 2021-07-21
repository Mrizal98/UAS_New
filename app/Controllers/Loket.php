<?php

namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\LoketModel;
use App\Models\AntrianModel;
 
class Loket extends Controller
{
 
    public function __construct() {
 
        // Mendeklarasikan class ProductModel menggunakan $this->product
        // $this->layanan = new PelayananModel();
        $this->loket = new LoketModel();
        $this->antrian = new AntrianModel();
        /* Catatan:
        Apa yang ada di dalam function construct ini nantinya bisa digunakan
        pada function di dalam class Product 
        */
    }
 
    public function index()
    {   
        $data['antrian'] = $this->antrian->getDatastatus();
        $data['loket'] = $this->loket->getData();
        echo view('loket', $data);
    } 
    public function getAntrianloket () {
         $data = $this->antrian->getDatastatus();

      echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function insert () {
    
    $pelayan_id = $this->request->getPost('pelayan_id');
    $loket_id = $this->request->getPost('loket_id');
    $id_antrian = $this->request->getPost('id_antrian');
    $waktuskrg =  date('Y-m-d H:i:s');
 
    // // Membuat array collection yang disiapkan untuk insert ke table
    $data1 = [
        'pelayan_id' => $pelayan_id,
        'loket_id' => $loket_id
    ];
    $data2 = [
        'status' => 'dilayani',
        'waktu_panggil' => $waktuskrg,
        'id' => $id_antrian,
        'loket_id' => $loket_id
    ];
 
    /* 
    Membuat variabel simpan yang isinya merupakan memanggil function 
    insert_product dan membawa parameter data 
    */
    $this->loket->update_data($data1);
    $this->loket->changeantrian($data2);
    
   
     $res = ['status' => 'insert sukses'];

     return json_encode($res);
 
 
    // // Jika simpan berhasil, maka ...

    }

    public function getdetail($id){
        $loket_id = $this->request->getPost('loket_id');
       $data = $this->loket->detail($id);
       return json_encode($data, JSON_PRETTY_PRINT);
 
 
    }
    public function selesai() {
    $loket_id = $this->request->getPost('loket_id');
    $id_antrian = $this->request->getPost('id_antrian');
    $waktuskrg =  date('Y-m-d H:i:s');
    $data1 = [
        'loket_id' => $loket_id
    ];
    $data2 = [
        'waktu_selesai' => $waktuskrg,
        'id_antrian' => $id_antrian,
        'status' => 'selesai'
    ];
     $this->loket->reset_loket($data1);
    $this->loket->antrian_selesai($data2);
    
   
     $res = ['status' => 'insert sukses'];

     return json_encode($res);
    }

     public function tidakada() {
    $loket_id = $this->request->getPost('loket_id');
    $id_antrian = $this->request->getPost('id_antrian');
    $waktuskrg =  date('Y-m-d H:i:s');
    $data1 = [
        'loket_id' => $loket_id
    ];
    $data2 = [
        'waktu_selesai' => $waktuskrg,
        'id_antrian' => $id_antrian,
        'status' => 'tidak_ada'
    ];
     $this->loket->reset_loket($data1);
    $this->loket->antrian_selesai($data2);
    
   
     $res = ['status' => 'insert sukses'];

     return json_encode($res);
    }

public function getdashboard(){
      $data = $this->antrian->getdashboard();

      echo json_encode($data, JSON_PRETTY_PRINT);
}

}