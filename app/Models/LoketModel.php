<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class LoketModel extends Model
{
    protected $table = "loket";
 
    public function getData($id = false)
    {
        if($id === false){
            return $this->table('loket')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('loket')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function insert_data($data) 
    {
   $query = $this->db->table($this->table)->insert($data);

        return $this->db->insertID();
	} 
    public function update_data ($data) {
        $id_loket = $data['loket_id'];
        $pelayan_id = $data['pelayan_id'];
        $this->db->query("UPDATE loket set pelayanan_id = '".$pelayan_id."' WHERE id = '".$id_loket."' ");
    }
    public function changeantrian ($data) {
        $status = $data['status'];
        $id_antrian = $data['id'];
        $waktu = $data['waktu_panggil'];
        $loket_id = $data['loket_id'];
        $this->db->query("UPDATE antrian set loket_id = '".$loket_id."', status = '".$status."', waktu_panggil = '".$waktu."'  WHERE id = '".$id_antrian."' ");
    }
  
    public function detail($data) {
          $id = $data;
          return $this->db->query("SELECT loket.id, loket.nama, pelayanan.nama AS nama_layanan FROM loket  JOIN pelayanan ON loket.pelayanan_id = pelayanan.id WHERE loket.id = '".$id."'") ->getRowArray();}
     
     public function reset_loket($data){
     $this->db->query("UPDATE loket set pelayanan_id = '0' WHERE id = '".$data['loket_id']."' ");

     } 
     
      public function antrian_selesai($data){
     $this->db->query("UPDATE antrian set status = '".$data['status']."', waktu_selesai='".$data['waktu_selesai']."' WHERE id = '".$data['id_antrian']."' ");

     } 
}