<div class = "employees">
    <table class = employees-table>
        <?php
        if( !empty( $employeesKey) ){
        ?>
            <tr>
                <th><?= $table_employee_name ?></th>
                <th><?= $table_employee_email ?></th>
                <th><?= $table_employee_fullname ?></th>
                <th><?= $table_employee_salary ?></th>
                <th><?= $table_employee_control ?></th>
            </tr>
        <?php
            foreach( $employeesKey as $emp ){
                ?>
                <tr>
                    <td><?php echo $emp->username ?></td>
                    <td><?php echo $emp->email ?></td>
                    <td><?php echo $emp->fullname?></td>
                    <td><?php echo $emp->salary ?></td>
                    <td>
                        <a href="/employee/edit/<?php echo $emp->id ?>" class="btn btn-edit"><i class="fa fa-edit fa-lg fa-fw"></i></a>
                        <a href="/employee/delete/<?php echo $emp->id ?>" class="btn btn-delete" onclick = "return confirm('Are you Sure You Want Delete This Employee!!')"><i class="fa fa-close fa-lg fa-fw"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

    </table>
    <a href="/employee/add" class="btn-add">اضافه موظف جديد</a>
</div>
