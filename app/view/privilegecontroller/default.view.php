<div class="privilege">
    <a href="/privilege/add" class="privilege-add-btn">اضافه ترخيص <i class="fa fa-plus"></i></a>
    <table class="table-privilege"> 
        <thead>
            <tr>
                <th>اسم الترخيص</th>
                <th>رابط الترخيص</th>
                <th>التحكم</th>

            </tr>
        </thead>
        <tbody>
        <?php
        if( !empty( $privileges ) ):
        foreach( $privileges as $privilege ): 
        ?>
            <tr>
                <td> <?= $privilege->privilege_name ?></td>
                <td> <?= $privilege->privilege_url ?> </td>
                <td>
                    <a href="/privilege/edit/<?= $privilege->privilege_id ?>"><i class="edit fa fa-edit"></i></a>
                    <a href="/privilege/delete/<?= $privilege->privilege_id ?>"><i class="delete fa fa-close"></i></a></td>
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