<div class="privilege">
   <div class="container-fluid">
       <div class="breadcrumb">
           <?= $bread_crumb?>
       </div>
        <a href="/privilege/add" class="privilege-add-btn"><?= $privilege_add?> <i class="fa fa-plus"></i></a>
        <?php 
           // Get Message From Messenger Module
           if( $msgs = $this->messenger->getMessage() ) {
                foreach( $msgs as $msg ) {
                    echo "<p class='message t".$msg[1]."'>".$msg[0]."</p>";
                }
           }
        
        ?> 
       <div class="table-container">
            <table class="table-privilege"> 
                <thead>
                    <tr>
                        <th class="text-align-right"><?= $table_privilege_name ?></th>
                        <th class="text-align-right"><?= $table_privilege_control?></th>
 
                    </tr>
                </thead>
                <tbody>
                <?php
                if( !empty( $privileges ) ):
                foreach( $privileges as $privilege ): 
                ?>
                    <tr>
                        <td> <?= $privilege->privilege_name ?></td>
                        <td>
                            <a href="/privilege/edit/<?= $privilege->privilege_id ?>"><i class="edit fa fa-edit"></i></a>
                            <a href="/privilege/delete/<?= $privilege->privilege_id ?>"><i class="delete fa fa-trash"></i></a></td>
                    </tr>   
                <?php
                endforeach;    
                else:
                ?>
                    <tr>
                        <td colspan="3">لا توجد صلاحيت لعرضها</td>
                    </tr>
                <?php
                endif;
                ?>
                </tbody>
            </table>
       </div>
   </div>   
</div>