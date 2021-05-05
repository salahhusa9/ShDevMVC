<?php
    session_start();
    /**
     * appConfig
     *
     * @param  mixed $var : the var is the name of file and path of elemnt target in global array
     * @return void : value of element target in the array
     */

    function appConfig($var)
    {
        $index=explode(".",$var);
        $dir=__DIR__."\..\config\\".$index[0].".php";
        if (!file_exists($dir)) {
            return null;
        }
        $includ=require($dir);
        unset($index[0]); //for delete name of the config file
        $last=$includ;
        foreach ($index as $item){
            if (!isset($last[$item])) {
                return null;
            }
            $last=$last[$item];
        }

        return $last;
    }

    function CreateSession($sessionName, $var)
    {
        $_SESSION[$sessionName] = $var;
        return true;
    }

    function getSession($sessionName)
    {
        return $_SESSION[$sessionName] ?? false;
    }

    function view($var)
    {
        $index=explode(".",$var);

        $dir="../view/".$index[0].".php";
        if (!file_exists($dir)) {
            return "View Not Exist";
        }
        // $includ=require($dir);
        // unset($index[0]); //for delete name of the config file
        // $last=$includ;
        // foreach ($index as $item){
        //     if (!isset($last[$item])) {
        //         return null;
        //     }
        //     $last=$last[$item];
        // }

        return $dir;
    }

?>