<?php

namespace App\Services;

use App\Models\CustomTemplate;
use App\Models\Template;
use App\Models\SubscriptionPlan;
use App\Models\Subscriber;
use Carbon\Carbon;

class HelperService 
{
    public static function getTotalWords()
    {   
        $value = number_format(auth()->user()->available_words + auth()->user()->available_words_prepaid);
        return $value;
    }

    public static function getTotalImages()
    {   
        $value = number_format(auth()->user()->available_images + auth()->user()->available_images_prepaid);
        return $value;
    }

    public static function getTotalMinutes()
    {   
        $value = number_format(auth()->user()->available_minutes + auth()->user()->available_minutes_prepaid);
        return $value;
    }

    public static function getTotalCharacters()
    {   
        $value = number_format(auth()->user()->available_chars + auth()->user()->available_chars_prepaid);
        return $value;
    }

    public static function listTemplates()
    {   
        $all_templates = Template::orderBy('group', 'asc')->where('status', true)->get();
        return $all_templates;
    }

    public static function listCustomTemplates()
    {   
        $custom_templates = CustomTemplate::orderBy('group', 'asc')->where('status', true)->get();
        return $custom_templates;
    }

    public static function userAvailableWords()
    {   
        $value = self::numberFormat(auth()->user()->available_words + auth()->user()->available_words_prepaid);
        return $value;
    }

    public static function userPlanTotalWords()
    {   
        $value = self::numberFormat(auth()->user()->total_words);
        return $value;
    }

    public static function userAvailableImages()
    {   
        $value = self::numberFormat(auth()->user()->available_images + auth()->user()->available_images_prepaid);
        return $value;
    }

    public static function userPlanTotalImages()
    {   
        $value = self::numberFormat(auth()->user()->total_images);
        return $value;
    }

    public static function userAvailableChars()
    {   
        $value = self::numberFormat(auth()->user()->available_chars + auth()->user()->available_chars_prepaid);
        return $value;
    }

    public static function userPlanTotalChars()
    {   
        $value = self::numberFormat(auth()->user()->total_chars);
        return $value;
    }

    public static function userAvailableMinutes()
    {   
        $value = self::minutesFormat(auth()->user()->available_minutes + auth()->user()->available_minutes_prepaid);
        return $value;
    }

    public static function userPlanTotalMinutes()
    {   
        $value = self::minutesFormat(auth()->user()->total_minutes);
        return $value;
    }

    public static function getPlanName()
    {   
        $subscription = SubscriptionPlan::where('id', auth()->user()->plan_id)->first();

        if ($subscription) {
            return $subscription->plan_name;
        } else {
            return 'Not Found';
        }
        
    }

    public static function getRenewalDate()
    {   
        $subscription = Subscriber::where('user_id', auth()->user()->id)->where('status', 'Active')->first();

        if ($subscription) {
            if ($subscription->frequency == 'lifetime') {
                return __('Free Forever');
            } else {
                return date_format(Carbon::parse($subscription->active_until), 'd M Y');
            }
        } else {
            return 'Not Found';
        }
        
    }

    public static function numberFormat($num) {

        if($num > 1000) {
      
              $x = round($num);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array('K', 'M', 'B', 'T');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $num;
    }

    public static function minutesFormat($num) {

        $num = floor($num);

        if($num > 1000) {
      
              $x = round($num);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array('K', 'M', 'B', 'T');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $num;
    }
}