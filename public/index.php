<?php
require_once '../src/tasks.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            createTask(
                $_POST['title'],
                $_POST['description'],
                $_POST['category'],
                $_POST['priority'],
                $_POST['responsible']
            );
            redirect('/');
        }
        include '../templates/task_form.php';
        break;
    case 'edit':
        $taskId = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            updateTask(
                $taskId,
                $_POST['title'],
                $_POST['description'],
                $_POST['category'],
                $_POST['priority'],
                $_POST['status'],
                $_POST['responsible']
            );
            redirect('/');
        }
        include '../templates/task_form.php';
        break;
    case 'delete':
        deleteTask($_GET['id']);
        redirect('/');
        break;
    case 'export':
        exportTasksToCSV();
        break;
    default:
        include '../templates/task_list.php';
        break;
}
