<?php
/**
 * Template Name: Event Ticket
 * Version: 1.5
 * Description: A custom PDF template for the Event Registration Form (Form ID: 4) that generates a clean and professional event ticket.
 * Author: Jules
 * Group: Custom
 * Required PDF Version: 4.0
 */

/*
 * See https://gravitypdf.com/documentation/v4/developer-custom-pdf-templates/ for more details about custom templates.
 */

// Get the field IDs from the template settings, with fallbacks to the defaults for Form ID 4
$event_name_field_id      = ! empty( $settings['event_name'] ) ? $settings['event_name'] : 15;
$registrant_name_field_id = ! empty( $settings['registrant_name'] ) ? $settings['registrant_name'] : 1;
$registrant_email_field_id = ! empty( $settings['registrant_email'] ) ? $settings['registrant_email'] : 2;
$registrant_phone_field_id = ! empty( $settings['registrant_phone'] ) ? $settings['registrant_phone'] : 3;
$num_attendees_field_id   = ! empty( $settings['num_attendees'] ) ? $settings['num_attendees'] : 22;
$add_ons_field_id         = ! empty( $settings['add_ons'] ) ? $settings['add_ons'] : 23;
$total_cost_field_id      = ! empty( $settings['total_cost'] ) ? $settings['total_cost'] : 7;


// Get field values from the $form_data array
$event_name       = ! empty( $form_data['field'][ $event_name_field_id ] ) ? $form_data['field'][ $event_name_field_id ] : 'N/A';
$registrant_email = ! empty( $form_data['field'][ $registrant_email_field_id ] ) ? $form_data['field'][ $registrant_email_field_id ] : 'N/A';
$registrant_phone = ! empty( $form_data['field'][ $registrant_phone_field_id ] ) ? $form_data['field'][ $registrant_phone_field_id ] : 'N/A';
$num_attendees    = ! empty( $form_data['field'][ $num_attendees_field_id ] ) ? $form_data['field'][ $num_attendees_field_id ] : 'N/A';
$total_cost       = ! empty( $form_data['field'][ $total_cost_field_id ] ) ? $form_data['field'][ $total_cost_field_id ] : 'N/A';


// Handle complex Name field
$name_parts      = ! empty( $form_data['field'][ $registrant_name_field_id ] ) ? $form_data['field'][ $registrant_name_field_id ] : [];
$registrant_name = 'N/A';
if ( is_array( $name_parts ) && ! empty( $name_parts['first'] ) && ! empty( $name_parts['last'] ) ) {
	$registrant_name = trim( $name_parts['first'] . ' ' . $name_parts['last'] );
}

// Handle Add-ons (which can be an array)
$add_ons_data = ! empty( $form_data['field'][ $add_ons_field_id ] ) ? $form_data['field'][ $add_ons_field_id ] : [];
$add_ons      = 'None';
if ( is_array( $add_ons_data ) && ! empty( $add_ons_data ) ) {
	$add_ons = implode( ', ', array_filter( $add_ons_data ) );
} elseif ( ! is_array( $add_ons_data ) && ! empty( $add_ons_data ) ) {
	$add_ons = $add_ons_data;
}


// Construct the URL for the QR code (links to the entry view in wp-admin)
$entry_url = get_site_url() . '/wp-admin/admin.php?page=gf_entries&view=entry&id=' . $form['id'] . '&lid=' . $entry['id'];

// Get the logo path from the settings and construct a full, secure URL
$logo_path = ! empty( $settings['company_logo'] ) ? $settings['company_logo'] : '';
$logo_url  = '';
if ( $logo_path ) {
	/*
	 * We need to get the base URL of the uploads directory and append the file name.
	 * This is a more secure way to build the URL than using a hardcoded path.
	 */
	$upload_dir = wp_get_upload_dir();
	if ( 0 === strpos( $logo_path, $upload_dir['basedir'] ) ) {
		$logo_url = str_replace( $upload_dir['basedir'], $upload_dir['baseurl'], $logo_path );
	} else {
		/* Fallback for cases where the path is not in the uploads directory */
		$logo_url = $logo_path;
	}
}
?>

<style>
    .ticket-container {
        font-family: sans-serif;
        border: 1px solid #ccc;
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
    }
    .header {
        text-align: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        padding-bottom: 20px;
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
        margin-top: 0;
        margin-bottom: 20px;
        color: #333;
    }
    .content table {
        width: 100%;
        border-collapse: collapse;
    }
    .content th, .content td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }
    .content th {
        font-weight: bold;
        width: 150px;
        color: #555;
    }
    .qr-code {
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="ticket-container">
    <div class="header">
        <?php if ( $logo_url ) : ?>
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="Company Logo" />
        <?php endif; ?>
    </div>

    <div class="content">
        <h1>Event Ticket</h1>
        <table>
            <tr>
                <th>Event Name</th>
                <td><?php echo esc_html( $event_name ); ?></td>
            </tr>
            <tr>
                <th>Registrant Name</th>
                <td><?php echo esc_html( $registrant_name ); ?></td>
            </tr>
             <tr>
                <th>Email</th>
                <td><?php echo esc_html( $registrant_email ); ?></td>
            </tr>
             <tr>
                <th>Phone</th>
                <td><?php echo esc_html( $registrant_phone ); ?></td>
            </tr>
            <tr>
                <th>Number of Attendees</th>
                <td><?php echo esc_html( $num_attendees ); ?></td>
            </tr>
            <tr>
                <th>Add-ons</th>
                <td><?php echo esc_html( $add_ons ); ?></td>
            </tr>
             <tr>
                <th>Total Cost</th>
                <td><?php echo esc_html( $total_cost ); ?></td>
            </tr>
        </table>
    </div>

    <div class="qr-code">
        <barcode code="<?php echo esc_attr( $entry_url ); ?>" type="QR" size="1.5" error="M" disableborder="1" />
        <p>Scan here for details</p>
    </div>
</div>
