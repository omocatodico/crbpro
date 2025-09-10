<?php

if ($booking->user_id && $current_user->user_id != $booking->user_id) {
	echo msgbox('exclamation', 'Questo non e tuo.');
	echo "<br>";
}


$cls = '';

if ($booking->repeat_id) {

	$heading = '<strong>Cancella prenotazione ricorrente:</strong><br><br>';

	$cls = 'is-repeat';

	$buttons = [];

	$buttons[] = form_button([
		'type' => 'submit',
		'name' => 'cancel',
		'value' => '1',
		'content' => 'Solo questa prenotazione',
	]);

	$buttons[] = form_button([
		'type' => 'submit',
		'name' => 'cancel',
		'value' => 'future',
		'content' => 'Questa e le prossime prenotazioni di questa serie',
	]);

	$buttons[] = form_button([
		'type' => 'submit',
		'name' => 'cancel',
		'value' => 'all',
		'content' => 'Tutte le prenotazioni di questa serie',
	]);

	$cancel = "<a href='#' up-dismiss>No, mantieni</a>";

	$content = implode("\n", $buttons) . $cancel;

} else {

	$heading = '<strong>Cancellare questa prenotazione?</strong><br><br>';

	$submit = form_button([
		'type' => 'submit',
		'name' => 'cancel',
		'value' => '1',
		'content' => 'si, cancella prenotazione',
		'autofocus' => true,
	]);

	$cancel = "<a href='#' up-dismiss>No, mantienila</a>";

	$content = "{$submit} &nbsp; {$cancel}";
}


$uri = sprintf('bookings/cancel/%d?%s', $booking->booking_id, http_build_query(['params' => $params]));
echo form_open($uri, ['class' => 'booking-choices']);
echo $heading;
echo "<div class='submit' style='border-top:0px;'>{$content}</div>";
echo form_close();
