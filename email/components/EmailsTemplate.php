<?php
namespace  vendor\groovy\src\email\components;
use Yii;
use yii\base\Component;
use vendor\groovy\src\email\models\EmailTemplate;

/**
 * Class for common EmailTemplate functions
 */
class EmailsTemplate extends Component
{
    public $allowDelete = false;
    public $allowInsert = false;
    public $dummycontent = '';   
    public $breadcrumbs;
    
    public $icons = ["update"=>"glyphicon glyphicon-pencil","view"=>"glyphicon glyphicon-eye-open","delete"=>"glyphicon glyphicon-trash"];
    
    public function replace_string_email($array,$slug,$type = "mail"){
        if($slug != ''){
            $mail_template_array = EmailTemplate::findOne(['email_slug'=>$slug]);            
            if(!empty($mail_template_array)){
                if($type == "subject"){
                    $content = $mail_template_array->email_subject;
                }else{
                    $content = $mail_template_array->email_content;
                }
                $word = array();
                $replace_word = array();
                if(!empty($array)){
                    $array["{{year}}"] = date("Y");
                    foreach($array as $k=>$d){
                        $word[] =  $k;
                        $replace_word[] = $d;
                    }
                }	
                $mail_message = str_replace($word, $replace_word, $content);
                return $mail_message;
            }
            return true;
        }
        return "";
    }
}
