<div class="group-default">
    <div class="container-fluid">
        <div class="breadcrumb"><?= $bread_crumb?></div>
        <a href="/group/add" class="group-add-btn"><?= $group_add ?> <i class="fa fa-plus"></i></a>
        <div class="table-group-container">
            <table class="table-group"> 
                <thead>
                    <tr>
                        <th class="text-align-right"><?= $table_group_name ?></th>
                        <th class="text-align-right"><?= $table_group_control ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if( !empty( $groups ) ):
                foreach( $groups as $group ): 
                ?>
                    <tr>
                        <td> <?= $group->group_name ?></td>
                        <td>
                            <a href="/group/edit/<?= $group->group_id ?>"><i class="edit fa fa-edit"></i></a>
                            <a href="/group/delete/<?= $group->group_id ?>"><i class="delete fa fa-trash"></i></a></td>
                    </tr>   
                <?php
                endforeach;    
                else:
                ?>
                    <tr>
                        <td colspan="3"><?= $table_group_notfound ?></td>
                    </tr>
                <?php
                endif;
                ?>
                </tbody>
            </table>
        </div> 
    </div>
</div>