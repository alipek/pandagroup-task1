<div>
</div>
<div class="row">
    <h5>News</h5>
    <?php if ($this['request']->session->has('user')): ?>
        <a class="waves-effect waves-light btn right"
           href="<?= $this->router->generate(\Recruitment\Actions\News\Add::class) ?>">Add</a>
    <?php endif ?>
</div>
<div class="row card-panel">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Create date</th>
            <th>Last update</th>
            <?php if ($this['isAuth']): ?>
                <th>Edit</th>
            <?php endif ?>
        </tr>
        </thead>
        <tbody>
        <?php
        /** @var \Recruitment\Contract\News $msgNews */
        foreach ($this['news'] as $msgNews): ?>
            <tr>
                <td><?= $msgNews->getName() ?></td>
                <td><?= $msgNews->isIsActive() ? 'Yes' : 'No' ?></td>
                <td><?= $msgNews->getCreatedAt()->format('Y-m-d H:i:s') ?></td>
                <td><?= $msgNews->getUpdatedAt() !== null ? $msgNews->getUpdatedAt()->format('Y-m-d H:i:s') : '-' ?></td>
                <?php if ($this['isAuth']): ?>
                    <td>
                        <a href="<?= $this->router->generate(\Recruitment\Actions\News\Edit::class, ['id' => $msgNews->getId(),]) ?>"
                           class="btn waves-effect waves-light">
                            Edit
                        </a>
                        <a href="<?= $this->router->generate(\Recruitment\Actions\News\Remove::class, ['id' => $msgNews->getId(),]) ?>"
                           class="btn waves-effect waves-light red">
                            Remove
                        </a>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?></tbody>
    </table>
</div>
