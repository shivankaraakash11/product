<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index()
	{
		$this->load->view('add_product');
	}

    public function save()
    {
		$data = array(
            'pro_category' => $this->input->post('pro_category'),
            'pro_name'     => $this->input->post('pro_name')
        );
		
		$insert = $this->db->insert('product', $data);
		if($insert){
			$this->messages->add('Product Added Successfully','alert-success');
			redirect(base_url().'Product');
		}
	}

    public function edit($id)
	{
		$data['single_data']=$this->Admin_model->getRow('select * from product where id="'.$id.'"');
		$this->load->view('add_product',$data);
	}


	public function edit_save()
	{
		$where=array(
			'id' => $this->input->post('id')
		);
        
		$array=array(
			'pro_category' => $this->input->post('pro_category'),
            'pro_name'     => $this->input->post('pro_name')
		);

		$update = $this->Admin_model->update('product',$where,$array);
        if($update)
        {
            $this->messages->add('Product Edited Successfully','alert-success');
            redirect(base_url().'Product');
        }
	}


	public function delete($id)
	{
		$where=array(
			'id' => $id
		);
		$delete = $this->Admin_model->delete('product',$where);
        if($delete)
        {
            $this->messages->add('Product Deleted Successfully','alert-danger');
            redirect(base_url().'Product');
        }
	}

	public function get_search()
	{
		$ser_key=$this->input->post('ser_key');
		//echo $ser_key;exit();
		$product_detail=$this->Admin_model->getRows("select * from product where pro_name LIKE '%".$ser_key."%'");
		//echo $this->db->last_query();exit();
		$i=1;
		foreach($product_detail as $product_details){
			$count=$this->Admin_model->getVal('select count(id) from product where pro_category="'.$product_details->pro_category.'" and pro_name="'.$product_details->pro_name.'"');
			$htl.='<tr>
				<td>'.$i++.'</td>
				<td>'.$product_details->pro_name.'</td>
				<td>'.$product_details->pro_category.'</td>
				<td>'.$count.'</td>
				<td>
					<a class="btn btn-primary" href="'.base_url().'Product/edit/'.$product_details->id.'">Edit</a>

					<a class="btn btn-danger" href="'.base_url().'Product/delete/'.$product_details->id.'">Delete</a>
				</td>
				</tr>';
		}
		echo $htl;
	}
}
