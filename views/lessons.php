<?php

$requete = $bdd->query("SELECT * FROM lessons WHERE id_m = ".$_SESSION['id_u']);
$lessons = $requete->fetchAll();

$events = [];

foreach ($lessons as $lesson) {
    $events[] =  "{
		title: '".$lesson['titre']."',
		start: '".$lesson['date_debut']."',
		end: '".$lesson['date_fin']."'
    }";
}

$events = implode(",", $events);

?>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialDate: '2021-04-14',
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev, next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek'
        },
        height: 'auto',
        navLinks: true,
        editable: false,
        selectable: true,
        selectMirror: true,
        nowIndicator: true,
        events: [<?= $events; ?>]
    });
    calendar.render();
});
</script>

<main class="content d-flex p-0">
    <div class="container d-flex flex-column">
        <div class="row h-100">
            <div class="mt-4">
                <?= Alerts::getFlash(); ?>
            </div>
            <?php if (isset($_SESSION['id_u']) && $_SESSION['lvl'] == 2) { ?>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal"
                        data-bs-target="#modal-lessons">
                        Ajouter un cours
                    </button>
                </div>
            </div>
            <?php } ?>
            <div id="calendar"></div>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-lessons" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajouter un cours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <?= $helper->input('titre', 'Titre du cours', 'text'); ?>
                    <?= $helper->textarea('description', 'Description du cours'); ?>
                    <?= $helper->input('date_debut', 'Date de début', 'datetime-local'); ?>
                    <?= $helper->input('date_fin', 'Date de fin', 'datetime-local'); ?>
                    <div class="mb-3">
                        <label for="eleve" class="form-label">Élève</label>
                        <select name="id_e" id="eleve" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 1");
                            $lesEleves = $requete->fetchAll();
                            foreach ($lesEleves as $unEleve) { ?>
                            <option value="<?= $unEleve['id_u']; ?>"><?= $unEleve['prenom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="moniteur" class="form-label">Moniteur</label>
                        <select name="id_m" id="moniteur" class="form-select">
                            <?php $requete = $bdd->query("SELECT * FROM users WHERE lvl = 2");
                            $lesMoniteurs = $requete->fetchAll();
                            foreach ($lesMoniteurs as $unMoniteur) { ?>
                            <option value="<?= $unMoniteur['id_u']; ?>"><?= $unMoniteur['prenom']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" name="add-lessons" class="btn btn-primary btn-lg">Ajouter le
                            cours</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#calendar').fullCalendar({
        lang: 'es'
    });

});
</script>