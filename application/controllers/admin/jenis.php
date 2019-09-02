<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class jenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Jenisbuah_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["jenisbuah"] = $this->Jenisbuah_model->getAll();
        $this->load->view("admin/jenisbuah/list", $data);
    }
    public function add()
    {
        $jenisbuah = $this->Jenisbuah_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenisbuah->rules());

        if ($validation->run()) {
            $jenisbuah->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/jenisbuah/new_form");
    }
    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/jenis');
        $jenisbuah = $this->Jenisbuah_model;
        $validation = $this->form_validation;
        $validation->set_rules($jenisbuah->rules());
        
        if ($validation->run())
        {
            $jenisbuah->update();
            $this->session->set_flashdata('Succes', 'Berhasil diupdate');
        }
        $data["jenisbuah"] = $jenisbuah->getById($id);
        //if(!$data["jenisbuah"]) show_404();
        if (!$data["jenisbuah"]) show_404();
        $this->load->view('admin/jenisbuah/edit_form', $data);
    }
    // public function edit($id = null)
    // {
    //     if (!isset($id)) redirect('admin/products');
       
    //     $product = $this->Product_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($product->rules());

    //     if ($validation->run()) {
    //         $product->update();
    //         $this->session->set_flashdata('success', 'Berhasil disimpan');
    //     }

    //     $data["product"] = $product->getById($id);
    //     if (!$data["product"]) show_404();
               
    //     $this->load->view("admin/product/edit_form", $data);
    // }
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->jenisbuah_model->delete($id))
        {
            redirect(site_url('admin/jenisbuah'));
        }
    }
    
}