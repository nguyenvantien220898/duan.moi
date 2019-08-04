<?php
/**
 * Created by PhpStorm.
 * User: Tien Nguyen
 * Date: 30/07/2019
 * Time: 12:12 AM
 */
function tinhtong($n)
{
    if ($n == 1){ return $n; }
    return $n + tinhtong($n-1);
}
echo tinhtong(100);
