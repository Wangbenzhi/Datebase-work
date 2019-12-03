<?php
	class TestImportExcel_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			
			$this->load->database();
		}
 
		//插入数据到数据库
	/*	public function insert_excel($main_question,$answer){
			$data = array(
				'main_question'=>$main_question,
				'answer' => $answer,
			);
			$this->db->insert('question_answer',$data);
        }
        */
        public function insert_excel($statement,$type,$month,$station_num,$meter_num,$straight_station_num,$straight_meter_num,
        $straight_fee,$straight_count,$straight_average_fee_non,$straight_top_fee_non,$straight_low_fee_non,$straight_top_fee,
       $straight_low_fee,$trans_station_num,$trans_meter_num,$trans_fee,$trans_count,$trans_average_fee_non,$trans_top_fee_non,
       $trans_low_fee_non,$trans_top_fee,$trans_low_fee,$trans_self_station_num,$trans_fee_self_proportion,$trans_replace_station_num
       ,$trans_replace_proportion,$index_explain )//
       {
           $data=array(
            'statement'=>$statement,
            'type'=>$type,
            'month'=>$month,
            'station_num'=>$station_num,
            'meter_num'=>$meter_num,
            'straight_station_num'=>$straight_station_num,
            'straight_meter_num'=>$straight_meter_num,
            'straight_fee'=>$straight_fee,
            'straight_count'=>$straight_count,
            'straight_average_fee_non'=>$straight_average_fee_non,
            'straight_top_fee_non'=>$straight_top_fee_non,
            'straight_low_fee_non'=>$straight_low_fee_non,
            'straight_top_fee'=>$straight_top_fee,
           'straight_low_fee'=>$straight_low_fee,
           'trans_station_num'=>$trans_station_num,
           'trans_meter_num'=>$trans_meter_num,
           'trans_fee'=>$trans_fee,
           'trans_count'=>$trans_count,
           'trans_average_fee_non'=>$trans_average_fee_non,
           'trans_top_fee_non'=>$trans_top_fee_non,
           'trans_low_fee_non'=>$trans_low_fee_non,
           'trans_top_fee'=>$trans_top_fee,
           'trans_low_fee'=>$trans_low_fee,
           'trans_self_station_num'=>$trans_self_station_num,
           'trans_fee_self_proportion'=>$trans_fee_self_proportion,
           'trans_replace_station_num'=>$trans_replace_station_num,
          'trans_replace_proportion'=>$trans_replace_proportion,
          'index_explain'=>$index_explain
           );
           $this->db->insert('branch',$data);
       }
	}
?>