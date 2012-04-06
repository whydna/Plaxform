<?php
// helper functions related to time
class App_Tools_TimeHelper
{
    public static function timeAgo($timestamp)
    {
    	$difference = time() - $timestamp;
    	$periods = array("sec", "min", "hr", "day", "wk", "mth", "yr", "decade");
    	$lengths = array("60","60","24","7","4.35","12","10");
    	
    	for ($j = 0; $difference >= $lengths[$j]; $j++){
    	   $difference /= $lengths[$j];
    	}
    	
    	$difference = round($difference);
    	
    	if ($difference != 1) {
    	    $periods[$j] .= "s";
    	}
    	
    	$text = "$difference $periods[$j] ago";
    	
    	return $text;
    }
    
	public static function secsToDuration($secs) 
    { 
    	if (!$secs) {
    		return '0s';
    	}
    	
        /*$vals = array('w' => (int) ($secs / 86400 / 7), 
                      'd' => $secs / 86400 % 7, 
                      'h' => $secs / 3600 % 24, 
                      'm' => $secs / 60 % 60, 
                      's' => $secs % 60);*/ 
    	
    	$vals = array('h' => $secs / 3600 % 24, 
                      'm' => $secs / 60 % 60, 
                      's' => $secs % 60);
 
        $ret = array(); 
 
        $added = false; 
        foreach ($vals as $k => $v) { 
            if ($v > 0 || $added) { 
                $added = true; 
                $ret[] = $v . $k; 
            } 
        } 
 
        return join(' ', $ret); 
    } 
    
	function convertTimeZone($dateTimeString, $toTimeZone, $fromTimeZone='America/New_York', $outputFormat = 'F j, Y g:i a') 
	{
	    $fromTimeZone = new DateTimeZone($fromTimeZone);
	    $toTimeZone = new DateTimeZone($toTimeZone);
	
	    $dateTime = new DateTime($dateTimeString, $fromTimeZone);
	    $dateTime->setTimezone($toTimeZone);
	
	    return $dateTime->format($outputFormat);
	}
    
	public static function getTimeZoneArray()
	{
		return array(
			'Pacific/Midway'=>'(GMT-11:00) Midway Island, Samoa',
			'America/Adak'=>'(GMT-10:00) Hawaii-Aleutian',
			'Etc/GMT+10'=>'(GMT-10:00) Hawaii',
			'Pacific/Marquesas'=>'(GMT-09:30) Marquesas Islands',
			'Pacific/Gambier'=>'(GMT-09:00) Gambier Islands',
			'America/Anchorage'=>'(GMT-09:00) Alaska',
			'America/Ensenada'=>'(GMT-08:00) Tijuana, Baja California',
			'Etc/GMT+8'=>'(GMT-08:00) Pitcairn Islands',
			'America/Los_Angeles'=>'(GMT-08:00) Pacific Time (US & Canada)',
			'America/Denver'=>'(GMT-07:00) Mountain Time (US & Canada)',
			'America/Chihuahua'=>'(GMT-07:00) Chihuahua, La Paz, Mazatlan',
			'America/Dawson_Creek'=>'(GMT-07:00) Arizona',
			'America/Belize'=>'(GMT-06:00) Saskatchewan, Central America',
			'America/Cancun'=>'(GMT-06:00) Guadalajara, Mexico City, Monterrey',
			'Chile/EasterIsland'=>'(GMT-06:00) Easter Island',
			'America/Chicago'=>'(GMT-06:00) Central Time (US & Canada)',
			'America/New_York'=>'(GMT-05:00) Eastern Time (US & Canada)',
			'America/Havana'=>'(GMT-05:00) Cuba',
			'America/Bogota'=>'(GMT-05:00) Bogota, Lima, Quito, Rio Branco',
			'America/Caracas'=>'(GMT-04:30) Caracas',
			'America/Santiago'=>'(GMT-04:00) Santiago',
			'America/La_Paz'=>'(GMT-04:00) La Paz',
			'Atlantic/Stanley'=>'(GMT-04:00) Faukland Islands',
			'America/Campo_Grande'=>'(GMT-04:00) Brazil',
			'America/Goose_Bay'=>'(GMT-04:00) Atlantic Time (Goose Bay)',
			'America/Glace_Bay'=>'(GMT-04:00) Atlantic Time (Canada)',
			'America/St_Johns'=>'(GMT-03:30) Newfoundland',
			'America/Araguaina'=>'(GMT-03:00) UTC-3',
			'America/Montevideo'=>'(GMT-03:00) Montevideo',
			'America/Miquelon'=>'(GMT-03:00) Miquelon, St. Pierre',
			'America/Godthab'=>'(GMT-03:00) Greenland',
			'America/Argentina/Buenos_Aires'=>'(GMT-03:00) Buenos Aires',
			'America/Sao_Paulo'=>'(GMT-03:00) Brasilia',
			'America/Noronha'=>'(GMT-02:00) Mid-Atlantic',
			'Atlantic/Cape_Verde'=>'(GMT-01:00) Cape Verde Is.',
			'Atlantic/Azores'=>'(GMT-01:00) Azores',
			'Europe/Belfast'=>'(GMT) Greenwich Mean Time : Belfast',
			'Europe/Dublin'=>'(GMT) Greenwich Mean Time : Dublin',
			'Europe/Lisbon'=>'(GMT) Greenwich Mean Time : Lisbon',
			'Europe/London'=>'(GMT) Greenwich Mean Time : London',
			'Africa/Abidjan'=>'(GMT) Monrovia, Reykjavik',
			'Europe/Amsterdam'=>'(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna',
			'Europe/Belgrade'=>'(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague',
			'Europe/Brussels'=>'(GMT+01:00) Brussels, Copenhagen, Madrid, Paris',
			'Africa/Algiers'=>'(GMT+01:00) West Central Africa',
			'Africa/Windhoek'=>'(GMT+01:00) Windhoek',
			'Asia/Beirut'=>'(GMT+02:00) Beirut',
			'Africa/Cairo'=>'(GMT+02:00) Cairo',
			'Asia/Gaza'=>'(GMT+02:00) Gaza',
			'Africa/Blantyre'=>'(GMT+02:00) Harare, Pretoria',
			'Asia/Jerusalem'=>'(GMT+02:00) Jerusalem',
			'Europe/Minsk'=>'(GMT+02:00) Minsk',
			'Asia/Damascus'=>'(GMT+02:00) Syria',
			'Europe/Moscow'=>'(GMT+03:00) Moscow, St. Petersburg, Volgograd',
			'Africa/Addis_Ababa'=>'(GMT+03:00) Nairobi',
			'Asia/Tehran'=>'(GMT+03:30) Tehran',
			'Asia/Dubai'=>'(GMT+04:00) Abu Dhabi, Muscat',
			'Asia/Yerevan'=>'(GMT+04:00) Yerevan',
			'Asia/Kabul'=>'(GMT+04:30) Kabul',
			'Asia/Yekaterinburg'=>'(GMT+05:00) Ekaterinburg',
			'Asia/Tashkent'=>'(GMT+05:00) Tashkent',
			'Asia/Kolkata'=>'(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi',
			'Asia/Katmandu'=>'(GMT+05:45) Kathmandu',
			'Asia/Dhaka'=>'(GMT+06:00) Astana, Dhaka',
			'Asia/Novosibirsk'=>'(GMT+06:00) Novosibirsk',
			'Asia/Rangoon'=>'(GMT+06:30) Yangon (Rangoon)',
			'Asia/Bangkok'=>'(GMT+07:00) Bangkok, Hanoi, Jakarta',
			'Asia/Krasnoyarsk'=>'(GMT+07:00) Krasnoyarsk',
			'Asia/Hong_Kong'=>'(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi',
			'Asia/Irkutsk'=>'(GMT+08:00) Irkutsk, Ulaan Bataar',
			'Australia/Perth'=>'(GMT+08:00) Perth',
			'Australia/Eucla'=>'(GMT+08:45) Eucla',
			'Asia/Tokyo'=>'(GMT+09:00) Osaka, Sapporo, Tokyo',
			'Asia/Seoul'=>'(GMT+09:00) Seoul',
			'Asia/Yakutsk'=>'(GMT+09:00) Yakutsk',
			'Australia/Adelaide'=>'(GMT+09:30) Adelaide',
			'Australia/Darwin'=>'(GMT+09:30) Darwin',
			'Australia/Brisbane'=>'(GMT+10:00) Brisbane',
			'Australia/Hobart'=>'(GMT+10:00) Hobart',
			'Asia/Vladivostok'=>'(GMT+10:00) Vladivostok',
			'Australia/Lord_Howe'=>'(GMT+10:30) Lord Howe Island',
			'Etc/GMT-11'=>'(GMT+11:00) Solomon Is., New Caledonia',
			'Asia/Magadan'=>'(GMT+11:00) Magadan',
			'Pacific/Norfolk'=>'(GMT+11:30) Norfolk Island',
			'Asia/Anadyr'=>'(GMT+12:00) Anadyr, Kamchatka',
			'Pacific/Auckland'=>'(GMT+12:00) Auckland, Wellington',
			'Etc/GMT-12'=>'(GMT+12:00) Fiji, Kamchatka, Marshall Is.',
			'Pacific/Chatham'=>'(GMT+12:45) Chatham Islands',
			'Pacific/Tongatapu'=>'(GMT+13:00) Nukualofa',
			'Pacific/Kiritimati'=>'(GMT+14:00) Kiritimati'
		);
	}
	
    public static function getHtmlSelectTimeZoneOptions()
    {
    	return '<option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
			<option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
			<option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
			<option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
			<option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
			<option value="America/Anchorage">(GMT-09:00) Alaska</option>
			<option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
			<option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
			<option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
			<option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
			<option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
			<option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
			<option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
			<option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
			<option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
			<option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
			<option value="America/New_York" selected>(GMT-05:00) Eastern Time (US & Canada)</option>
			<option value="America/Havana">(GMT-05:00) Cuba</option>
			<option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
			<option value="America/Caracas">(GMT-04:30) Caracas</option>
			<option value="America/Santiago">(GMT-04:00) Santiago</option>
			<option value="America/La_Paz">(GMT-04:00) La Paz</option>
			<option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
			<option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
			<option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
			<option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
			<option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
			<option value="America/Araguaina">(GMT-03:00) UTC-3</option>
			<option value="America/Montevideo">(GMT-03:00) Montevideo</option>
			<option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
			<option value="America/Godthab">(GMT-03:00) Greenland</option>
			<option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
			<option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
			<option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
			<option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
			<option value="Atlantic/Azores">(GMT-01:00) Azores</option>
			<option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
			<option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
			<option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
			<option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
			<option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
			<option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
			<option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
			<option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
			<option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
			<option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
			<option value="Asia/Beirut">(GMT+02:00) Beirut</option>
			<option value="Africa/Cairo">(GMT+02:00) Cairo</option>
			<option value="Asia/Gaza">(GMT+02:00) Gaza</option>
			<option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
			<option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
			<option value="Europe/Minsk">(GMT+02:00) Minsk</option>
			<option value="Asia/Damascus">(GMT+02:00) Syria</option>
			<option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
			<option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
			<option value="Asia/Tehran">(GMT+03:30) Tehran</option>
			<option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
			<option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
			<option value="Asia/Kabul">(GMT+04:30) Kabul</option>
			<option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
			<option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
			<option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
			<option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
			<option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
			<option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
			<option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
			<option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
			<option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
			<option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
			<option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
			<option value="Australia/Perth">(GMT+08:00) Perth</option>
			<option value="Australia/Eucla">(GMT+08:45) Eucla</option>
			<option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
			<option value="Asia/Seoul">(GMT+09:00) Seoul</option>
			<option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
			<option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
			<option value="Australia/Darwin">(GMT+09:30) Darwin</option>
			<option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
			<option value="Australia/Hobart">(GMT+10:00) Hobart</option>
			<option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
			<option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
			<option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
			<option value="Asia/Magadan">(GMT+11:00) Magadan</option>
			<option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
			<option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
			<option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
			<option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
			<option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
			<option value="Pacific/Tongatapu">(GMT+13:00) Nukualofa</option>
			<option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>';
    }
}
?>