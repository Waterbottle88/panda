<?php

namespace App\Service;

use App\Model\Ad;
use App\Model\Subscription;

class AdPriceTrackerService
{
    public static function trackPrices()
    {
        $ads = Ad::getAllAds();

        foreach ($ads as $ad) {
            $currentPrice = PriceParserService::parsePrice($ad->getLink());
            
            if ($currentPrice !== null && $currentPrice != $ad->getPrice()) {
                
                $subscribers = Subscription::getSubscribersByAdId($ad->getId());

                foreach ($subscribers as $subscriber) {
                    self::sendNotification($subscriber['email'], $ad->getLink(), $currentPrice);
                }

                $ad->setPrice($currentPrice);
                $ad->save();
            }
        }
    }

    private static function sendNotification($email, $adLink, $newPrice)
    {
        $to = $email;
        $subject = 'Price Update Notification';
        $message = "The price for the ad: $adLink has been updated. New Price: $newPrice";

        $headers = "From: panda@example.com\r\n";
        $headers .= "Reply-To: panda@example.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);
    }
}
