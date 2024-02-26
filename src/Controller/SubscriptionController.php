<?php

namespace App\Controller;

use App\Model\Subscription;
use App\Service\PriceMonitorService;
use App\Controller\Controller;
use App\Model\Ad;
use App\Service\PriceParserService;

class SubscriptionController extends Controller
{   
    public function subscribe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $link = isset($_POST['link']) ? $_POST['link'] : '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email address";
                return;
            }

            if (empty($link)) {
                echo "Ad link is required";
                return;
            }

            $adId = Ad::findByLink($link);

            if (!$adId) {
                $price = PriceParserService::parsePrice($link);
                if($price == null) {
                    echo 'Error';
                }
                $ad = new Ad($link, $price);
                $adId = $ad->save();
            }

            $subscription = new Subscription($email, $adId);
            $subscription->save();
            ini_set('smtp_port', 1025);
            ini_set('SMTP', 'mailhog');
            ini_set('sendmail_from', 'your_email@gmail.com');
            ini_set('sendmail_path', 'sendmail -t -i');


            echo "Subscription successful. You will receive notifications for price changes.";
        } else {
            echo "error";
        }
    }

    public function show()
    {
        $this->render('subscription_form');
    }
}
