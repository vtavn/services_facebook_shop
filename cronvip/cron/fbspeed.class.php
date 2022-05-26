<?php
/**
** Class name: FbAuto
** Author: _Neiht
** Date:04/07/2017
** Tested: OK 04/07/2017 21:00:00
*/
class FbAuto {
    protected   $_url,
                $_type,
                $_post_data,
                $_webpage;
    public function execCurl(){
    $data_string = json_encode($this->_post_data);
        $ch = curl_init('http://'.$this->_url.'.herokuapp'.'.com/'.$this->_type);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $this->_webpage = curl_exec($ch);
        curl_close($ch);
    }
    public function setURL($url = false){
        $this->_url = $url;
    }
    public function setType($type = false){
        $this->_type = $type;
    }
    public function setPostData($data = false){
        $this->_post_data = $data;
    }
    public function getResponse(){
        $return = $this->_webpage;
        $return = json_decode($return);
        return $return;
    }
}
$_Neiht  = new FbAuto;
$_Neiht->setURL('vutienanhne');
?>