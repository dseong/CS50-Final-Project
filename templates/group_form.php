<form action="creat_group.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autofocus class="form-control" name="username" placeholder = "Group name"  type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="name" value= "<?php echo $name; ?>" type="text"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="email" value= "<?php echo $email; ?>" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Modify Information</button>
        </div>
    </fieldset>
</form>
