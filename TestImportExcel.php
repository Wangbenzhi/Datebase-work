<?php
 
	class TestImportExcel extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
            $this->load->model('TestImportExcel_model','testimportexcel_model');
           
		}
 
		public function importexcel(){
			if ($_FILES['userfile']['name']) {
				$tmp_file = $_FILES['userfile']['tmp_name'];
				$file_types = explode('.', $_FILES['userfile']['name']);
				$file_type = $file_types[count($file_types)-1];
				
				//判断是否为excel文件
				if (strtolower($file_type) != 'xlsx') {
					echo "不是excel文件，请重新上传！";
				}
 
				//设置上传路径
				$savePath = "./uploads/";
				//文件命名
				$str = date('Ymdhis');
				$file_name = $str.".".$file_type;
					if (!copy($tmp_file,$savePath.$file_name)) {
						echo "上传失败";
					}
					$this->load->library('PHPExcel');
					$objPHPExcel = new PHPExcel();
                    $objProps = $objPHPExcel->getProperties();
                   // require_once( APPPATH . 'libraries\PHPExcel');
                    $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
					$objPHPExcel = $objReader->load($savePath . $file_name);
					$sheet = $objPHPExcel->getSheet(0);
					$highestRow = $sheet->getHighestRow();
					$highestColumn = $sheet->getHighestColumn();
 
					//excel中的一条数据
                    $excel_data = array();
                    //echo $highestColumn,$highestRow;
                    //echo '\n';
                    $statement_temp;
                    $month_temp;
					for ($currentRow=4; $currentRow <= $highestRow; $currentRow++) { 
                      //  echo $currentRow;
						for ($currentColumn=0; $currentColumn < PHPExcel_Cell::columnIndexFromString($highestColumn) ; $currentColumn++) { 
                           
                            if($currentColumn==3||$currentColumn==4||$currentColumn==9||$currentColumn==18||$currentColumn==24||$currentColumn==26)
                               {
                                    continue; //自动计算的导入不进来
                               }
                            elseif($currentRow!=4 && $currentColumn==0) //合并单元格只有第一行有值
                            {
                                $excel_data[0]=$statement_temp;
                            }
                            elseif($currentRow!=4 && $currentColumn==1)
                            {
                                $excel_data[1]=$month_temp;
                            }
                               else
                            {
                            $excel_data[$currentColumn]=$objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($currentColumn) . $currentRow)->getValue();
                      //      echo $currentColumn;
                            }          
                            
                        }
                        if($currentRow==4){
                        $statement_temp=$excel_data[0]; //四行A
                        $month_temp=$excel_data[1];//四行B
                        }//下面为自动计算的缺省值
                        $excel_data[3]=$excel_data[5]+$excel_data[14]; 
                        $excel_data[4]=$excel_data[6]+$excel_data[15];
                        $excel_data[9]=$excel_data[7]/$excel_data[8];
                        $excel_data[18]=$excel_data[16]/$excel_data[17];
                        $excel_data[24]=$excel_data[23]/$excel_data[14];
                        $excel_data[26]=$excel_data[25]/$excel_data[14];
                        $this->testimportexcel_model->insert_excel($excel_data[0],$excel_data[2],$excel_data[1],$excel_data[3],$excel_data[4],$excel_data[5],$excel_data[6],$excel_data[7],$excel_data[8],$excel_data[9],
                        $excel_data[10],$excel_data[11],$excel_data[12],$excel_data[13],$excel_data[14],$excel_data[15],$excel_data[16],$excel_data[17],$excel_data[18],
                        $excel_data[19],$excel_data[20],$excel_data[21],$excel_data[22],$excel_data[23],$excel_data[24],$excel_data[25],$excel_data[26],$excel_data[27]);
					}
 
                    echo "导入成功";
                    $this->load->view('\other\upload_success');
			}
		}
	}
?>