<?php include 'header.php'; ?>
<h2><?= isset($taskId) ? 'Editar Tarefa' : 'Nova Tarefa' ?></h2>
<?php if (isset($taskId)): $task = getTasks(['id' => $taskId])[0]; endif; ?>
<form method="POST" action="/?action=<?= isset($taskId) ? 'edit&id=' . $taskId : 'create' ?>">
    <input type="text" name="title" value="<?= $task['title'] ?? '' ?>" placeholder="Título" required>
    <textarea name="description" placeholder="Descrição"><?= $task['description'] ?? '' ?></textarea>
    <input type="text" name="category" value="<?= $task['category'] ?? '' ?>" placeholder="Categoria">
    <select name="priority" required>
        <option value="low" <?= ($task['priority'] ?? '') === 'low' ? 'selected' : '' ?>>Baixa</option>
        <option value="medium" <?= ($task['priority'] ?? '') === 'medium' ? 'selected' : '' ?>>Média</option>
        <option value="high" <?= ($task['priority'] ?? '') === 'high' ? 'selected' : '' ?>>Alta</option>
    </select>
    <?php if (isset($taskId)): ?>
    <select name="status" required>
        <option value="open" <?= $task['status'] === 'open' ? 'selected' : '' ?>>Aberta</option>
        <option value="in_progress" <?= $task['status'] === 'in_progress' ? 'selected' : '' ?>>Em Progresso</option>
        <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Concluída</option>
    </select>
    <?php endif; ?>
    <input type="text" name="responsible" value="<?= $task['responsible'] ?? '' ?>" placeholder="Responsável (opcional)">
    <button type="submit">Salvar</button>
</form>
<?php include 'footer.php'; ?>
