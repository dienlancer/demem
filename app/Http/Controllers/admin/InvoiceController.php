<?php namespace App\Http\Controllers\admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InvoiceModel;
use App\InvoiceDetailModel;
use App\PaymentMethodModel;
use DB;
class InvoiceController extends Controller {
    	var $_controller="invoice";	
    	var $_title="Đơn đặt hàng";
    	var $_icon="icon-settings font-dark";
    	public function getList(){		
    		$controller=$this->_controller;	
    		$task="list";
    		$title=$this->_title;
    		$icon=$this->_icon;		    		
        $arrPrivilege=getArrPrivilege();
        $requestControllerAction=$this->_controller."-list";         
        if(in_array($requestControllerAction,$arrPrivilege)){
          return view("admin.".$this->_controller.".list",compact("controller","task","title","icon")); 
        }
        else{
          return view("admin.no-access");
        }
    	}	
    	public function loadData(Request $request){
      		$filter_search="";
      		$data=DB::select('call pro_getInvoice(?)',array(mb_strtolower($filter_search)));      		
      		$data=convertToArray($data);    
          $data=invoiceConverter($data,$this->_controller);         		          
          return $data;
    	}    	
      public function getForm($task,$id=""){		 
          $controller=$this->_controller;			
          $title="";
          $icon=$this->_icon; 
          $arrRowData=array();    
          $arrInvoiceDetail=array();  
          $dataPaymentMethod=array();
          $arrPrivilege=getArrPrivilege();
        $requestControllerAction=$this->_controller."-form";  
        if(in_array($requestControllerAction, $arrPrivilege)){
          switch ($task) {
            case 'edit':
                $title=$this->_title . " : Update";
                $arrRowData=InvoiceModel::find((int)@$id)->toArray();           
                $arrInvoiceDetail=InvoiceDetailModel::select()->where("invoice_id","=",(int)@$id)->get()->toArray();
                $dataPaymentMethod=PaymentMethodModel::whereRaw('status = 1')->get()->toArray();
            break;
            case 'add':
                $title=$this->_title . " : Add new";
            break;      
         }             
         return view("admin.".$this->_controller.".form",compact("arrRowData","arrInvoiceDetail","controller","task","title","icon","dataPaymentMethod"));
        }else{
          return view("admin.no-access");
        }
          
     }
    public function save(Request $request){
        $id 					           =	trim($request->id)	;        
        $fullname 				       =	trim($request->fullname)	;
        $address 					       = 	trim($request->address);
        $phone	                 =	trim($request->phone);
        $mobilephone             =  trim($request->mobilephone);
        $fax                     =  trim($request->fax);
        $sort_order 			       =	trim($request->sort_order);
        $status 				         =  trim($request->status);        
        $data 		               =  array();
        $info 		               =  array();
        $error 		               =  array();
        $item		                 =  null;
        $checked 	= 1;                      
        if(empty($sort_order)){
             $checked = 0;
             $error["sort_order"]["type_msg"] 	= "has-error";
             $error["sort_order"]["msg"] 		= "Thiếu sắp xếp";
        }
        if((int)$status==-1){
             $checked = 0;
             $error["status"]["type_msg"] 		= "has-error";
             $error["status"]["msg"] 			= "Thiếu trạng thái";
        }
        if ($checked == 1) {    
             if(empty($id)){
              $item 				= 	new InvoiceModel;       
              $item->created_at 	=	date("Y-m-d H:i:s",time());                      			
        } else{
              $item				=	InvoiceModel::find((int)@$id);                         
        }  
        $item->fullname 		=	$fullname;
        $item->address 			=	$address;
        $item->phone 		    =	$phone;            
        $item->mobilephone  = $mobilephone;
        $item->fax          = $fax;           
        $item->sort_order 	=	(int)@$sort_order;
        $item->status 			=	(int)@$status;    
        $item->updated_at 	=	date("Y-m-d H:i:s",time());    	        	
        $item->save();  	
        $info = array(
          'type_msg' 			=> "has-success",
          'msg' 				=> 'Lưu dữ liệu thành công',
          "checked" 			=> 1,
          "error" 			=> $error,
          "id"    			=> $id
        );
      } else {
            $info = array(
              'type_msg' 			=> "has-error",
              'msg' 				=> 'Nhập dữ liệu gặp sự cố',
              "checked" 			=> 0,
              "error" 			=> $error,
              "id"				=> ""
            );
      }        		 			       
      return $info;       
    }
      public function changeStatus(Request $request){
            $id             =       (int)$request->id;     
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Cập nhật thành công";              
            $status         =       (int)$request->status;
            $item           =       InvoiceModel::find((int)@$id);        
            $item->status   =       $status;
            $item->save();
            $data                   =   $this->loadData($request);
            $info = array(
              'checked'           => $checked,
              'type_msg'          => $type_msg,                
              'msg'               => $msg,                
              'data'              => $data
            );
            return $info;
      }      
      public function deleteItem(Request $request){
            $id                     =   (int)$request->id;              
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Xóa thành công";                                    
            if($checked == 1){
                $item               =   InvoiceModel::find((int)@$id);
                $item->delete();            
                InvoiceDetailModel::whereRaw("invoice_id = ?",[(int)@$id])->delete();
            }        
            $data                   =   $this->loadData($request);
            $info = array(
              'checked'           => $checked,
              'type_msg'          => $type_msg,                
              'msg'               => $msg,                
              'data'              => $data
            );
            return $info;
      }
      public function updateStatus(Request $request){
            $str_id                 =   $request->str_id;   
            $status                 =   $request->status;  
            $arrID                 =   explode(",", $str_id)  ;
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Cập nhật thành công";             
            if(empty($str_id)){
                $checked                =   0;
                $type_msg               =   "alert-warning";            
                $msg                    =   "Vui lòng chọn ít nhất 1 phần tử";
            }
            if($checked==1){
                foreach ($arrID as $key => $value) {
                      if(!empty($value)){
                        $item=InvoiceModel::find($value);
                        $item->status=$status;
                        $item->save();      
                      }            
                }
            }         
            $data                   =   $this->loadData($request);
            $info = array(
              'checked'           => $checked,
              'type_msg'          => $type_msg,                
              'msg'               => $msg,                
              'data'              => $data
            );
            return $info;
      }
      public function trash(Request $request){
            $str_id                 =   $request->str_id;   
            $checked                =   1;
            $type_msg               =   "alert-success";
            $msg                    =   "Xóa thành công";      
            $arrID                  =   explode(",", $str_id)  ;    
            if(empty($str_id)){
              $checked     =   0;
              $type_msg           =   "alert-warning";            
              $msg                =   "Vui lòng chọn ít nhất 1 phần tử";
            }
            if($checked == 1){                
              $strID = implode(',',$arrID);       
              $strID = substr($strID, 0,strlen($strID) - 1);            
              $sqlDeleteInvoice       = "DELETE FROM `invoice`        WHERE `id`          IN (".$strID.")";        
              $sqlDeleteInvoiceDetail = "DELETE FROM `invoice_detail` WHERE `invoice_id`  IN (".$strID.")";       
              DB::statement($sqlDeleteInvoice);
              DB::statement($sqlDeleteInvoiceDetail); 
            }
            $data                   =   $this->loadData($request);
            $info = array(
              'checked'           => $checked,
              'type_msg'          => $type_msg,                
              'msg'               => $msg,                
              'data'              => $data
            );
            return $info;
    }
    public function sortOrder(Request $request){
          $sort_json              =   $request->sort_json;           
          $data_order             =   json_decode($sort_json);       
          $checked                =   1;
          $type_msg               =   "alert-success";
          $msg                    =   "Cập nhật thành công";      
          if(count($data_order) > 0){              
            foreach($data_order as $key => $value){         
              if(!empty($value)){
                $item=InvoiceModel::find((int)@$value->id);                
              $item->sort_order=(int)$value->sort_order;                         
              $item->save();                      
              }                                             
            }           
          }        
          $data                   =   $this->loadData($request);
          $info = array(
            'checked'           => $checked,
            'type_msg'          => $type_msg,                
            'msg'               => $msg,                
            'data'              => $data
          );
          return $info;
    }
    
}
?>
