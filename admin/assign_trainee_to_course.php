<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form role="form" method="post">
                    <?php
                        $training_course_list = $Admin->get_training_course_not_in_attendee_list();
                        $trainer_list = $Admin->get_trainer_list();
                        $trainee_list = $Admin->get_trainee_not_in_attendee_list();
                        $error = [];
                        if(isset($_POST['submit_btn'])){
                            $error = $Admin->assign_trainee_to_course();
                        }
                    ?>

                    <div class="col-lg-12">
                        <div class="form-group <?= form_error('Training_Course_ID', $error, TRUE); ?>">
                            <label for="title">Training Course Name</label>
                            <select class="form-control select_box" name="Training_Course_ID" id="training_course_id" style="width: 100%">
                                <option value="">Please Select</option>
                                <?php foreach($training_course_list as $value): ?>
                                    <option value="<?= $value['Training_Course_ID']; ?>" <?= @$error['Training_Course_ID'] == $value['Training_Course_ID'] ? 'selected' : '' ?>><?= $value['Training_Course_Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('Training_Course_ID', $error); ?>
                        </div>

                        <div class="form-group <?= form_error('Trainer_User_ID', $error, TRUE); ?>">
                            <label for="title">Trainer</label>
                            <select class="form-control select_box" name="Trainer_User_ID" id="trainer_user_id" style="width: 100%">
                                <option value="">Please Select</option>
                                <?php foreach($trainer_list as $value): ?>
                                    <option value="<?= $value['User_ID']; ?>" <?= @$error['Trainer_User_ID'] == $value['User_ID'] ? 'selected' : '' ?>><?= $value['User_Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('Trainer_User_ID', $error); ?>
                        </div>

                        <div class="form-group <?= form_error('Trainee_User_ID', $error, TRUE); ?>">
                            <label for="title">Trainee</label>
                            <select multiple class="form-control select_box" name="Trainee_User_ID[]" id="trainee_user_id" style="width: 100%">
                                <?php foreach($trainee_list as $value): ?>
                                    <option value="<?= $value['User_ID']; ?>"><?= $value['User_Name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('Trainee_User_ID', $error); ?>
                        </div>

                        <span class="pull-right">
                            <button type="submit" class="btn btn-success btn-flat" name="submit_btn">Submit</button>
                            <button type="button" class="btn btn-danger btn-flat" id="reset_btn">Reset</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#reset_btn').click(function(){
        $('#training_course_id').val('').trigger('change');
        $('#trainer_user_id').val('').trigger('change');
        $('#trainee_user_id').val('').trigger('change');
    });

    <?php if(!empty(@$error['Trainee_User_ID'])){ ?>
        $('#trainee_user_id').val(<?= $error['Trainee_User_ID'] ?>).trigger('change');
    <?php } ?>
});
</script>