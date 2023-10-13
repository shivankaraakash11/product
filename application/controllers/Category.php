<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index()
	{
		$this->load->view('add_category');
	}

    public function save()
    {
		$data = array(
            'category_name'=> $this->input->post('category_name')
        );
		
		$insert = $this->db->insert('product_category', $data);
		if($insert){
			$this->messages->add('Create Category Successfully','alert-success');
			redirect(base_url().'Category');
		}
	}

    public function edit($id)
	{
		$data['single_data']=$this->Admin_model->getRow('select * from product_category where id="'.$id.'"');
		$this->load->view('add_category',$data);
	}


	public function edit_save()
	{
		$where=array(
			'id' => $this->input->post('id')
		);
        
		$array=array(
			'category_name'=> $this->input->post('category_name')
		);

		$update = $this->Admin_model->update('product_category',$where,$array);
        if($update)
        {
            $this->messages->add('Category Edited Successfully','alert-success');
            redirect(base_url().'Category');
        }
	}


	public function delete($id)
	{
		$where=array(
			'id' => $id
		);
		$delete = $this->Admin_model->delete('product_category',$where);
        if($delete)
        {
            $this->messages->add('Category Deleted Successfully','alert-danger');
            redirect(base_url().'Category');
        }
	}
}
