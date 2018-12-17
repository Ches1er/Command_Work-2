<?php
define("DOCROOT",$_SERVER["DOCUMENT_ROOT"]."/");
define("APPPATH",DOCROOT."app/");
define("ROOTPATH",APPPATH."root/");
define("CONTROLLERPATH",APPPATH."controllers/");
define("VIEWPATH",APPPATH."views/");
define("TEMPLATEPATH",APPPATH."templates/");
define("FNSPATH",APPPATH."functions/");
define("DATAPATH",DOCROOT."data/");

$init_fns = include ROOTPATH . "init_fns_config.php";
foreach ($init_fns as $f) {
    include FNSPATH . "{$f}_fns.php";
}

include ROOTPATH."routing.php";
echo navigate();