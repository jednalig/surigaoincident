<?php
namespace Phppot;

class Util
{

    function getRGBRandom()
    {
        $rgbRandom = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        return $rgbRandom;
    }

    function getRandomColor()
    {
        $randomColor = "#";
        for ($i = 0; $i < 3; $i ++) {
            $randomColor .= $this->getRGBRandom();
        }
        return $randomColor;
    }
}