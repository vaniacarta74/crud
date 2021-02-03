<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud;

use vaniacarta74\Crud\Error;

/**
 * Classe gestione errori.
 *
 * Nella classe Error sono contenuti i metodi per la gestione degli errori
 * utilizzati nelle altre classi delle API del progetto Scarichi.
 *
 * @author Vania Carta
 */
class Utility
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
    public static function benchmark($strDateTime)
    {
        try {
            $start = \DateTime::createFromFormat('Y-m-d H:i:s.u', $strDateTime, new \DateTimeZone('Europe/Rome'));
            if (!$start) {
                throw new \Exception('Data inizio benchmark inesistente');
            }
            $end = new \DateTime('NOW', new \DateTimeZone('Europe/Rome'));
            $dateInterval = date_diff($start, $end);            
            if ($dateInterval->h === 0) {
                if ($dateInterval->i === 0) {
                    $interval = substr($dateInterval->format('%s,%F'), 0, -3) . ' sec';
                } else {
                    $interval = $dateInterval->format('%i min e %s sec');
                }
            } else {
                $interval = $dateInterval->format('%h ora, %i min e %s sec');
            }
            return $interval;
        } catch (\Exception $e) {
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;
        }
    }
    
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
    public static function callback($arrCall, $params)
    {
        try {
            if (count($arrCall) > 1) {
                if (is_object($arrCall[0]) || class_exists($arrCall[0])) {
                    $callable = $arrCall;
                } else {
                    $callable = array(__NAMESPACE__ . '\\' . $arrCall[0], $arrCall[1]);
                }
            } else {
                $callable = __NAMESPACE__ . '\\' . $arrCall[0];
            }
            if (is_callable($callable)) {
                $result = call_user_func_array($callable, $params);
            } else {
                throw new \Exception('Funzione o methodo non eseguibile');
            }        
            return $result;
        } catch (\Exception $e) {        
            Error::printErrorInfo(__FUNCTION__, Error::debugLevel());
            throw $e;        
        }
    }
}
