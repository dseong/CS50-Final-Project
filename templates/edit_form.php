<form action="edit_profile.php" method="post">
    <fieldset>
        Username
        <div class="form-group">
            <input autofocus class="form-control" name="username" value= "<?php echo $username; ?>"  type="text"/>
        </div>
        First name
        <div class="form-group">
            <input class="form-control" name="name" value= "<?php echo $name; ?>" type="text"/>
        </div>
        Email
        <div class="form-group">
            <input class="form-control" name="email" value= "<?php echo $email; ?>" type="text"/>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-default">Modify Information</button>
        </div>
    </fieldset>
</form>
