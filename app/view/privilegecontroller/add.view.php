<div class="privilege-add">
    <h4 class='title'>اضافه ترخيص جديد</h4>
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
</div>