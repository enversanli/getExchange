<?php
class curlx{
public $crl, $res;



    function _getUrl($url){
        $this->crl = curl_init($url);
        curl_setopt_array($this->crl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0

        ]);



    }
    function _getResult(){

        $this->res=curl_exec($this->crl);
        curl_close($this->crl);
        return $this->res;

    }
    function getExchange(){
        preg_match_all('@<span class="fd_item">(.*?)</span>@si', $this->res, $response);
        return $response;

    }

        function jsonToArray($val){
        $val=json_decode($val, true);
        return $val;

        }

        function arrayToJson($val){
        $val = json_encode($val , true);
        return $val;

        }



}
class GetExchange{

    function getExchange(){
        $crl = curl_init();
        curl_setopt_array($crl, [
            CURLOPT_URL => 'https://www.akbank.com/_vti_bin/AkbankServicesSecure/FrontEndServiceSecure.svc/GetExchangeData?_='. time(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_RETURNTRANSFER => true


        ]);

        $out = curl_exec($crl);
        curl_close($crl);
        $out = json_decode($out, true);
        $res=json_decode($out['GetExchangeDataResult'],true);

        $eur=$res['Currencies'][6];
        $usd=$res['Currencies'][16];


        return [
            'USD' => [
                'Alis' => $usd['Buy'],
                'Satis'=> $usd['Sell']
            ],
            'EUR'=>[
                'Alis'=> $eur['Buy'],
                'Satis'=>$eur['Sell']
            ]
        ];
    }

}