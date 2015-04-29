<!-- Call to Action Panel -->


<div class="loginMain">
    <h2>Login</h2>
    <div>
        <p id="error">
            <?php echo $TPL['errMsg']; ?>
        </p>
        <form action="main.php?c=login&m=login" method="post"   >
            <fieldset>
                <!--<label>User name</label>-->
                <input required type="text" name="username"  size="40" value="<?=$_POST['username']?>"/>
                <!-- <label>Password</label>-->
                <input required type="text" name="password" size="40" value="<?=$_POST['password']?>"/>
                <input type="submit" class="btn" name="Submit" value="Login" />
            </fieldset>
        </form>
    </div>
</div>
