<?php
class Journalist_model extends CI_Model {

        public function __construct()
        {

        }

        public function get_all($ranking = false, $categories = false, $periodicities = false, $media_types = false, $provinces = false, $national_circulation = false, $white_list = false, $black_list = false)
        {

                $this->db->select('journalists.*');

                // add journalistic heads
                $this->db
                     ->join('journalist_journalistic_head', 'journalist_journalistic_head.journalist_id = journalists.id', 'left');
               $this->db
                    ->join('journalistic_heads', 'journalist_journalistic_head.journalistic_head_id = journalistic_heads.id', 'left');

                // white list
                if($white_list) {
                        $this->db
                                ->where_in('journalists.id', $white_list)
                                ->or_group_start();
                }

                // other filters
                if($ranking) {
                        $this->db->where('journalists.ranking <=', $ranking);
                }

                if($categories) {
                        $this->db
                                ->join('journalist_category', 'journalist_category.journalist_id = journalists.id', 'left')
                                ->where_in('journalist_category.category_id', $categories);
                }

                if($periodicities) {
                        $this->db
                                ->join('periodicity_types', 'periodicity_types.id = journalistic_heads.periodicity', 'left')
                                ->where_in('journalistic_heads.periodicity', $periodicities);
                }

                if($media_types) {
                        $this->db
                                ->join('journalistic_head_media_type', 'journalistic_heads.id = journalistic_head_media_type.journalistic_head_id', 'left')
                                ->where_in('journalistic_head_media_type.media_type_id', $media_types);
                }

                if($provinces) {
                        $this->db
                                ->where_in('journalistic_heads.province', $provinces);
                }

                if($national_circulation === 'true') {
                        $this->db
                                ->where('journalistic_heads.national_circulation', 1);
                }

                if($black_list) {
                        $this->db
                                ->where_not_in('journalists.id', $black_list);
                };

                // if white list close group of other filters
                if($white_list) {
                        $this->db->group_end();
                }

                $this->db->group_by('email')->distinct();
                $query = $this->db->get('journalists');
                // var_dump($this->db->last_query()); exit;
                return $query->result_array();
        }

        public function get($id)
        {
                $query = $this->db->get_where('journalists', array('id' => $id));
                $result = $query->result_object();
                $journalist = $result[0];
                $journalist->categories = $this->getCategories($id);
                $journalist->journalistic_heads = $this->getJournalisticHeads($id);

                return $journalist;
        }

        public function getByMail($mail)
        {
                $query = $this->db->get_where('journalists', array('email' => $mail));
                $result = $query->result_object();

                return $result[0];
        }

        public function insert($data)
        {
                return $this->db->insert('journalists', $data);
        }

        public function delete($id)
        {
                $this->db->where('id', $id);
                $this->db->delete('journalists');
        }

        public function update($id, $data)
        {
                $this->db->where('id', $id);
                return $this->db->update('journalists', $data);
        }

        public function getCategories($id) {
                $query = $this->db
                        ->select('categories.id, categories.name')
                        ->from('journalist_category')
                        ->join('categories', 'categories.id = journalist_category.category_id')
                        ->where(array('journalist_category.journalist_id' => $id))->get();

                $results = $query->result();

                $categories = array();
                foreach($results as $category) {
                        // TODO check why doesn't return integer
                        $categories[] = $category;
                }

                return $categories;
        }

        public function addCategories($journalist_id, $categories) {
                if(!is_integer($journalist_id)) {
                        show_error("Journalist must be an integer", "500");
                        return false;
                }
                if(!is_array($categories)) {
                        show_error("Categories must be an array", "500");
                        return false;
                }
                foreach($categories as $category) {
                        $data = array(
                                "journalist_id" => $journalist_id,
                                "category_id" => $category
                        );
                        $this->db->insert('journalist_category', $data);
                }
        }

        public function removeAllCategories($journalist_id) {
                $this->db->where('journalist_id', $journalist_id);
                return $this->db->delete('journalist_category');
        }

        public function updateCategories($journalist_id, $categories) {
                if($this->removeAllCategories($journalist_id)) {
                        return $this->addCategories($journalist_id, $categories);
                }
        }

        public function getJournalisticHeads($id) {
                $query = $this->db
                        ->select('journalistic_heads.id, journalistic_heads.name')
                        ->from('journalist_journalistic_head')
                        ->join('journalistic_heads', 'journalistic_heads.id = journalist_journalistic_head.journalistic_head_id')
                        ->where(array('journalist_journalistic_head.journalist_id' => $id))->get();

                $results = $query->result();

                $journalistic_heads = array();
                foreach($results as $journalistic_head) {
                        $journalistic_heads[] = $journalistic_head;
                }

                return $journalistic_heads;
        }

        public function addJournalisticHeads($journalist_id, $journalistic_heads) {
                if(!is_integer($journalist_id)) {
                        show_error("Journalist must be an integer", "500");
                        return false;
                }
                if(!is_array($journalistic_heads)) {
                        show_error("Categories must be an array", "500");
                        return false;
                }
                foreach($journalistic_heads as $journalistic_head) {
                        $data = array(
                                "journalist_id" => $journalist_id,
                                "journalistic_head_id" => $journalistic_head
                        );
                        $this->db->insert('journalist_journalistic_head', $data);
                }
        }

        public function removeAllJournalisticHeads($journalist_id) {
                $this->db->where('journalist_id', $journalist_id);
                return $this->db->delete('journalist_journalistic_head');
        }

        public function updateJournalisticHeads($journalist_id, $journalistic_heads) {
                if($this->removeAllJournalisticHeads($journalist_id)) {
                        return $this->addJournalisticHeads($journalist_id, $journalistic_heads);
                }
        }

}
