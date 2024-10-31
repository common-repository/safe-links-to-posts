<?php
/**
 * Plugin Name: Safe Links
 * Plugin URI:  https://thekrotek.com/wordpress-extensions/miscellaneous
 * Description: Allows you to add safe (non-SEF) relative links in posts and automatically makes them SEF (or non-SEF) on post display.
 * Version:     1.0.0
 * Author:      The Krotek
 * Author URI:  https://thekrotek.com
 * Text Domain: safelinks 
 * License:     GPL2
 */
 
defined("ABSPATH") or die("Restricted access");

$safelinks = new safeLinks();

class safeLinks
{
	var $textdomain;
	
	public function __construct()
	{
		add_action('init', array($this, 'init'));
		add_action('admin_init', array($this, 'admin_init'));
		
		$this->textdomain = 'safelinks';
	}
	
	public function init()
	{
		add_filter('the_content', array($this, 'updateLinks'), 1000, 1);
	}
		
	public function admin_init()
	{
		add_filter('plugin_row_meta', array($this, 'updatePluginMeta'), 10, 2);
		add_filter('wp_link_query', array($this, 'updateQuery'), 10, 2);
		
		$page = 'permalink';
		$section = 'safelinks_section';
		
		add_settings_section($section, __('Safe Links settings', $this->textdomain), array($this, 'addSection'), $page);
		
		// Query Mode
	
		$id = 'safelinks-query-mode';
		$name = str_replace('-', '_', $id);
		
		$params = array(
			'id' => $id,
			'name' => $name,
			'default' => 'absolute',
			'options' => array('absolute' => __('Absolute', $this->textdomain), 'relative' => __('Relative', $this->textdomain)));
		
		register_setting($page, $name);
		add_settings_field($name, '<label for="'.$id.'">'.__('Links query mode', $this->textdomain).'</label>', array($this, 'safeFieldSelect'), $page, $section, $params);
		
		// Display Mode
	
		$id = 'safelinks-display-mode';
		$name = str_replace('-', '_', $id);
		
		$params = array(
			'id' => $id,
			'name' => $name,
			'default' => 'auto',
			'options' => array('auto' => __('Auto', $this->textdomain), 'nonsef' => __('Non-SEF', $this->textdomain)));
		
		register_setting($page, $name);
		add_settings_field($name, '<label for="'.$id.'">'.__('Links display mode', $this->textdomain).'</label>', array($this, 'safeFieldSelect'), $page, $section, $params);
	}
		
	public function addSection($note)
	{
		echo '<p>'.__('Select, how you want to add links to posts on back-end and how you want to display them on front-end.', $this->textdomain).'</p>';
	}
		
	public function safeFieldSelect($params)
	{
		echo '<select id="'.$params['id'].'" name="'.esc_attr($params['name']).'">';
	
		foreach ($params['options'] as $value => $title) {
			echo '<option value="'.$value.'"'.(get_option($params['name'], $params['default']) == $value ? ' selected="selected"' : '').'>'.$title.'</option>';
		}
	
		echo '</select>';
	}
			
	public function updateLinks($content)
	{
  		preg_match_all("/<a (?:.*)href=[\"\']((?:(?![\"\'])[^>])*)[\"\'][^>]*>/siU", $content, $matches);
	
		if (!empty($matches[1])) {
			$links = array_unique($matches[1]);
		
			foreach ($links as $link) {
				preg_match("/\?p=(\d+)/", $link, $match);
			
				if (!empty($match[1])) {
					if (get_option('safelinks_display_mode', 'auto') == 'auto') {
						$content = str_replace($link, get_permalink($match[1]), $content);
					} else {
						$content = str_replace($link, wp_get_shortlink($match[1]), $content);
					}
				}
			}
		}
	
		return $content;
	}

	public function updatePluginMeta($links, $file)
	{
		if ($file == plugin_basename(__FILE__)) {
			$links = array_merge($links, array('<a href="options-permalink.php">'.__('Settings', $this->textdomain).'</a>'));
			$links = array_merge($links, array('<a href="https://thekrotek.com/support">'.__('Donate & Support', $this->textdomain).'</a>'));
		}
	
		return $links;
	}
	
	public function updateQuery($results, $query)
	{ 
		foreach ($results as $key => $result) {
			if (get_option('safelinks_query_mode', 'absolute') == 'absolute') {
				$permalink = wp_get_shortlink($result['ID']);
			} else {
				$permalink = "?p=".$result['ID'];
			}
			
			$results[$key]['permalink'] = $permalink;
		}
	
    	return $results; 
	}
}

?>