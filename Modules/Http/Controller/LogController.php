<?php


namespace App\Modules\Http\Controller;

use PDO;
use App\Modules\App;
use BadMethodCallException;
use App\Modules\Http\Controller\BaseController;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use PDOException;

class LogController extends BaseController{
    
    
    public function controlPanel(){
        $log = file(basePath("log.log"));
        $logBox = [
            'warnings' => [],
            'logs' => [],
        ];

        foreach($log as $logLine){
           $line = $this->checkDeniedAccess(Self::explodeLogData($logLine));
           if($line){
            $logBox['logs'][] = $line;
           }
           $line = $this->filterBruteForceLogs($logLine);
           if($line){
            $logBox['warnings'][] = $line;
           }
        }

        return view('log/control_panel', ['logBox'=>$logBox]);
    }

    public static function explodeLogData($logLine){
       $logLineData = explode(',', $logLine);
       return $logLineData;
    }

    public function checkDeniedAccess($logLineData){
        if(count($logLineData) != 3){

            return false;
        }
        if(!checkAtomDate($logLineData[0])){

            return false;
        }
        if(!$logLineData[1] == 'ACCESS DENIED'){

            return false;
        }

        if(!filter_var(trim($logLineData[2]), FILTER_VALIDATE_EMAIL)){
            
            return false;
        }

        return $logLineData;
    }

    public static function checkForBruteForce($email){
        $log = file(basePath("log.log"));
        $bruteForceCounter = 0;

        $callback = function($el) use ($email){
            return str_contains($el,$email) && str_contains($el, 'ACCESS DENIED');
        };

        $filteredLogs = array_filter($log, $callback);

        $lastDate = Carbon::createFromFormat(DateTime::ATOM,reset(Self::explodeLogData(end($filteredLogs))));
        $bruteForceGap = $lastDate->copy()->subMinute();

        foreach($filteredLogs as $logLine){
            $dateToCheck = Carbon::createFromFormat(DateTime::ATOM,reset(Self::explodeLogData($logLine)));
            
            if(($bruteForceGap->getTimestamp() <= $dateToCheck->getTimestamp()) && ($dateToCheck->getTimestamp() <= $lastDate->getTimestamp())){
                $bruteForceCounter++;
            }
        }

        if($bruteForceCounter >= 3){
            error_log("BRUTE FORCE ATTACK TRY from " . $_SERVER['REMOTE_ADDR'] . "\n", 3 , basePath("log.log"));
        }
    }

    public function filterBruteForceLogs($logLine){
        if(str_contains($logLine, "BRUTE FORCE ATTACK TRY")){
            return $logLine;
        }
        return false;
    }

}