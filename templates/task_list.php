<?php include 'header.php'; ?>
<section class="filters">
    <input type="text" id="search" placeholder="Pesquisar tarefas..." onkeyup="filterTasks()">
    <select id="categoryFilter" onchange="filterTasks()">
        <option value="">Categoria</option>
        <option value="Trabalho">Trabalho</option>
        <option value="Pessoal">Pessoal</option>
        <option value="Outros">Outros</option>
    </select>
    <select id="priorityFilter" onchange="filterTasks()">
        <option value="">Prioridade</option>
        <option value="low">Baixa</option>
        <option value="medium">Média</option>
        <option value="high">Alta</option>
    </select>
    <select id="statusFilter" onchange="filterTasks()">
        <option value="">Status</option>
        <option value="open">Aberta</option>
        <option value="in_progress">Em Progresso</option>
        <option value="done">Concluída</option>
    </select>
</section>
<table id="taskTable">
    <thead>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Prioridade</th>
            <th>Status</th>
            <th>Responsável</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach (getTasks() as $task): ?>
        <tr>
            <td><?= $task['title'] ?></td>
            <td><?= $task['description'] ?></td>
            <td><?= $task['category'] ?></td>
            <td class="priority-<?= $task['priority'] ?>"><?= $task['priority'] ?></td>
            <td><?= $task['status'] ?></td>
            <td><?= $task['responsible'] ?: 'Ninguém' ?></td>
            <td><?= date('d/m/Y H:i', strtotime($task['created_at'])) ?></td>
            <td>
                <a href="/?action=edit&id=<?= $task['id'] ?>">Editar</a>
                <a href="/?action=delete&id=<?= $task['id'] ?>" onclick="return confirm('Excluir tarefa?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'footer.php'; ?>
