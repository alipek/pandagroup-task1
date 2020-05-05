<div class="login-container">
    <form method="post">
        <div class="row card-panel">
            <div class="input-field col s12">
                <input type="text" name="email" id="login_email"/>
                <label for="login_email">E-mail</label>
                <?php if (isset($this['errors']['failed'])): ?>
                    <span class="helper-text red-text" data-error="wrong" data-success="right">Email or password id not valid.</span>
                <?php endif ?>
            </div>
            <div class="input-field col s12">
                <input type="password" name="password" id="login_password" autocomplete="off"/>
                <label for="login_password">Password</label>
            </div>
            <div class="row center">
                <button type="submit" class="waves-green btn">Login</button>
            </div>
        </div>
    </form>
</div>
