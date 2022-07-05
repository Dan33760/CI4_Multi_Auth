<!-- Limit to 3 Links each side of the current page -->
<?php $pager->setSurroundCount(3)  ?>
<!-- END-->
 
<div class="row">
 
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
     <ul class="pagination">
            <!-- page precedente et premiere -->
            <?php if($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a href="<?= $pager->getFirst() ?>" class="page-link">Premier</a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getPrevious() ?>" class="page-link">Precedent</a>
                </li>
            <?php endif; ?>
 
            <!-- Lien des pages -->
            <?php foreach($pager->links() as $link): ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
            <?php endforeach; ?>
 
            <!-- Lien pour Page Suivante et derniere  -->
            <?php if($pager->hasNext()): ?>
                <li class="page-item">
                    <a href="<?= $pager->getNext() ?>" class="page-link">Suivant</a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getLast() ?>" class="page-link">Dernier</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
     
</div>