<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Countdown plugin
 * http://docs.moodle.org/dev/
 *
 * @package    block_countdown
 * @copyright  Yevhen Matasar <matasar.ei@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die('Direct access to this script is forbidden.');

class block_countdown extends block_base {

    /**
     * Init function
     * @return void
     */
    function init() {
        $this->title = get_string('pluginname','block_countdown');
    }
    
    const STYLE_DEFAULT = 'style-default';
    const STYLE_CORPORATE = 'style-corporate';

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
            $params['class'] = "block-countdown-timer {$this->config->style}";
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
        if ($this->config->css) {
            $this->content->text = html_writer::tag('style', $this->config->css) 
                                 . $this->content->text;
        }
        return $this->content;
    }

}