<?php
/**
 * Countdown plugin
 * http://docs.moodle.org/dev/
 *
 * @package    block_countdown
 * @copyright  Yevhen Matasar <matasar.ei@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */ 
class block_countdown extends block_base {
    
    /**
     * Init function
     * @return void
     */
    function init() {
        $this->title = get_string('pluginname','block_countdown');
    }
    
    /**
     * Returns content of the block
     * @return string Content of the block
     */
    function get_content() {
        global $CFG;

	if (empty($this->content)) {
            $this->content = new stdClass();
        }
	if (is_null($this->config)) {
            $this->content->text = get_string('changesettings', 'block_countdown');
            return $this->content;
	}

        // Set title.
        if ($this->config->title) {
            $this->title = $this->config->title;
        }
        
        $this->page->requires->jquery();
        $this->page->requires->js("/blocks/countdown/js/jquery.countdown.js");
        $this->page->requires->js("/blocks/countdown/js/start.js");
        $tag = 'div';
        $params = array();
        if ($this->config->url) {
            $params['href'] = $this->config->url;
            $params['target'] = $this->config->urltarget;
            $tag = 'a';
        }
        
        if ($this->config->until > time()) {
            $params['class'] = 'block_countdown_timer';
            $params['data-daystext'] = get_string('daystext', 'block_countdown');
            $params['data-datetime'] = date('Y/m/d H:m:i', $this->config->until);
            $this->content->text = html_writer::tag($tag, '', $params);
        } else {    
            if ($this->config->ended_text) {
                $endedtext = $this->config->ended_text;
            } else {
                $endedtext = get_string('changesettings', 'block_countdown');
            }
            $params['class'] = 'countdown-ended';
            $this->content->text = html_writer::tag($tag, $endedtext, $params);
        }
        return $this->content;
    }
    
}
