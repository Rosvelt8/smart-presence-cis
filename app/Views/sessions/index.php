<?php 
$base = rtrim($config['base_url'] ?? '', '/');
$eventsJson = json_encode($events, JSON_THROW_ON_ERROR);
?>
<div class="d-flex flex-wrap justify-content-between gap-3 align-items-center mb-4">
    <div>
        <h1 class="h4 mb-1">Planification des sessions</h1>
        <p class="text-muted mb-0">Visualisez les cours planifiés par classe sur la semaine.</p>
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-outline-secondary" href="<?= $base ?>/sessions?class_id=<?= $selectedClass ?>&start=<?= date('Y-m-d', strtotime($start . ' -7 days')) ?>&end=<?= date('Y-m-d', strtotime($end . ' -7 days')) ?>">Semaine -</a>
        <a class="btn btn-outline-secondary" href="<?= $base ?>/sessions?class_id=<?= $selectedClass ?>&start=<?= date('Y-m-d', strtotime($start . ' +7 days')) ?>&end=<?= date('Y-m-d', strtotime($end . ' +7 days')) ?>">Semaine +</a>
        <a class="btn btn-primary" href="<?= $base ?>/sessions/create">Planifier une session</a>
    </div>
</div>

<form class="row g-3 mb-4" method="get" action="<?= $base ?>/sessions">
    <div class="col-md-4">
        <label class="form-label">Classe</label>
        <select name="class_id" class="form-select" onchange="this.form.submit()">
            <?php foreach ($classes as $classe): ?>
                <option value="<?= (int) $classe['id_class'] ?>" <?= $selectedClass == $classe['id_class'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($classe['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Début</label>
        <input type="date" class="form-control" name="start" value="<?= htmlspecialchars($start) ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label">Fin</label>
        <div class="d-flex gap-2">
            <input type="date" class="form-control" name="end" value="<?= htmlspecialchars($end) ?>">
            <button class="btn btn-outline-primary" type="submit">Filtrer</button>
        </div>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <div id="calendar"></div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        locale: 'fr',
        slotMinTime: '07:00:00',
        slotMaxTime: '21:00:00',
        height: 'auto',
        headerToolbar: {
            left: 'title',
            center: '',
            right: 'timeGridWeek,dayGridMonth,listWeek'
        },
        events: <?= $eventsJson ?>,
        eventDidMount(info) {
            if (info.event.extendedProps.annule) {
                info.el.classList.add('bg-danger', 'text-white');
            }
        }
    });

    calendar.render();
});
</script>
