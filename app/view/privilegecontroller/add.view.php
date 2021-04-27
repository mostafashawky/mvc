<div class="privilege-add">
    <div class="container-fluid">
        <div class="breadcrumb"><?= $bread_crumb?></div>
        <div class="privilege-add-form">
            <form method="post" class="form-privilege-add">
                <div class="form-group">
                    <input class="input-form-line" name="privilege_name" autocomplete="off" placeholder="<?= $privilege_label_name?>"  required> 
                </div>
                <div class="form-group">     
                    <input class="input-form-line" name="privilege_url"  placeholder ="<?= $privilege_label_url ?>"   required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn-submit" value="<?= $privilege_add_button ?>">
                </div>
            </form>
            <div class="form-description">
                <div class="description">
                    <div class="heading"><?= $privilege_add_title ?></div>
                     <p class="description-paragraph"><?= $privilege_description ?></p>
                </div>
            </div>
        </div>
    </div>
</div>