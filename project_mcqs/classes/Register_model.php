<?php
namespace project;

use project\Db_connect;
class Register_model {
	
    protected $model;
    public function __construct(){

    try{
         $conn=new Db_connect();
         $this->model=$conn->get_connection();
        
    }
    catch(Exception $e){
        echo "Error: ".$e->getMessage();
    }
}


function check_mail($table=null,$field=null,$val=null){

      if($val !=null){
            
            if(is_numeric($val))
              $query="SELECT * FROM $table WHERE ".$field."=".$val.";";

            else
               $query="SELECT * FROM $table WHERE ".$field."='".$val."';";
            
             
         $result=mysqli_query($this->model,$query) or die("query unsuccessfully");
              if(mysqli_num_rows($result) > 0){
                $row=mysqli_fetch_row($result);
               return $row;
              }
              
        }
        else
            return 0;
        


}
 function get_all($table,$mcqs_ids=NULL){
          $arr=[];
        if($mcqs_ids ==NULL){      
         $query="SELECT * FROM ".$table;         
         
         
         $result=mysqli_query($this->model,$query) or die("query unsuccessfully");
         if(mysqli_num_rows($result) > 0){
           while($row=mysqli_fetch_assoc($result)) {
            $arr[]=$row;
          }
           return $arr;
         }
        else
            return false;
         
  }else{

      $query="SELECT * FROM ".$table." WHERE mcq_id IN ({$mcqs_ids})";
      $result=mysqli_query($this->model,$query) or die('connection failed');
      if(mysqli_num_rows($result) > 0 ){
            while ($row=mysqli_fetch_assoc($result)) {
              $arr[]=$row;
            }
          return $arr;
      }
      else
        return false;
      
  }
}///End get_all

function myjoin($table=null,$fields=null,$keys=null,$where=null){
      $sql="SELECT ";

      if(is_array($table)){

         if(is_array($fields)){
          //foreach1
          foreach ($fields as $val) {
            $sql .= $val.", ";
          }
          $sql=rtrim($sql,', ');
      }else{
        if($fields != null)
          $sql .= $fields;
       else   
        $sql .= ' * ';
      }
      $sql .= " FROM ";
      //foreach2
      foreach ($table as $val) {
        
        $sql .= $val.' ';
        
      }
     
     if(is_array($keys)){
      $i=0;
      foreach ($keys as $val) {
        
        if($i >0 )
          $sql .= ' INNER JOIN users as u';

          $sql .= " ON ".$val;
         $i++;
     }
     
}//ifis_array
else
      $sql .= " ON ".$keys;


      if($where !=null){
        $sql .= " WHERE (";
          if(is_array($where)){
             //foreach3
            $i=0;
            foreach ($where as $key => $val) {
              if($i > 0) $sql .= " AND ";
              $operator_arr=explode(" ",$key);
              if(isset($operator_arr[1]))
                $operator=$operator_arr[1];
              else
                $operator='=';

              $sql .= $operator_arr[0].' '.$operator;
              
           if(is_array($val)){
                $sql .= " ( ";
                //foreach4
                foreach ($val as $item) {
                  $sql .= $item.', ';
                }//endforeach4
                $sql=rtrim($sql,', ');
                $sql .= " ) ";
              }
              else
                $sql .= $val;
              
              $i++;
              
      }//end foreach3 
      $sql .= ")";
    }//is_array $where
  }//end if $where !=null

   
   }//End is_arrTable//////////////End of if table is_arrya////////////
   else{ //<--main else start here
      if(is_array($fields)){
          //foreach1
          foreach ($fields as $val) {
            $sql .= $val.", ";
          }
          $sql=rtrim($sql,', ');
      }else{
        if($fields != null)
          $sql .= $fields;
       else   
        $sql .= ' * ';
      }
       $sql .= " FROM ".$table;
        if($where !=null){
        $sql .= " WHERE (";
          if(is_array($where)){
             //foreach3
            $i=0;
            foreach ($where as $key => $val) {
              if($i > 0) $sql .= " AND ";
              $operator_arr=explode(" ",$key);
              if(isset($operator_arr[1]))
                $operator=$operator_arr[1];
              else
                $operator='=';

              $sql .= $operator_arr[0].' '.$operator;
              
           if(is_array($val)){
                $sql .= " ( ";
                //foreach4
                foreach ($val as $item) {
                  $sql .= $item.', ';
                }//endforeach4
                $sql=rtrim($sql,', ');
                $sql .= " ) ";
              }
              else
                $sql .= $val;
              
              $i++;
              
      }//end foreach3 
      $sql .= ")";
    }//is_array $where
  }//end if $where !=null
  
    
    
   }//end of main else

   //return $sql;
  $arr=[];
  //echo $sql."/////////////////<br>////////////";
   $result=mysqli_query($this->model,$sql) or die('conecction failed');
   if(mysqli_num_rows($result) > 0){
    while($row=mysqli_fetch_assoc($result)){
      $arr[]=$row;
    }
   }
   return $arr;
}//End function myjoin


    /* public function insert_data(array $data){
       
       $pass=password_hash($data['pass'], PASSWORD_BCRYPT,['hash'=>8]);
       
        $dat1=date('y-m-d');

    $sql="INSERT INTO users (fname,lname,email,password,created_at) VALUES ('{$data['fname']}','{$data['lname']}','{$data['email']}','{$pass}','{$dat1}');";
         $insert=mysqli_query($this->model,$sql) or die('something Errors');
         if($insert)
            return true;
         else
            return false;
         
     }*/

    
  public function schema($table){
       $myresult= mysqli_query($this->model,"SHOW COLUMNS FROM ".$table) OR die('connection failed');
       $arr=[];
      if($myresult){
            while($row=mysqli_fetch_assoc($myresult)){
              $arr[]=$row;
            }
            return $arr;
          }
       }//END  get_pkId_name()
    public function get_pkId_name($table){
       $result= mysqli_query($this->model,"SHOW KEYS FROM ".$table." WHERE key_name='PRIMARY'") OR die('connection failed');
      if($result)
            return mysqli_fetch_assoc($result);
            
       }//END  get_pkId_name()
     public function table_name($table){
       $result= mysqli_query($this->model,"SHOW CREATE TABLE ".$table) OR die('connection failed');
        if($result)
            return mysqli_fetch_assoc($result);
            
          
          
  }//END table_name()
  public function insert_data2(array $data=[],$table){

        $sql="INSERT INTO ".$table."(";
        if(!empty($data)){
          if(is_array($data)){

            foreach ($data as $key => $val) {
                $sql .= $key.',';
            }
           
            $sql=rtrim($sql,', ');
             $sql .= ")values(";
            foreach ($data as $val) {
              if(is_numeric($val))
              $sql .= $val.",";
            else
               $sql .= "'{$val}'".", ";
            }
            $sql=rtrim($sql,', ');
            $sql .= ");";
            
          }
          

           if(mysqli_query($this->model,$sql))
               return true;
           else
               return false;
        }
        
  }//End func
   
}//END CLASS
?>