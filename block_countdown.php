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
        
        // Set title.
        if ($this->config->title) {
            $this->title = $this->config->title;
        }
        
        $this->page->requires->jquery();
        $this->page->requires->js("/blocks/countdown/js/jquery.countdown.js");
        $this->page->requires->js("/blocks/countdown/js/start.js");
        
        if ($this->config->until > time()) {
            $this->content->text = html_writer::tag('div', '', [
                'id' => 'block_countdown_timer',
                'data-daystext' => get_string('daystext', 'block_countdown'),
                'data-datetime' => date('Y/m/d H:m:i', $this->config->until)
            ]);
        } else {
            if ($this->config->ended_text) {
                $endedtext = $this->config->ended_text;
            } else {
                $endedtext = get_string('changesettings', 'block_countdown');
            }
            
            $this->content->text = html_writer::tag('dev', $endedtext, [
                'class' => 'countdown-ended'
            ]);
        }
        return $this->content;
    }
    
}