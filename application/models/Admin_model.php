<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function insert($table, $data)
    {
        $this->db->insert($table,$data);
        $num = $this->db->insert_id();
        if($num)
        {
            return $num;
        }
        else
        {
            return FALSE;
        }
    }

    function update($table,$where,$data)
    {
        $this->db->where($where );
        $update = $this->db->update($table,$data);

        if($update)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function delete($table,$where)
    {
        $this->db->where($where);
        $this->db->limit('1');
        $del = $this->db->delete($table);
        if($del){
                return true;
        }else{
                return false;
        }
    }
    
    function deleteAll($table,$where)
    {
        $this->db->where($where);
        $del = $this->db->delete($table);
        if($del){
                return true;
        }else{
                return false;
        }
    }

    function getRows($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            return $result->result();
        }
        else
        {
            return false;
        }
    }

    function getRow($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            return $result->row();
        }
        else
        {
            return false;
        }
    }
    
    function getOne($table)
    {
        $data = $this->db->get($table);
        $get = $data->row();
        $num = $data->num_rows();
        if($num)
        {
            return $get;
        }
        else
        {
            return false;
        }
    }

    function getVal($str_query)
    {
        $result = $this->db->query($str_query);
        $numofrecords = $result->num_rows();
        if($numofrecords> 0)
        {
            foreach ($result->row() as $onefield)
            {
                return $onefield;
            }
        }
        else
        {
            return false;
        }
    }

    /******************************************/

    function getAll($table)
    {
        $data = $this->db->get($table);
        $get = $data->result();
        $num = $data->num_rows();
        if($num)
        {
            return $get;
        }
        else
        {
            return false;
        }
    }

    function getWhere($table,$where)
    { 
        //print_r($where);
        $this->db->where($where);
        $getdata = $this->db->get($table);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            //print_r($arr);exit;
            foreach ($arr as $rows)
            {
                    $data[] = $rows;
            }
            $getdata->free_result();
            return $data;
        }
        else
        {
            return false;
        }
    }

    function getCustom($str_query)
    {
        $getdata = $this->db->query($str_query);
        $num = $getdata->num_rows();
        if($num> 0)
        {
            $arr=$getdata->result();
            foreach ($arr as $rows)
            {
                $data[] = $rows;
            }
            $getdata->free_result();
            return $data;

        }
        else
        {
            return false;
        }
    }



     #Start query for ajax data table================================================================
    private function _get_datatables_query($table,$column_order="",$column_search="",$order="")
    {

        $this->db->from($table);

        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {

                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($table,$column_order,$column_search,$order,$where_col="",$where_in_array="",$where="")
    {

        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($table,$column_order,$column_search,$order,$where_col="",$where_in_array="",$where="")
    {
        $this->_get_datatables_query($table,$column_order,$column_search,$order);
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table,$where_col="",$where_in_array="",$where="")
    {
        if($where_col && $where_in_array)
        {
            $this->db->where_in($where_col, $where_in_array);
        }
        if($where)
        {
            $this->db->where($where);
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    #End query for ajax data table====================================================================
}