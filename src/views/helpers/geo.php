<?php
/**
 * Created by PhpStorm.
 * User: hongyi
 * Date: 14-2-12
 * Time: 下午10:44
 */
class GeoHelper extends Helper
{
    protected $_dec = null;
    protected $_dms = null;

    public function setDEC($dec)
    {
        $this->_dec = $dec;
        $this->_dms = null;
        return $this;
    }

    public function toDMS()
    {
        if (!is_null($this->_dec)) {
            $this->_dms = self::DECtoDMS($this->_dec);
            $this->_dec = null;
        }
        return $this;
    }

    public function render()
    {
        if (is_null($this->_dec)) {
            $r = $this->_dms;
            return sprintf('%s&deg;%s&#39;%d&#34;',
                $r['deg'],
                $r['min'],
                $r['sec']);
        } elseif (is_null($this->_dms)) {
            return sprint($this->_dec);
        }
    }

    public function DMStoDEC($deg,$min,$sec)
    {
        // Converts DMS ( Degrees / minutes / seconds )
        // to decimal format longitude / latitude
        return $deg+((($min*60)+($sec))/3600);
    }

    static public function DECtoDMS($dec)
    {
        // Converts decimal longitude / latitude to DMS
        // ( Degrees / minutes / seconds )

        // This is the piece of code which may appear to
        // be inefficient, but to avoid issues with floating
        // point math we extract the integer part and the float
        // part by using a string function.

        $vars = explode(".",$dec);
        $deg = $vars[0];
        $tempma = "0.".$vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min*60);

        return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
    }

    public function renderDecToDMS($dec)
    {
        $r = $this->DECtoDMS($dec);
        return sprintf('%s&deg; %s&#39; %.2f&#34;', $r['deg'], $r['min'], (float)$r['sec']);
    }

}