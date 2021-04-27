
<div class="users">
    <div class="cotainer-fluid">
        <div class="breadcrumb">
            <?= $bread_crumb?>
        </div>
        <a href="/users/add" class="users-add-btn"><?= $users_add?> <i class="fa fa-plus"></i></a>
        <div class="users-table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th><?= $table_users_username?></th>
                        <th><?= $table_users_email ?></th>
                        <th><?= $table_users_phone ?></th>
                        <th><?= $table_users_register_data?></th>
                        <th><?= $table_users_groupname?></th>
                        <th><?= $table_users_controll?> </th>
                    </tr>
                </thead>
                <tbody>
            <?php 
                if( !empty( $users ) ){
                    foreach( $users as $user ) {
            ?>
                    <tr>
                        <td><?= $user->username?></td>
                        <td><?= $user->email?></td>
                        <td><?= $user->phone?></td>
                        <td><?= $user->register_data?></td>
                        <td><?= $user->group_name?></td>
                        <td>
                        <a href="/users/edit/<?= $user->UserId ?>" class="edit"><i class="fa fa-edit fa-lg"></i></a>
                        <a href="#" class="delete" onclick = "return confirm('هل انت متاكد من انك تود حذف ذلك المستخدم')"><i class="fa fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
            <?php 
                }
            ?>  
            
            <?php
                } else {
             ?>       
                    <tr>
                        <td>لا يوجد مستخدمين</td>
                    </tr>
             <?php 
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>