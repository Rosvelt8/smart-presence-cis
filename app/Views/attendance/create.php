<div class="card shadow-sm">
    <div class="card-body">
        <h2 class="h4 mb-4">Enregistrer une présence</h2>
        <form method="post" action="<?= rtrim($config['base_url'] ?? '', '/') ?>/attendances/store" class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Session</label>
                <select class="form-select" name="session_id" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($sessions ?? [] as $session): ?>
                        <option value="<?= (int) $session['id_session'] ?>">
                            <?= htmlspecialchars($session['date_cours']) ?> · <?= htmlspecialchars($session['cours']) ?> (<?= htmlspecialchars($session['classe']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Étudiant</label>
                <select class="form-select" name="student_id" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($students ?? [] as $student): ?>
                        <option value="<?= (int) $student['id_user'] ?>">
                            <?= htmlspecialchars($student['prenom'] ?? '') ?> <?= htmlspecialchars($student['nom'] ?? '') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Statut</label>
                <select class="form-select" name="status" required>
                    <option value="P">Présent</option>
                    <option value="A">Absent</option>
                    <option value="R">Retard</option>
                    <option value="J">Justifié</option>
                </select>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
