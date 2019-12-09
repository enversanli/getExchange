<?php

include "curlnext.php";

$crl=new curlx();

$crl->_getUrl('https://www.isbank.com.tr/TR/ana-sayfa/Sayfalar/ana-sayfa.aspx');

//print_r($crl->_getResult());
print_r($crl->getExchange());