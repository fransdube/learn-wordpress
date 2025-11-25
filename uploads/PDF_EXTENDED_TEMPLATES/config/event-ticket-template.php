<?php
namespace GFPDF\Templates\Config;

use GFPDF\Helper\Helper_Interface_Config;
use GFPDF\Helper\Helper_Abstract_Config_Settings;

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @package  GFPDF\Templates\Config
 */
class Event_Ticket extends Helper_Abstract_Config_Settings implements Helper_Interface_Config {

    /**
     * Return the templates configuration structure which control what extra fields will be shown in the "Template" section when configuring a form's PDF.
     *
     * @return array The array, split into core components and custom fields
     */
    public function configuration() {
        return [
            /* Create custom fields to control the look and feel of a template */
            'fields' => [
                'company_logo' => [
                    'id'   => 'company_logo',
                    'name' => 'Company Logo',
                    'type' => 'upload',
                    'desc' => 'Upload a company logo to be displayed on the ticket.',
                ],
                'event_name' => [
                    'id'   => 'event_name',
                    'name' => 'Event Name',
                    'type' => 'text',
                    'desc' => 'Enter the Field ID for the event name.',
                    'std'  => '',
                ],
                'registrant_name' => [
                    'id'   => 'registrant_name',
                    'name' => 'Registrant Name',
                    'type' => 'text',
                    'desc' => 'Enter the Field ID for the registrant\'s name.',
                    'std'  => '',
                ],
                'num_attendees' => [
                    'id'   => 'num_attendees',
                    'name' => 'Number of Attendees',
                    'type' => 'text',
                    'desc' => 'Enter the Field ID for the number of attendees.',
                    'std'  => '',
                ],
                'add_ons' => [
                    'id'   => 'add_ons',
                    'name' => 'Add-ons',
                    'type' => 'text',
                    'desc' => 'Enter the Field ID for the add-ons.',
                    'std'  => '',
                ],
            ],
        ];
    }
}
