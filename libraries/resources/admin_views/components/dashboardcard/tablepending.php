<?php

    $pending = $dashboard->pending_table();

    // print_r($pending);

?>

<div class="container p-4">
    <table class="table table-hover table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Firstname</th>
                <th>lastname</th>
                <th>Username</th>
                <th>Created At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pending as $user): ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['firstname'] ?></td>
                    <td><?php echo $user['lastname'] ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['create_time'] ?></td>
                    <td>
                        <span class="badge bg-danger">Pending</span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>