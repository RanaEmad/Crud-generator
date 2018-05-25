<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function index()
	{
            $this->load->view("crud");
//            $this->load->library("form_validation");
//            $this->form_validation->set_rules("fields_no","No of Fields","trim|required|xss_clean|numeric");
//            $this->form_validation->set_rules("table_name","Table Name in Database","trim|required|xss_clean");
//            if(!$this->form_validation->run()){
//            }
//            else{
//                $fields= $this->input->post("fields");
//                $view= $this->generate_view();
//                $add= $this->generate_add();
//                $edit= $this->generate_edit();
//                $delete = $this->generate_delete();
//                $data['load']=0;
//                $data['view']=$view;
//                $data['add']=$add;
//                $data['edit']=$edit;
//                $data['delete']=$delete;
//            }
            
//		$add='public function add(){
//            $this->load->model("Crud_model");
//            $this->load->library("form_validation");
//            $this->form_validation->set_rules("field",  "label","trim|xss_clean|required");
//            if(!$this->form_validation->run()){
//                $this->load->view();
//            }
//            else {
//                $data=array(
//                    "field"=>  $this->input->post("field")
//                );
//                $this->Crud_model->insert("table",$data);
//                redirect(base_url("tablename"));
//            }
//            }';
//                echo $add;
	}
        function generate_code(){
            $response['result']="success";
            $this->load->library("form_validation");
            $this->form_validation->set_rules("fields_no","No of Fields","trim|required|numeric");
            $this->form_validation->set_rules("table_name","Table Name in Database","trim|required");
            if(!$this->form_validation->run()){
                $response['result']="fail";
                $response['error']=  validation_errors();
            }
            else{
                $table_name= $this->input->post("table_name");
                $fields=  $this->input->post("fields[]");
                $validation_rules='';
                $array_fields='';
                $add["model"]="";
                $add["view"]="";
                foreach($fields as $field){
                    $validation_rules.='$this->form_validation->set_rules("'.$field.'",  "'.$field.'","trim|required");
                    ';
                    $array_fields.='"'.$field.'"=>  $this->input->post("'.$field.'"),
                            ';
                }
                $add["back"]='public function add(){
                    $this->load->model("Crud_model");
                    $this->load->library("form_validation");
                    '.$validation_rules.
                    '
                        if(!$this->form_validation->run()){
                        $this->load->view("add_'.$table_name.'_view");
                    }
                    else {
                        $data=array(
                            '.$array_fields.
                        ');
                        $this->Crud_model->insert("'.$table_name.'",$data);
                        $this->session->set_flashdata("success","Data Submitted Successfully!");
                        redirect(base_url("'.$table_name.'"));
                    }

                }';
                $edit["back"]='public function edit($id){
                    $this->load->model("Crud_model");
                    $this->load->library("form_validation");
                    '.$validation_rules.
                    '
                        if(!$this->form_validation->run()){
                        $one=$this->Crud_model->get_one("'.$table_name.'",$id);
                        $data["one"]=$one;
                        $this->load->view("edit_'.$table_name.'_view",$data);
                    }
                    else {
                        $data=array(
                            '.$array_fields.
                        ');
                        $this->Crud_model->update("'.$table_name.'",$id,$data);
                        $this->session->set_flashdata("success","Data Submitted Successfully!");
                        redirect(base_url("'.$table_name.'"));
                    }

                }';
                $delete['back']='public function delete(){
                    $id = $this->input->post("id");
                    $this->Crud_model->delete("'.$table_name.'",$id);
                    $this->session->set_flashdata("success","Data Deleted Successfully!");
                    redirect(base_url("'.$table_name.'"));
                }';
                $response['add']=$add;
                $response['delete']=$delete;
                $response['edit']=$edit;
                
            }
            echo json_encode($response);
        }


        public function generate_form(){
             $fields= $this->input->post("fields");
                $view= $this->generate_view();
                $add= $this->generate_add();
                $edit= $this->generate_edit();
                $delete = $this->generate_delete();
                $data['load']=0;
                $data['view']=$view;
                $data['add']=$add;
                $data['edit']=$edit;
                $data['delete']=$delete;
                $this->load->view("generate_form",$data);
        }
        
        public function generate_view(){
            
            $this->load->model("Crud_model");
            $rows= $this->Crud_model->get_all($table);
            $data['rows']= $rows;
            $this->load->view("",$data);
        }


        public function generate_add(){
            $fields= $this->input->post("fields[]");
            $this->load->model("Crud_model");
            $this->load->library("form_validation");
            $this->form_validation->set_rules("field",  "label","trim|xss_clean|required");
            if(!$this->form_validation->run()){
                $this->load->view();
            }
            else {
                $data=array(
                    "field"=>  $this->input->post("field")
                );
                $this->Crud_model->insert("table",$data);
                $this->session->set_flashdata("success","Data Submitted Successfully!");
                redirect(base_url("tablename"));
            }
            
        }
        public function generate_edit($id){
            $this->load->model("Crud_model");
            $this->load->library("form_validation");
            $one= $this->Crud_model->get_one("table",$id);
            $this->form_validation->set_rules("field",  "label","trim|xss_clean|required");
            if(!$this->form_validation->run()){
                $data['one']=$one;
                $this->load->view();
            }
            else {
                $data=array(
                    "field"=>  $this->input->post("field")
                );
                $this->Crud_model->update("table",$id,$data);
                $this->session->set_flashdata("success","Data Submitted Successfully!");
                redirect(base_url("tablename"));
            }
            
        }
        
        public function generate_delete(){
            $id = $this->input->post("id");
            $this->Crud_model->delete("table",$id);
            $this->session->set_flashdata("success","Data Deleted Successfully!");
            redirect(base_url("tablename"));
        }
}
