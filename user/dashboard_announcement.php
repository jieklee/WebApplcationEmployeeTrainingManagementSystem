<?php $announcement_list = $User->get_announcement_list(); ?>

<div class="col-lg-12">
    <?php
        if(!empty($announcement_list)){
            foreach($announcement_list as $key => $value):
    ?>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#<?= $value['Announcement_ID']; ?>">
                                <h4 class="panel-title"><?= $value['title']; ?> <small class="text">Posted on: <?= $value['created_on']; ?></small></h4>
                                
                            </a>
                        </div>
                        <div id="<?= $value['Announcement_ID']; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p class="help-block"><?= $value['description']; ?></p>

                                <?php if(!empty($value['assignment'])): ?>
                                    File: <a href="<?= $value['assignment_path']; ?>" download><?= $value['assignment']; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
    <?php 
            endforeach;
        }else{
            echo "Currently No Announcement";
        }
    ?>
</div>