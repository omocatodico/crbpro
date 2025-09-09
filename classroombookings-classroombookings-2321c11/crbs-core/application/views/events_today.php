<?php
// events_today.php
// View personalizzata per mostrare tutti gli eventi della giornata odierna
?>
<h2>Eventi di oggi</h2>
<table class="table">
    <thead>
        <tr>
            <th>Nome evento</th>
            <th>Orario</th>
            <th>Aula</th>
            <th>Descrizione</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events_today)): ?>
            <?php foreach ($events_today as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['name']) ?></td>
                    <td><?= htmlspecialchars($event['start_time']) ?> - <?= htmlspecialchars($event['end_time']) ?></td>
                    <td><?= htmlspecialchars($event['room']) ?></td>
                    <td><?= htmlspecialchars($event['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Nessun evento per oggi.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
