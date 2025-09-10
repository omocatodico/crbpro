<?php


echo $this->session->flashdata('saved');
/*
// Redirect solo se l'URL è esattamente http://172.21.0.43:8361/index.php/
if (
    (isset($_SERVER['HTTP_HOST']) && isset($_SERVER['REQUEST_URI'])) &&
    ($_SERVER['HTTP_HOST'] === '172.21.0.43:8361') &&
    ($_SERVER['REQUEST_URI'] === '/index.php/')
) {
    header('Location: http://172.21.0.43:8361/index.php/bookings');
    exit;
}
*/

print($_SERVER['REQUEST_URI']);
print(($_POST['scheda']));
$utente_loggato = $this->userauth->user->username; 

// Redirect in base al valore di $utente_loggato
if ($utente_loggato === 'tv1') {
    header('Location: http://prenota.tambosi.asetti.co:8361/index.php/bookings?room_group=7');
    exit;
} elseif ($utente_loggato === 'tv2') {
    header('Location: http://prenota.tambosi.asetti.co:8361/index.php/bookings?room_group=2');
    exit;
} elseif ($utente_loggato === 'tv3') {
    header('Location: http://prenota.tambosi.asetti.co:8361/index.php/bookings?room_group=5');
    exit;
} elseif ($utente_loggato === 'tv4') {
    header('Location: http://prenota.tambosi.asetti.co:8361/index.php/bookings?room_group=6');
    exit;
}

echo '<h2>Dashboard</h2>';

echo '<h5 style="margin:14px 0px">';
$img = img(base_url('assets/images/ui/school_manage_bookings.png'), FALSE, 'hspace="4" align="top" width="16" height="16"');
echo anchor('bookings', "{$img} Prenotazioni");
echo '</h5>';

echo '<br><br>';

$this->load->view('dashboard/stats');

?>

<div class="block-group has-spacing">

	<?php $this->load->view('dashboard/user_bookings') ?>
	<?php $this->load->view('dashboard/room_bookings') ?>

</div>
