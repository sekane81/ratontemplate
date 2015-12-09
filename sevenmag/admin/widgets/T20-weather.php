<?php
class T20_weather extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_weather', 'description' => __('A widget to display weather in the sidebar.', 'T20') );
		parent::__construct( 't20_weather_widget', __('T20 - Weather', 'T20'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$location_id = $instance['location_id'];
		$weather_unit = $instance['weather_unit'];	

		if ( $weather_unit == "celsius" ){
			$weather_unit = "c";
			$unit_name = "&deg;C";
		} else {
			$weather_unit = "f";
			$unit_name = "F";
		}
			
		if ( !empty( $location_id ) ){			
			$interval = 3600; //one hour	
			$stored_location_id = get_option('T20_weather_location_id');
			
			if( ($location_id != $stored_location_id) OR ($_SERVER['REQUEST_TIME'] > get_option('T20_weather_cache_time'))) {
			
				$query_url = 'http://weather.yahooapis.com/forecastrss?w=' . $location_id . '&u=' . $weather_unit;  
				if($xml = @simplexml_load_file($query_url)){  
					$error = strpos(strtolower($xml->channel->description), 'error');	//server response but no weather data for woeid  
				}else{  
					$error = TRUE;
				}	 
	  
				if(!$error){  
					$city = $xml->channel->children('yweather', TRUE)->location->attributes()->city;  
		
					$temperature = $xml->channel->item->children('yweather', TRUE)->condition->attributes()->temp;			
					$conditions_text = $xml->channel->item->children('yweather', TRUE)->condition->attributes()->text; 
					$today_code = $xml->channel->item->children('yweather', TRUE)->condition->attributes()->code; 
			
					$humidity = $xml->channel->children('yweather', TRUE)->atmosphere->attributes()->humidity; 
					$wind = $xml->channel->children('yweather', TRUE)->wind->attributes()->speed; 
			 
					$next_day = $xml->channel->item->children('yweather', TRUE)->forecast[0]->attributes()->date;
					$next_day_low = $xml->channel->item->children('yweather', TRUE)->forecast[0]->attributes()->low;
					$next_day_high = $xml->channel->item->children('yweather', TRUE)->forecast[0]->attributes()->high;
					$next_day_code = $xml->channel->item->children('yweather', TRUE)->forecast[0]->attributes()->code;
			
					$day_after = $xml->channel->item->children('yweather', TRUE)->forecast[1]->attributes()->date;
					$day_after_low = $xml->channel->item->children('yweather', TRUE)->forecast[1]->attributes()->low;
					$day_after_high = $xml->channel->item->children('yweather', TRUE)->forecast[1]->attributes()->high;
					$day_after_code = $xml->channel->item->children('yweather', TRUE)->forecast[1]->attributes()->code;
				
					$code_types = array(
						'storm'	=> array(
							0,1,2,3,4,37,38,39,45,47
						),
						'snow'	=> array(
							7,13,14,15,16,17,18,41,42,43
						),
						'rain'	=> array(
							5,6,8,9,10,11,12,35,40
						),
						'cloudy' => array(
							19,20,21,22,23,24,25,26,27,28,29,30,44
						),
						'sunny'	=> array(
							31,32,33,34,36
						)
					);
									
					if(in_array($today_code, $code_types['storm'])) {
						$today_icon = 'A';
					} elseif(in_array($today_code, $code_types['snow'])) {
						$today_icon = 'X';
					} elseif(in_array($today_code, $code_types['rain'])) {
						$today_icon = 'R';
					} elseif(in_array($today_code, $code_types['cloudy'])) {
						$today_icon = 'Y';
					} elseif(in_array($today_code, $code_types['sunny'])) {
						$today_icon = 'B';
					} else {
						$today_icon = 'H';
					}
				
					if(in_array($next_day_code, $code_types['storm'])) {
						$next_day_icon = 'A';
					} elseif(in_array($next_day_code, $code_types['snow'])) {
						$next_day_icon = 'X';
					} elseif(in_array($next_day_code, $code_types['rain'])) {
						$next_day_icon = 'R';
					} elseif(in_array($next_day_code, $code_types['cloudy'])) {
						$next_day_icon = 'Y';
					} elseif(in_array($next_day_code, $code_types['sunny'])) {
						$next_day_icon = 'B';
					} else {
						$next_day_icon = 'H';
					}
				
					if(in_array($day_after_code, $code_types['storm'])) {
						$day_after_icon = 'A';
					} elseif(in_array($day_after_code, $code_types['snow'])) {
						$day_after_icon = 'X';
					} elseif(in_array($day_after_code, $code_types['rain'])) {
						$day_after_icon = 'R';
					} elseif(in_array($day_after_code, $code_types['cloudy'])) {
						$day_after_icon = 'Y';
					} elseif(in_array($day_after_code, $code_types['sunny'])) {
						$day_after_icon = 'B';
					} else {
						$day_after_icon = 'H';
					}
					
					if (!empty($city)){
						update_option('T20_weather_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
						update_option('T20_weather_location_id', (string)$location_id);
						update_option('T20_weather_city', (string)$city);
						update_option('T20_weather_temp', (string)$temperature);
						update_option('T20_weather_condition', (string)$conditions_text);
						update_option('T20_weather_today_icon', (string)$today_icon);
						update_option('T20_weather_humidity', (string)$humidity);
						update_option('T20_weather_wind', (string)$wind);
						update_option('T20_weather_nextday', (string)$next_day);
						update_option('T20_weather_nextday_low', (string)$next_day_low);
						update_option('T20_weather_nextday_high', (string)$next_day_high);
						update_option('T20_weather_nextday_icon', (string)$next_day_icon);
						update_option('T20_weather_dayafter', (string)$day_after);
						update_option('T20_weather_dayafter_low', (string)$day_after_low);
						update_option('T20_weather_dayafter_high', (string)$day_after_high);
						update_option('T20_weather_dayafter_icon', (string)$day_after_icon);
					}				
				} // no error			
			} //update
		?>
			<style>
				@font-face {
					font-family: 'MeteoconsRegular';
					src: url('<?php echo get_template_directory_uri() .'/styles/font/meteocons-webfont.eot' ?>');
					src: url('<?php echo get_template_directory_uri() .'/styles/font/meteocons-webfont.eot?#iefix' ?>') format('embedded-opentype'),
						url('<?php echo get_template_directory_uri() .'/styles/font/meteocons-webfont.svg#MeteoconsRegular' ?>') format('svg'),
						url('<?php echo get_template_directory_uri() .'/styles/font/meteocons-webfont.ttf' ?>') format('truetype'),
						url('<?php echo get_template_directory_uri() .'/styles/font/meteocons-webfont.woff' ?>') format('woff');
					font-weight: normal;
					font-style: normal;
				}
				[data-icon]:before {font-family: 'MeteoconsRegular';content: attr(data-icon);}
				.icon_weather {font-size: 100px;margin-bottom: 6px;}
				.icon_weather.smallest {font-size: 30px;margin: 0}
				.weather_widget {background: #1D1E20; padding: 10px 20px 20px;color: #FFF; border-radius: 2px;margin: 0 0 40px; box-shadow: 0 0 13px rgba(0, 0, 0, 0.1) }
				.today_weather { border-bottom: 1px solid #313131; padding: 0 0 10px 0;margin: 0 0 10px 0 }
				.today_weather .big_icon { text-align: center;float: right;margin: 0;width: 50% }
				.details_w { float: left;color: #7C7C7C;padding: 12px 0 0 0;width: 50%; }
				.details_w h3 { color: #fff }
				.next_days { text-align: center;color: #7C7C7C }
				.next_days .date { font-size: 10px }
				.detailes i { font-size: 12px }
				.next_days .icon_weather { color: #ddd }
			</style>
			
			<div class="weather_widget introfx">
				<div class="today_weather clearfix mb">
					<div class="details_w">
						<h3><?php echo get_option('T20_weather_city'); ?></h3>			
						<div class="condition"><?php echo get_option('T20_weather_condition'); ?></div>
						<div class="humidity"><?php _e('Humidity:', 'T20'); ?> <?php echo get_option('T20_weather_humidity'); ?></div>			
						<div class="wind"><?php _e('Wind:', 'T20'); ?> <?php echo get_option('T20_weather_wind'); ?> <?php _e('km/h', 'T20'); ?></div>		
					</div>
					<div class="big_icon">
						<div class="icon_weather" data-icon="<?php echo get_option('T20_weather_today_icon'); ?>"></div>
						<div class="temp"><?php echo get_option('T20_weather_temp'); ?> <?php echo $unit_name; ?></div>
					</div>
				</div>

				<div class="next_days clearfix">
					<div style="float: left;">
						<div class="icon_weather smallest" data-icon="<?php echo get_option('T20_weather_nextday_icon'); ?>"></div>
						<div class="detailes">
							<span class="nextdaylow"><?php echo get_option('T20_weather_nextday_low'); ?> <i class="fa fa-caret-down"></i></span>
							<span class="nextdayhigh"><?php echo get_option('T20_weather_nextday_high'); ?> <i class="fa fa-caret-up"></i></span>			
						</div>
						<div class="date"><?php echo get_option('T20_weather_nextday'); ?></div>
					</div>
				
					<div style="float: right;">
						<div class="icon_weather smallest" data-icon="<?php echo get_option('T20_weather_dayafter_icon'); ?>"></div>
						<div class="detailes">
							<span class="dayafterlow"><?php echo get_option('T20_weather_dayafter_low'); ?> <i class="fa fa-caret-down"></i></span>
							<span class="dayafterhigh"><?php echo get_option('T20_weather_dayafter_high'); ?> <i class="fa fa-caret-up"></i></span>
						</div>
						<div class="date"><?php echo get_option('T20_weather_dayafter'); ?></div>			
					</div>        		
				</div>
			</div>
		<?php }  
	} 

	/**
	 * update widget settings
	 */	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['location_id'] = $new_instance['location_id'];
		$instance['weather_unit'] = $new_instance['weather_unit'];			
		return $instance;
	}

	 function form( $instance ) {
		$defaults = array(
			'location_id' => '',
			'weather_unit' => 'celsius'			
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'location_id' ); ?>"><?php _e('Location ID:', 'T20') ?></label>
			<input class="widefat" style="width: 100%;display:block" id="<?php echo $this->get_field_id( 'location_id' ); ?>" name="<?php echo $this->get_field_name( 'location_id' ); ?>" value="<?php echo $instance['location_id']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'unit' ); ?>"><?php _e('Weather unit:', 'T20') ?></label>			
			<select name="<?php echo $this->get_field_name('weather_unit'); ?>" id="<?php echo $this->get_field_id('weather_unit'); ?>" class="widefat">
				<option value="celsius"<?php selected( $instance['weather_unit'], 'celsius' ); ?>><?php _e('Celsius', 'T20'); ?></option>
				<option value="fahrenheit"<?php selected( $instance['weather_unit'], 'fahrenheit' ); ?>><?php _e('Fahrenheit', 'T20'); ?></option>
			</select>
		</p>
		<p> Seach your ID here: http://weather.yahoo.com/ </p>
		<p> WOEID* : If you search for New York on the Yahoo Weather site, the page for that city is http://weather.yahoo.com/united-states/texas/new-york-2459114/ That the WOEID is 2459114 </p>
	<?php 
	}
}