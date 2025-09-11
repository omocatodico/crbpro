<?php
// events_today.php
// View personalizzata per mostrare tutti gli eventi della giornata odierna
?>
<div style="position: relative; width: 1920px; height: 150px; margin: 0 auto 24px auto; font-family: 'Segoe UI', Arial, Verdana, Helvetica, sans-serif;">
    <img src="http://prenota.tambosi.asetti.co:8361/uploads/6e412f6251a8ca411de252feadeafe66.png" alt="Logo" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 20vh; max-width: 220px; height: auto; object-fit: contain;">
    <span style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); font-size: 4em; font-weight: bold; color: #9b2423; letter-spacing: 2px; font-family: 'Segoe UI', Arial, Verdana, Helvetica, sans-serif; text-transform: uppercase; text-align: center; width: 1000px;">EVENTI DEL GIORNO</span>
</div>
<style>
body, html {
    height: 1080px;
    min-height: 1080px;
    max-height: 1080px;
    overflow-y: auto;
}
.event-logo-responsive {
    width: 20vh;
    max-width: 220px;
    height: auto;
    margin-right: 32px;
    object-fit: contain;
    float: left;
}
.table.event-table, .table.event-table th, .table.event-table td {
    font-family: 'Segoe UI', Arial, Verdana, Helvetica, sans-serif;
    text-transform: uppercase;
}
#tabdue {
    height: 540px;
    min-height: 540px;
    max-height: 540px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    margin-top: 40px;
    overflow-y: auto;
}
@media (max-width: 1200px) {
    .event-logo-responsive {
        width: 12vh;
        max-width: 120px;
        margin-right: 16px;
    }
    #tabdue {
        min-height: 40vh;
    }
}
</style>
<?php
// Raggruppa eventi per utente e descrizione
$grouped = [];
foreach ($events_today as $event) {
    if (strpos(strtolower($event['description']), '@nocal') !== false) continue;
    $key = $event['user__displayname'] . '|' . $event['description'];
    if (!isset($grouped[$key])) {
        $grouped[$key] = [
            'room' => $event['room'],
            'user__displayname' => $event['user__displayname'],
            'description' => $event['description'],
            'start_time' => $event['start_time'],
            'end_time' => $event['end_time'],
        ];
    } else {
        // Aggiorna orario di inizio e fine
        if ($event['start_time'] < $grouped[$key]['start_time']) {
            $grouped[$key]['start_time'] = $event['start_time'];
        }
        if ($event['end_time'] > $grouped[$key]['end_time']) {
            $grouped[$key]['end_time'] = $event['end_time'];
        }
    }
}
?>
<style>
.event-table-container {
    width: 100%;
    overflow-x: auto;
    margin-top: 20px;
}
.table.event-table {
    font-size: 2.2em;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    width: 100%;
    min-width: 900px;
}
.table.event-table th {
    background: #9b2423;
    color: #fff;
    font-weight: bold;
    text-align: center;
    padding: 18px;
}
.table.event-table td {
    padding: 16px 12px;
    text-align: center;
    vertical-align: middle;
}
.table.event-table tr:nth-child(even) {
    background: #f2f6fc;
}
.table.event-table tr:nth-child(odd) {
    background: #f7e3e2;
}
@media (max-width: 1200px) {
    .table.event-table {
        font-size: 1.2em;
        min-width: 600px;
    }
}
@media (max-width: 800px) {
    .table.event-table {
        font-size: 1em;
        min-width: 400px;
    }
}
</style>
<div class="event-table-container">
<table class="table event-table">
    <thead>
        <tr>
            <th>Orario</th>
            <th>Aula</th>
            <th>Prenotazione di</th>
            <th>Descrizione</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($grouped)): ?>
            <?php foreach ($grouped as $event): ?>
                <tr>
                    <td><?php 
                        $start = date('H:i', strtotime($event['start_time']));
                        $end = date('H:i', strtotime($event['end_time']));
                        echo htmlspecialchars($start . ' - ' . $end);
                    ?></td>
                    <td><?= htmlspecialchars($event['room']) ?></td>
                    <td><?= htmlspecialchars($event['user__displayname']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Nessun evento per oggi.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
<div id="tabdue">
<div style="width: 100%; height: 60px; display: table; margin-bottom: 0px; font-family: 'Segoe UI', Arial, Verdana, Helvetica, sans-serif;margin-bottom: 20px;">
    <div style="display: table-cell; vertical-align: middle; text-align: center;">
        <span style="font-size: 4em; font-weight: bold; color: #9b2423; letter-spacing: 2px; font-family: 'Segoe UI', Arial, Verdana, Helvetica, sans-serif; text-transform: uppercase; vertical-align: middle;">EVENTI DEI PROSSIMI GIORNI</span>
    </div>
</div>
<div class="event-table-container" style="margin-top: 20px;">
<?php
// Raggruppa eventi per utente e descrizione per i giorni successivi
$grouped_next = [];
if (isset($events_next_days) && is_array($events_next_days)) {
    foreach ($events_next_days as $event) {
        if (strpos(strtolower($event['description']), '@nocal') !== false) continue;
        $key = $event['user__displayname'] . '|' . $event['description'] . '|' . $event['date'];
        if (!isset($grouped_next[$key])) {
            $grouped_next[$key] = [
                'date' => $event['date'],
                'room' => $event['room'],
                'user__displayname' => $event['user__displayname'],
                'description' => $event['description'],
                'start_time' => $event['start_time'],
                'end_time' => $event['end_time'],
            ];
        } else {
            if ($event['start_time'] < $grouped_next[$key]['start_time']) {
                $grouped_next[$key]['start_time'] = $event['start_time'];
            }
            if ($event['end_time'] > $grouped_next[$key]['end_time']) {
                $grouped_next[$key]['end_time'] = $event['end_time'];
            }
        }
    }
}
?>
<table class="table event-table">
    <thead>
        <tr>
            <th>Data</th>
            <th>Orario</th>
            <th>Aula</th>
            <th>Prenotazione di</th>
            <th>Descrizione</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($grouped_next)): ?>
            <?php foreach ($grouped_next as $event): ?>
                <tr>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($event['date']))) ?></td>
                    <td><?php 
                        $start = date('H:i', strtotime($event['start_time']));
                        $end = date('H:i', strtotime($event['end_time']));
                        echo htmlspecialchars($start . ' - ' . $end);
                    ?></td>
                    <td><?= htmlspecialchars($event['room']) ?></td>
                    <td><?= htmlspecialchars($event['user__displayname']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">Nessun evento nei prossimi giorni.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
</div>