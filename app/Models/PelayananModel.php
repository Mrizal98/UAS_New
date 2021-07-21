<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class PelayananModel extends Model
{
    protected $table = "pelayanan";
 
    public function getData($id = false)
    {
        if($id === false){
            return $this->table('pelayanan')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('pelayanan')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
    public function insert_pelayanan($data) 
    {
    return $this->db->table($this->table)->insert($data);
	} 


}