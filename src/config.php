<?php
function getDB() {
    $dbPath = __DIR__ . '/../db/tasks.sqlite';
    $db = new PDO('sqlite:' . $dbPath);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar tabela se não existir
    $db->exec("CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        category TEXT,
        priority TEXT CHECK(priority IN ('low', 'medium', 'high')),
        status TEXT CHECK(status IN ('open', 'in_progress', 'done')),
        responsible TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    return $db;
}
