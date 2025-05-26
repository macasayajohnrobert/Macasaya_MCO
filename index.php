<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Task Manager</h2>

    <!-- Add Task Form -->
    <form action="add_task.php" method="POST" class="mb-4">
        <input type="text" name="title" placeholder="Task Title" required class="form-control mb-2">
        <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
        <input type="date" name="due_date" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Add Task</button>
    </form>

    <!-- Filter Controls -->
    <select id="statusFilter" class="form-select mb-3" onchange="filterTasks()">
        <option value="">All</option>
        <option value="pending">Pending</option>
        <option value="done">Done</option>
    </select>

    <!-- Task List -->
    <table class="table table-bordered" id="taskTable">
        <thead>
            <tr>
                <th>Title</th><th>Due Date</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM tasks ORDER BY due_date");
            while($row = $result->fetch_assoc()):
            ?>
            <tr data-status="<?= $row['status'] ?>">
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= $row['due_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
              <a href="mark_done.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Done</a>
                    <a href="delete_task.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

<script>
function filterTasks() {
    let status = document.getElementById('statusFilter').value;
    let rows = document.querySelectorAll('#taskTable tbody tr');
    rows.forEach(row => {
        if (!status || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
</script>
</body>
</html>
