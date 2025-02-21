function filterTasks() {
    const search = document.getElementById('search').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    const priority = document.getElementById('priorityFilter').value;
    const status = document.getElementById('statusFilter').value;
    
    const rows = document.querySelectorAll('#taskTable tbody tr');
    
    rows.forEach(row => {
        const title = row.cells[0].textContent.toLowerCase();
        const description = row.cells[1].textContent.toLowerCase();
        const rowCategory = row.cells[2].textContent;
        const rowPriority = row.cells[3].textContent;
        const rowStatus = row.cells[4].textContent;

        const matchesSearch = title.includes(search) || description.includes(search);
        const matchesCategory = !category || rowCategory === category;
        const matchesPriority = !priority || rowPriority === priority;
        const matchesStatus = !status || rowStatus === status;

        row.style.display = (matchesSearch && matchesCategory && matchesPriority && matchesStatus) ? '' : 'none';
    });
}
