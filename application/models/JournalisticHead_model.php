<?php
class journalisticHead_model extends CI_Model {

   public function __construct()
   {

   }

   public function get_all()
   {

      $query = $this->db
      ->select("journalistic_heads.*, periodicity_types.name as periodicity_name, GROUP_CONCAT(media_types.name SEPARATOR ', ') as media_types")
      ->join('periodicity_types', 'periodicity_types.id = journalistic_heads.periodicity', 'left')
      ->join('journalistic_head_media_type as jhmt', 'jhmt.journalistic_head_id = journalistic_heads.id', 'left')
      ->join('media_types', 'jhmt.media_type_id = media_types.id', 'left')
      ->group_by('journalistic_heads.id')
      ->get('journalistic_heads');

      return $query->result_object();

   }

   public function get($id)
   {
      $query = $this->db->get_where('journalistic_heads', array('id' => $id));
      $result = $query->result_object();

      if(isset($result[0])) {
         $journalistic_head = $result[0];
         $journalistic_head->media_types = $this->getMediaTypes($id);

         return $journalistic_head;
      }
      else {
         return false;
      }

   }

   public function getJournalists($id) {
      $query = $this->db
      ->select("journalists.*")
      ->join('journalist_journalistic_head', 'journalists.id = journalist_journalistic_head.journalist_id', 'left')
      ->where(array('journalist_journalistic_head.journalistic_head_id' => $id))
      ->get('journalists');

      return $query->result_object();
   }

   public function update($id, $data)
   {
      $this->db->where('id', $id);
      return $this->db->update('journalistic_heads', $data);
   }

   public function insert($data)
   {
      $this->db->insert('journalistic_heads', $data);
      return $this->db->insert_id();
   }

   public function delete($id)
   {
      $this->db->where('id', $id);
      return $this->db->delete('journalistic_heads');
   }

   public function getMediaTypes($id)
   {
      $query = $this->db
              ->select('media_types.id, media_types.name')
              ->from('journalistic_head_media_type')
              ->join('media_types', 'media_types.id = journalistic_head_media_type.media_type_id')
              ->where(array('journalistic_head_media_type.journalistic_head_id' => $id))->get();

      $results = $query->result();

      $media_types = array();
      foreach($results as $media_type) {
              // TODO check why doesn't return integer
              $media_types[] = $media_type;
      }

      return $media_types;
   }

   public function addMediaTypes($journalistic_head_id, $media_types)
   {
      if(!is_integer($journalistic_head_id)) {
         show_error("Journalistic head must be an integer", "500");
         return false;
      }
      if(!is_array($media_types)) {
         show_error("Media types must be an array", "500");
         return false;
      }
      foreach($media_types as $media_type) {
         $data = array(
            "journalistic_head_id" => $journalistic_head_id,
            "media_type_id" => $media_type
         );
         $this->db->insert('journalistic_head_media_type', $data);
      }
   }

   public function removeAllMediaTypes($journalistic_head_id) {
           $this->db->where('journalistic_head_id', $journalistic_head_id);
           return $this->db->delete('journalistic_head_media_type');
   }

   public function updateMediaTypes($journalistic_head_id, $media_types) {
          if($this->removeAllMediaTypes($journalistic_head_id)) {
                  return $this->addMediaTypes($journalistic_head_id, $media_types);
          }
  }

}
