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
     * @param string $value
     * @param boolean $isSmall
     * @return boolean
     * @throws \Exception
     */
    public static function isDate($value, $isSmall = null)
    {
        try {
            $isSmallDate = isset($isSmall) ? $isSmall : false;
            if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $value)) {
                $isDate = self::isValidDate($value, $isSmallDate);
            } elseif (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $value)) {
                $reverse = implode('/', array_reverse(explode('-', $value)));
                $isDate = self::isValidDate($reverse, $isSmallDate);
            } else {
                throw new \Exception('Formato data non analizzabile. Utilizzare dd/mm/yyyy o yyyy-mm-dd');
            }
            return $isDate;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isTime($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Tipo parametro errato');
            }
            if (preg_match('/^([01]{1}[0-9]|2[0-3])(:[0-5][0-9]){2}$/', $value)) {
                $isTime = true;
            } else {
                $isTime = false;
            }
            return $isTime;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isLatinDate($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Tipo parametro errato');
            }
            if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/', $value)) {
                $isLatinDate = true;
            } else {
                $isLatinDate = false;
            }
            return $isLatinDate;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isAngloDate($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Tipo parametro errato');
            }
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $value)) {
                $isAngloDate = true;
            } else {
                $isAngloDate = false;
            }
            return $isAngloDate;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isLatinDateTime($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Tipo parametro errato');
            }
            if (preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}[T\s]([01]{1}[0-9]|2[0-3])(:[0-5][0-9]){2}$/', $value)) {
                $isLatinDateTime = true;
            } else {
                $isLatinDateTime = false;
            }
            return $isLatinDateTime;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isAngloDateTime($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Tipo parametro errato');
            }
            if (preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}[T\s]([01]{1}[0-9]|2[0-3])(:[0-5][0-9]){2}$/', $value)) {
                $isAngloDateTime = true;
            } else {
                $isAngloDateTime = false;
            }
            return $isAngloDateTime;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @param boolean $isSmall
     * @return boolean
     * @throws \Exception
     */
    public static function isDateTime($value, $isSmall = null)
    {
        try {
            $isSmallDate = isset($isSmall) ? $isSmall : false;
            if (preg_match('/^([^T]{10})(T(.){8})?$/', $value)) {
                $dateTime = explode('T', $value);
                $date = $dateTime[0];
                $time = isset($dateTime[1]) ? $dateTime[1] : '00:00:00';
                if (self::isDate($date, $isSmallDate) && self::isTime($time)) {
                    $isDateTime = true;
                } else {
                    $isDateTime = false;
                }
            } else {
                throw new \Exception('Formato data e ora non analizzabile. Utilizzare dd/mm/yyyyThh:mm:ss o yyyy-mm-ddThh:mm:ss');
            }
            return $isDateTime;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @param boolean $isSmall
     * @return boolean
     * @throws \Exception
     */
    public static function isValidDate($value, $isSmall)
    {
        try {
            if (!is_string($value) || !is_bool($isSmall)) {
                throw new \Exception('Formato parametri non valido');
            }
            if (preg_match('/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/', $value)) {
                if ($isSmall) {                    
                    $isDate = self::isSmallDate($value);
                } else {
                    $isDate = true;
                }
            } else {
                $isDate = false;
            }
            return $isDate;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isSmallDate($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Formato parametro non valido');
            }
            $max = \DateTime::createFromFormat('d/m/Y', '06/06/2079');
            $current = \DateTime::createFromFormat('d/m/Y', $value);
            $isDate = ($current < $max) ? true : false;
            return $isDate;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param numeric $value
     * @return boolean
     * @throws \Exception
     */
    public static function isInteger($value)
    {
        try {
            if (!is_numeric($value)) {
                throw new \Exception('Formato parametro non valido');
            }
            if (preg_match('/^[0-9]+$/', $value)) {
                $isInteger = true;
            } else {
                $isInteger = false;
            }
            return $isInteger;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param numeric $value
     * @return boolean
     * @throws \Exception
     */
    public static function isFloat($value)
    {
        try {
            if (!is_numeric($value)) {
                throw new \Exception('Formato parametro non valido');
            }
            if (preg_match('/^[0-9]+(\.[0-9]+)?$/', $value)) {
                $isFloat = true;
            } else {
                $isFloat = false;
            }
            return $isFloat;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @param array $admitted
     * @return boolean
     * @throws \Exception
     */
    public static function isEnum($value, $admitted)
    {
        try {
            if (!is_string($value) || !is_array($admitted)) {
                throw new \Exception('Formato parametri non valido');
            }
            if (in_array($value, $admitted)) {
                $isEnum = true;
            } else {
                $isEnum = false;
            }
            return $isEnum;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
    
    /**
     * @param string $value
     * @return boolean
     * @throws \Exception
     */
    public static function isString($value)
    {
        try {
            if (!is_string($value)) {
                throw new \Exception('Formato parametro non valido');
            }
            if (preg_match('/^.+$/', $value)) {
                $isString = true;
            } else {
                $isString = false;
            }
            return $isString;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
}
