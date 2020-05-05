<div class="login-container">
    <form method="post">
        <div class="row card-panel">
            <div class="input-field col s12">
                <input type="text" name="firstname" id="register_firstname" value="<?= $this['user']->getFirstName() ?>"/>
                <label for="register_firstname">Firstname</label>
            </div>
            <div class="input-field col s12">
                <input type="text" name="lastname" id="register_lastname" value="<?= $this['user']->getLastName() ?>"/>
                <label for="register_lastname">Lastname</label>
            </div>
            <div class="col s12">
                <label for="register_gender">Gender</label>
                <select name="gender" id="register_gender" class="browser-default">
                    <option value="" disabled <?= $this['user']->getGender() == null ? 'selected' : null ?>>Choose your option</option>
                    <option value="boys" <?= $this['user']->getGender() == 'boys' ? 'selected' : null ?>>Man</option>
                    <option value="girls" <?= $this['user']->getGender() == 'girls' ? 'selected' : null ?>>Woman</option>
                </select>
            </div>
            <div class="input-field col s12">
                <input type="text" name="email" id="register_email" value="<?= $this['user']->getEmail() ?>"/>
                <label for="register_email">E-mail</label>
                <?php if (isset($this['errors']['email'])): ?>
                    <span class="helper-text red-text" data-error="wrong" data-success="right">Email is not valid.</span>
                <?php endif ?>
                <?php if (isset($this['errors']['email_exists'])): ?>
                    <span class="helper-text red-text" data-error="wrong" data-success="right">Email is already registered.</span>
                <?php endif ?>
            </div>
            <div class="input-field col s12">
                <input type="password" name="password" id="register_password" autocomplete="off"/>
                <label for="register_password">Password</label>
                <?php if (isset($this['errors']['password'])): ?>
                    <span class="helper-text red-text" data-error="wrong" data-success="right">Password must be of minimum 6 characters length.</span>
                <?php endif ?>
            </div>
            <div class="row center">
                <button type="submit" class="waves-green btn">register</button>
            </div>
        </div>
    </form>
</div>