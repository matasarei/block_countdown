<?php
/**
 * Edit form
 * http://docs.moodle.org/dev/
 *
 * @package    block_countdown
 * @copyright  Yevhen Matasar <matasar.ei@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_countdown_edit_form extends block_edit_form {
 
    /**
     * Defines edit form
     * 
     * @return void
     */
    protected function specific_definition($mform) {
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));
        $mform->addElement('text', 'config_title', get_string('countdown_title', 'block_countdown'));
        $mform->addElement('date_time_selector', 'config_until', get_string('until', 'block_countdown'));
        $mform->addElement('text', 'config_ended_text', get_string('countdown_ended_text', 'block_countdown'));
        $mform->addElement('textarea', 'config_css', get_string("css", "block_countdown"), [
            'wrap' => "virtual", 
            'rows' => "20", 
            'cols' => "50"
        ]);
    }
}