<?php
class Category_model extends CI_Model {

        public function __construct()
        {

        }

        public function get_all()
        {

                $query = $this->db->get('categories');
                return $query->result_object();

        }

        public function get($id)
        {
                $query = $this->db->get_where('categories', array('id' => $id));
                $result = $query->result_object();

                return $result[0];
        }

        public function update($id, $data)
        {
                $this->db->where('id', $id);
                return $this->db->update('categories', $data);
        }

        public function insert($data)
        {
                $this->db->insert('categories', $data);
        }

        public function delete($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('categories');
        }

}
