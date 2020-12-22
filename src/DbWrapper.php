<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Db;
use vaniacarta74\Crud\Check;

/**
 * Description of Converter
 *
 * @author Vania
 */
class DbWrapper
{
    private static $dbToWrap = ['SPT'];
    
    public static function dateTime($dbName, $query, $params)
    {
        try {
            $db = new db($dbName);
            $wrappedParams = self::setDateTimeParams($dbName, $params);
            $results = $db->run($query, $wrappedParams);
            $wrappedResults = self::setDateTimeResults($dbName, $query, $results);
            return $wrappedResults;
        } catch (\PDOException $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    } 
    
    public static function setDateTimeParams($dbName, $params)
    {
        try {
            $changed = [];
            if (in_array($dbName, self::$dbToWrap)) {
                foreach ($params as $nParam => $param) {
                    foreach ($param as $key => $value) {
                        if ($key === 'value' && $param['check']['type'] === 'dateTime') {
                            $changed[$nParam][$key] = self::setDateTime('Y-m-d H:i:s', $value, 'Europe/Rome', 'Etc/GMT-1');
                        } else {
                            $changed[$nParam][$key] = $value;
                        }
                    }
                }
            } else {
                $changed = $params;
            }
            return $changed;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setDateTime($format, $oldDateTime, $timeZoneIn, $timeZoneOut)
    {
        try {
                        
            $dateTime = self::formatDateTime($oldDateTime);
            $dateTimeZoneIn = new \DateTimeZone($timeZoneIn);
            $dateTimeZoneOut = new \DateTimeZone($timeZoneOut);
            $newDateTime = \DateTime::createFromFormat($dateTime['format'], $dateTime['value'], $dateTimeZoneIn);
            $newDateTime->setTimezone($dateTimeZoneOut);
            $newValue = $newDateTime->format($format);
            return $newValue;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function formatDateTime($oldDateTime)
    {
        try {
            $format = self::getDateTimeFormat($oldDateTime);
            if ($format === 'd/m/Y' || $format === 'Y-m-d') {
                $dateTime['format'] = $format . ' H:i:s';
                $dateTime['value'] = $oldDateTime . ' 00:00:00';
            } else {
                $dateTime['format'] = $format;
                $dateTime['value'] = str_replace('T', ' ', $oldDateTime);
            }            
            return $dateTime;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function getDateTimeFormat($value)
    {
        try {
            if (Check::isLatinDateTime($value)) {
                $format = 'd/m/Y H:i:s';
            } elseif (Check::isAngloDateTime($value)) {
                $format = 'Y-m-d H:i:s';
            } elseif (Check::isLatinDate($value)) {
                $format = 'd/m/Y';
            } elseif (Check::isAngloDate($value)) {
                $format = 'Y-m-d';
            } else {
                throw new \Exception('Formato data e ora non convertibile');
            }
            return $format;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function setDateTimeResults($dbName, $query, $results)
    {
        try {
            $changed = [];
            if (in_array($dbName, self::$dbToWrap)) {
                $dateTimeFields = self::getDateTimeFields($query);
                $changed = self::changeDateTimeResults($dateTimeFields, $results);
            } else {
                $changed = $results;
            }
            return $changed;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function changeDateTimeResults($dateTimeFields, $results)
    {
        try {
            $changed = [];
            foreach ($results as $keyField => $field) {
                if ($keyField === 'records') {
                    foreach ($field as $nRecord => $record) {
                        foreach ($record as $key => $value) {
                            if (in_array($key, $dateTimeFields)) {
                                $changed[$keyField][$nRecord][$key] = self::setDateTime('d/m/Y H:i:s', $value, 'Etc/GMT-1', 'Europe/Rome');
                            } else {
                                $changed[$keyField][$nRecord][$key] = $value;
                            }
                        }
                    }
                } else {
                    $changed[$keyField] = $field;
                }
            }
            return $changed;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
    public static function getDateTimeFields($query)
    {
        try {
            $dateTimeFields = [];
            $type = $query['type'];
            if ($type === 'list' || $type === 'read') {
                $fields = $query['fields'];
                foreach ($fields as $nField => $field) {
                    if ($field['type'] === 'dateTime') {
                        $dateTimeFields[] = isset($field['alias']) ? $field['alias'] : $field['name'];
                    }                
                }
            }
            return $dateTimeFields;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
}
