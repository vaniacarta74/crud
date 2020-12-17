<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;

/**
 * Description of Check
 *
 * @author Vania
 */
class Check
{
    
    /**
     * Stampa il tempo trascorso da una certa data.
     *
     * Il metodo benchmark() fornisce l'intervallo di tempo intercorso da una
     * certa data. Viene utilizzato per calcolare il tempo di esecuzione della
     * procedura.
     *
     * @param string $strDateTime Data nel formato "YYYY-mm-dd HH:ii:ss.millisec"
     * @return string Intervallo intercorso nel formato "secondi,millisecondi"
     */
    public static function isDate2($value, $isSmall = null)
    {
        try {
            $isSmallDate = isset($isSmall) ? $isSmall : false;
            if (preg_match('/^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/', $value)) {
                if (preg_match('/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/', $value)) {
                    if ($isSmallDate) {
                        $max = \DateTime::createFromFormat('d/m/Y', '06/06/2079');
                        $current = \DateTime::createFromFormat('d/m/Y', $value);
                        $isDate = ($current < $max) ? true : false;
                    } else {
                        $isDate = true;
                    }
                } else {
                    $isDate = false;
                }
            } else {
                throw new \Exception('Formato data non analizzabile. Utilizzare dd/mm/yyyy');
            }
            return $isDate;
        } catch (\Throwable $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    public static function isDate($value, $isSmall = null)
    {
        try {            
            return true;
        } catch (\Throwable $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    public static function isInteger($value)
    {
        try {
            if (preg_match('/^[0-9]+$/', $value)) {
                $isInteger = true;
            } else {
                $isInteger = false;
            }
            return $isInteger;
        } catch (\Throwable $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    public static function isFloat($value)
    {
        try {
            if (preg_match('/^[0-9]+(\.[0-9]+)?$/', $value)) {
                $isFloat = true;
            } else {
                $isFloat = false;
            }
            return $isFloat;
        } catch (\Throwable $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    public static function isEnum($value, $admitted)
    {
        try {
            if (in_array($value, $admitted)) {
                $isEnum = true;
            } else {
                $isEnum = false;
            }
            return $isEnum;
        } catch (\Throwable $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
}
