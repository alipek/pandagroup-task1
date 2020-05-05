<form
    method="post"
    action="<?= $this['form_action'] ?>"
    class="col s12">
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="name" id="news_name" value="<?= $this['news']->getName() ?>"/>
            <label for="news_name">Name</label>
        </div>
        <div class="input-field col s1">
            <label>Is Active</label>
        </div>
        <div class="input-field col s5">
            <p>
                <label for="news_is_active_yes">
                    <input name="is_active" type="radio" value="1" id="news_is_active_yes" <?= $this['news']->isIsActive() ?  'checked' : null ?>>
                    <span>yes</span>
                </label>
            </p>

            <p>
                <label for="news_is_active_no">
                    <input name="is_active" type="radio" value="0" id="news_is_active_no" <?= $this['news']->isIsActive() ?   null : 'checked' ?>>
                    <span>no</span>
                </label>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <textarea name="description" id="news_description" class="materialize-textarea"><?= $this['news']->getDescription() ?></textarea>
            <label for="news_description">Description</label>
        </div>
    </div>
    <button type="submit" class="waves-effect waves-light btn">Send</button>
    <button type="reset" class="waves-effect waves-light btn">Reset</button>
</form>
