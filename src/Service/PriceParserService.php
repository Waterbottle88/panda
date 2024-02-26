<?php

namespace App\Service;

use DOMDocument;
use DOMXPath;

class PriceParserService
{
    public static function parsePrice($link)
    {
        @$dom = new DOMDocument();
        @$dom->loadHTMLFile($link);
        $xpath = new DOMXPath($dom);
        
        $query = '//div[@data-testid="ad-price-container"]/h3';

        $priceNode = $xpath->query($query)->item(0);

        if($priceNode == NULL) {
            return null;
        }

        $price = $priceNode->textContent;

        $number = preg_replace('/[^0-9\s]/', '', $price);
        $number = str_replace(' ', '', $number);
        $number = intval($number);

        return $number;
    }
}
