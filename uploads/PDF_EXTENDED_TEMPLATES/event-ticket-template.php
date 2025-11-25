<?php
/**
 * Template Name: Event Ticket
 * Version: 1.3
 * Description: A custom PDF template for the Event Registration Form (Form ID: 4) that generates a clean and professional event ticket.
 * Author: Jules
 * Group: Custom
 * Required PDF Version: 4.0
 */

/*
 * See https://gravitypdf.com/documentation/v4/developer-custom-pdf-templates/ for more details about custom templates.
 */

/*
 * All variables are pulled from the PDF Abstract class and are available to this template
 * @var array $form The Gravity Form object
 * @var array $entry The Gravity Form entry object
 * @var array $form_data The processed entry data stored in an array
 * @var array $settings The PDF settings
 * @var array $fields An array of Gravity Form fields
 * @var array $config The Gravity PDF configuration array
 * @var object $gfpdf The Gravity PDF object
 * @var string $data The path to the data directory
 * @var string $template The path to the template directory
 * @var string $basename The template basename
 * @var string $template_pdf_data The template-specific data saved in the PDF settings
 */

/*
 * Load our template-specific styles
 */
?>

<style>
    .ticket-container {
        font-family: sans-serif;
        border: 1px solid #ccc;
        padding: 20px;
        width: 100%;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
    }
    .header img {
        max-width: 200px;
        max-height: 100px;
    }
    .content {
        margin-bottom: 20px;
    }
    .content h1 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .content table {
        width: 100%;
        border-collapse: collapse;
    }
    .content th, .content td {
        padding: 10px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }
    .content th {
        font-weight: bold;
        width: 150px;
    }
    .qr-code {
        text-align: center;
        margin-top: 20px;
    }
</style>

<?php
/*
 * RENDER THE TEMPLATE
 * Here you can build out your template using the variables passed to the view
 */

// Get the field IDs from the template settings
$event_name_field_id = !empty($settings['event_name']) ? $settings['event_name'] : 0;
$registrant_name_field_id = !empty($settings['registrant_name']) ? $settings['registrant_name'] : 0;
$num_attendees_field_id = !empty($settings['num_attendees']) ? $settings['num_attendees'] : 0;
$add_ons_field_id = !empty($settings['add_ons']) ? $settings['add_ons'] : 0;

// Get field values from the $form_data array
$event_name = !empty($form_data['field'][$event_name_field_id]) ? $form_data['field'][$event_name_field_id] : 'N/A';
$registrant_name = !empty($form_data['field'][$registrant_name_field_id]) ? $form_data['field'][$registrant_name_field_id] : 'N/A';
$num_attendees = !empty($form_data['field'][$num_attendees_field_id]) ? $form_data['field'][$num_attendees_field_id] : 'N/A';
$add_ons = !empty($form_data['field'][$add_ons_field_id]) ? $form_data['field'][$add_ons_field_id] : 'None';


// Construct the URL for the QR code (links to the entry view in wp-admin)
$entry_url = get_site_url() . '/wp-admin/admin.php?page=gf_entries&view=entry&id=' . $form['id'] . '&lid=' . $entry['id'];

// Get the logo path from the settings
$logo_path = !empty($settings['company_logo']) ? $settings['company_logo'] : '';

?>

<div class="ticket-container">
    <div class="header">
        <?php if ($logo_path): ?>
            <img src="<?php echo $logo_path; ?>" alt="Company Logo" />
        <?php endif; ?>
    </div>

    <div class="content">
        <h1>Event Ticket</h1>
        <table>
            <tr>
                <th>Event Name</th>
                <td><?php echo esc_html($event_name); ?></td>
            </tr>
            <tr>
                <th>Registrant Name</th>
                <td><?php echo esc_html($registrant_name); ?></td>
            </tr>
            <tr>
                <th>Number of Attendees</th>
                <td><?php echo esc_html($num_attendees); ?></td>
            </tr>
            <tr>
                <th>Add-ons</th>
                <td><?php echo wp_kses_post($add_ons); ?></td>
            </tr>
        </table>
    </div>

    <div class="qr-code">
        <barcode code="<?php echo esc_attr($entry_url); ?>" type="QR" size="1.5" error="M" disableborder="1" />
        <p>Scan for details</p>
    </div>
</div>
