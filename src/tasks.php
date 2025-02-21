<?php
require_once 'config.php';
require_once 'utils.php';

function createTask($title, $description, $category, $priority, $responsible) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO tasks (title, description, category, priority, status, responsible) 
                          VALUES (:title, :description, :category, :priority, 'open', :responsible)");
    return $stmt->execute([
        'title' => sanitize($title),
        'description' => sanitize($description),
        'category' => sanitize($category),
        'priority' => $priority,
        'responsible' => sanitize($responsible)
    ]);
}

function getTasks($filters = []) {
    $db = getDB();
    $query = "SELECT * FROM tasks WHERE 1=1";
    $params = [];

    if (!empty($filters['category'])) {
        $query .= " AND category = :category";
        $params['category'] = $filters['category'];
    }
    if (!empty($filters['priority'])) {
        $query .= " AND priority = :priority";
        $params['priority'] = $filters['priority'];
    }
    if (!empty($filters['status'])) {
        $query .= " AND status = :status";
        $params['status'] = $filters['status'];
    }
    if (!empty($filters['search'])) {
        $query .= " AND (title LIKE :search OR description LIKE :search)";
        $params['search'] = '%' . $filters['search'] . '%';
    }

    $query .= " ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateTask($id, $title, $description, $category, $priority, $status, $responsible) {
    $db = getDB();
    $stmt = $db->prepare("UPDATE tasks SET title = :title, description = :description, category = :category, 
                          priority = :priority, status = :status, responsible = :responsible 
                          WHERE id = :id");
    return $stmt->execute([
        'id' => $id,
        'title' => sanitize($title),
        'description' => sanitize($description),
        'category' => sanitize($category),
        'priority' => $priority,
        'status' => $status,
        'responsible' => sanitize($responsible)
    ]);
}

function deleteTask($id) {
    $db = getDB();
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}

function exportTasksToCSV() {
    $tasks = getTasks();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="tasks_export_' . date('Y-m-d') . '.csv"');
    
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Título', 'Descrição', 'Categoria', 'Prioridade', 'Status', 'Responsável', 'Criado em']);
    
    foreach ($tasks as $task) {
        fputcsv($output, [
            $task['id'], $task['title'], $task['description'], $task['category'],
            $task['priority'], $task['status'], $task['responsible'], $task['created_at']
        ]);
    }
    fclose($output);
    exit;
}
