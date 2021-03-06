<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
$headerLinks = [
    [
        'title' => __('New Message'),
        'link' => [
            'controller' => 'messages',
            'action' => 'add'
        ],
        'icon' => 'fa-plus',
        'btn-class' => 'btn-success'
    ]
];
$this->assign('header_title_top', 'Messages');
$this->assign('header_links', serialize($headerLinks));
?>
<div class="messages index content col-sm-10 offset-sm-1 card p-3 mb-4">
    <?php if(count($messages) > 0): ?>
        <div class="table-responsive">
            <table class="table no-border-top">
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('from_user', __('From')) ?></th>
                        <th><?= $this->Paginator->sort('seen') ?></th>
                        <th><?= $this->Paginator->sort('created', __('Received')) ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td><?= (isset($message->from_user->profile->name)) ? $this->Html->link($message->from_user->profile->name, ['controller' => 'users', 'action' => 'view', $message->from_user->id]) : '<i>' . __('unknown') . '</i>'; ?></td>
                            <td><?= ($message->seen) ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' ?></td>
                            <td><?= $this->Time->format($message->created, "dd.MM.YYYY HH:mm") ?></td>
                            <td class="actions">
                                <?= $this->Html->link('<i class="far fa-fw fa-eye"></i>', ['action' => 'view', $message->id], ['escape' => false, 'class' => 'btn btn-sm btn-primary', 'data-tooltip' => '', 'title' => __('View')]) ?>
                                <?= $this->Form->postLink('<i class="far fa-fw fa-trash-alt"></i>', ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id), 'escape' => false, 'class' => 'btn btn-sm btn-danger', 'data-tooltip' => '', 'title' => __('Delete')]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center">
            <?= __('No messages available.') ?>
        </p>
    <?php endif; ?>
</div>

<?php if(count($messages) > 0): ?>
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('«') ?>
            <?= $this->Paginator->prev('‹') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('›') ?>
            <?= $this->Paginator->last('»') ?>
        </ul>
        <p class="text-center"><small><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></small></p>
    </nav>
<?php endif; ?>