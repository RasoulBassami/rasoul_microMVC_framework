<?php 
use App\Core\Application;
include_once 'header.php'; ?>

<?php if(Application::$app->session->getFlashMessage('success')): ?>
    <div class="alerst alert-success p-3 mb-2">
        <?= Application::$app->session->getFlashMessage('success'); ?>
    </div>
<?php endif; ?>

{{content}}

<?php include_once 'footer.php'; ?>