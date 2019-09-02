<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jenisbuah_model extends CI_Model
{
    private $_table = "jenis";

    public $jenis_id;
    public $name;
    public $description;
public function rules ()
{
    return [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ],
        [
            'field' => 'description',
            'label' => 'Description'
        ]
        ];
}
public function getAll()
{
    return $this->db->get($this->_table)->result();
}
public function getById($id)
{
    return $this->db->get_where($this->_table, ["jenis_id" => $id])->row();
}
public function save()
{
    $post = $this->input->post();
    $this->jenis_id = uniqid();
    $this->name = $post["name"];
    $this->description = $post["description"];
    $this->db->insert($this->_table, $this);
}
public function update()
{
    $post = $this->input->post();
    $this->jenis_id = $post["id"];
    //$this->jenis_id = $posts["id"];
    $this->name = $post["name"];
    $this->description = $post["description"];
    $this->db->update($this->_table, $this, array('jenis_id'=> $post['id']));
}
public function delete($id)
{
    return $this->db->delete($this->_table, array("jenis_id" => $id));
}
}