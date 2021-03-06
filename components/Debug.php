<?php

namespace app\components;

use yii\base\Component;

/**
 * Class Debug
 */
class Debug extends Component
{
    public static function mailMysqlError($ErrorMessage, $FileName = '')
    {
        $File_val = '';
        if ( ! empty($FileName)) {
            $File_val = basename($FileName, '.php') . ".php";
        }

        $message = $ErrorMessage;
        $From    = "admin@rotiTime.com";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "From: RotiTime <$From>\r\n";
        $to      = "info@rotitime.com";
        $headers .= 'Cc: zefa@rotitime.com' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $subject = "Roti TIme - Mysql Error - " . date("Ymd H:i:s") . " - " . $File_val;

        mail($to, $subject, $message, $headers);
    }
}
