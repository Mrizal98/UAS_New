<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class AntrianModel extends Model
{
    protected $table = "antrian";
 
    public function getData($id = false)
    {
        if($id === false){
            return $this->table('antrian')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('antrian')
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

    public function getDatastatus(){
        
      return $this->table('antrian')
                        ->where("(status='belum' OR status='tidak_ada')", NULL, FALSE)
                        ->get()
                        ->getResultArray();
    }
    public function getdashboard(){
        
        return $this->db->query("SELECT antrian.id , antrian.no_antrian, antrian.status,antrian.waktu_panggil, loket.nama AS nama_loket  from antrian JOIN loket ON antrian.loket_id = loket.id WHERE status ='dilayani'") ->getResultArray();
    }


}