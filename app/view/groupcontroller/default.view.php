<div class="group-default">
    <a href="/group/add" class="privilege-add-btn">اضافه مجموعه <i class="fa fa-plus"></i></a>
    <table class="table-group"> 
        <thead>
            <tr>
                <th>اسم المجموعه</th>
                <th>الصلاحيات</th>
                <th>التحكم</th>

            </tr>
        </thead>
        <tbody>
        <?php
        if( !empty( $groups ) ):
        foreach( $groups as $group ): 
        ?>
            <tr>
                <td> <?= $group->group_name ?></td>
                <td> اضافه اعضاء,حذف اعضاء </td>
                <td>
                    <a href="/group/edit/<?= $group->group_id ?>"><i class="edit fa fa-edit"></i></a>
                    <a href="/group/delete/<?= $group->group_id ?>"><i class="delete fa fa-close"></i></a></td>
            </tr>   
        <?php
        endforeach;    
        else:
        ?>
            <tr>
                <td colspan="3">لا توجد تراخيص لعرضها</td>
            </tr>
        <?php
        endif;
        ?>
        </tbody>
    </table>
</div>