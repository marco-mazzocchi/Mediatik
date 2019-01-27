<?php
class MediaType_model extends CI_Model {

        public function __construct()
        {

        }

        public function get_all()
        {
                $query = $this->db->get('media_types');
                return $query->result_object();
        }

        public function get($id)
        {
                $query = $this->db->get_where('media_types', array('id' => $id));
                $result = $query->result_object();

                return $result[0];
        }

        public function update($id, $data)
        {
                $this->db->where('id', $id);
                return $this->db->update('media_types', $data);
        }

        public function insert($data)
        {
                $this->db->insert('media_types', $data);
        }

        public function delete($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('media_types');
        }

}
