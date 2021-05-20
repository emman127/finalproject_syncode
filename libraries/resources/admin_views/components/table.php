<?php 

    include_once "../database/config.php";
    include_once "../app/controllers/AdminController.php";

    $users = $admin->get_all_user();

    // print_r($users);

?>

<div class="container p-5">
    <table class="table table-hover table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Type</th>
                <th>Status</th>
                <th>Handle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['firstname'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['username'] ?></td>

                <!-- user -->
                <?php if($user['isType'] === '0'): ?>
                    <td>
                        <span class="badge bg-info">Normal User</span>
                    </td>
                    <?php if($user['isActive'] === '0'): ?>
                        <td>
                            <span class="badge bg-danger">Inactive</span>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="modify(<?php echo $user['id'] ?>)" data-bs-toggle="modal" data-bs-target="#myModal">Modify</button>
                            <button class="btn btn-danger btn-sm" onclick="askDelete(<?php echo $user['id'] ?>)">Remove</button>
                            <button class="btn btn-success btn-sm" onclick="toActivate(<?php echo $user['id'] ?>)">Activate</button>
                        </td>
                    <?php else: ?>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="modify(<?php echo $user['id'] ?>)" data-bs-toggle="modal" data-bs-target="#myModal">Modify</button>
                            <button class="btn btn-danger btn-sm" onclick="askDelete(<?php echo $user['id'] ?>)">Remove</button>
                            <button class="btn btn-danger btn-sm" onclick="toDeactivate(<?php echo $user['id'] ?>)">Deactivate</button>
                        </td>
                    <?php endif;?>
                <!-- admin -->
                <?php else: ?>
                    <td>
                        <span class="badge bg-success">Administrator</span>
                    </td>
                    <?php if($user['isActive'] === '0'): ?>
                        <td>
                            <span class="badge bg-danger">Inactive</span>
                        </td>
                    <?php else:?>
                        <td>
                            <span class="badge bg-success">Active</span>
                        </td>
                    <?php endif; ?>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="modify(<?php echo $user['id'] ?>)" data-bs-toggle="modal" data-bs-target="#myModal">Modify</button>
                    </td>
                <?php endif;?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('modal.php'); ?>