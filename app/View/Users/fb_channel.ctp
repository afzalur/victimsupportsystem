<?php
/*********************************************************************
 * Copyright (C) 2013 TerraTech Limited (www.terratech.com.bd)
 *
 * This file is part of victimDb project.
 *
 * victimDb can not be copied and/or distributed without the express
 * permission of TerraTech Limited
**********************************************************************/

     $cache_expire = 60*60*24*365;
     header("Pragma: public");
     header("Cache-Control: max-age=".$cache_expire);
     header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$cache_expire) . ' GMT');
?>

 <script src="//connect.facebook.net/en_US/all.js"></script>