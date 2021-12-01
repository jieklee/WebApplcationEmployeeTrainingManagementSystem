<!-- Admin modal -->

<!-- all_booking_details_modal-->
<div class="modal fade" id="all_booking_details_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('booking_details'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= lang('reference'); ?></th>
                                <td id="booking_id" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('subject_name'); ?></th>
                                <td id="subject_name" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('date'); ?></th>
                                <td id="date" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('time'); ?></th>
                                <td id="time" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('venue'); ?></th>
                                <td id="venue" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('class'); ?></th>
                                <td id="class" colspan="3"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_id'); ?></th>
                                <td id="student_id"></td>
                                <th><?= lang('tutor_id'); ?></th>
                                <td id="tutor_id"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_name'); ?></th>
                                <td id="student_name"></td>
                                <th><?= lang('tutor_name'); ?></th>
                                <td id="tutor_name"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_phone_number'); ?></th>
                                <td id="student_phone_number"></td>
                                <th><?= lang('tutor_phone_number'); ?></th>
                                <td id="tutor_phone_number"></td>
                            </tr>
                            <tr>
                                <th><?= lang('description'); ?></th>
                                <td id="description" colspan="3"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- venue_modal -->
<div class="modal fade" id="venue_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?= lang('venue_form'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" method="post">
                        <?php 
                            $venue_error = [];
                            if(isset($_POST['venue_save_btn'])){
                                $venue_error = $Admin->save_venue();
                            }

                            echo form_error('error', $venue_error);
                        ?>

                        <div class="col-lg-12">
                            <input type="hidden" name="venue_id" id="venue_id" value="<?= @$venue_error['venue_id'];?>">
                            <div class="form-group <?= form_error('venue_name', $venue_error, TRUE); ?>">
                                <label for="venue_name"><?= lang('venue_name'); ?></label>
                                <input type="text" class="form-control" name="venue_name" id="venue_name" minlength="3" maxlength="3" style="text-transform: uppercase;" value="<?= @$venue_error['venue_name']; ?>"/>
                                <?= form_error('venue_name', $venue_error); ?>
                            </div>

                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-success btn-flat" name="venue_save_btn"><?= lang('save'); ?></button>
                                <button type="button" class="btn btn-danger btn-flat" id="venue_cancel_btn"><?= lang('cancel'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- class_modal -->
<div class="modal fade" id="class_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?= lang('class_form'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" method="post">
                        <?php 
                            $class_error = [];
                            if(isset($_POST['class_save_btn'])){
                                $class_error = $Admin->save_class();
                            }

                            echo form_error('error', $class_error);
                        ?>
                        
                        <div class="col-lg-12">
                            <input type="hidden" name="venue_id" id="class_venue_id" value="<?= @$class_error['venue_id']; ?>">
                            <input type="hidden" name="class_id" id="class_id" value="<?= @$class_error['class_id']; ?>">
                            <div class="form-group <?= form_error('class_name', $class_error, TRUE); ?>">
                                <label for="class_name"><?= lang('class_name'); ?></label>
                                <input type="text" class="form-control" name="class_name" id="class_name" minlength="9" maxlength="9" style="text-transform: uppercase;" value="<?= @$class_error['class_name']; ?>">
                                <?= form_error('class_name', $class_error); ?>
                            </div>

                            <div class="form-group pull-right">
                                <button type="submit" class="btn btn-success btn-flat" name="class_save_btn"><?= lang('save'); ?></button>
                                <button type="button" class="btn btn-danger btn-flat" id="class_cancel_btn"><?= lang('cancel'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- User Modal -->

<!-- booking_details_modal -->
<div class="modal fade" id="booking_details_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('booking_details'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= lang('reference'); ?></th>
                                <td id="booking_id"></td>
                            </tr>
                            <tr>
                                <th><?= lang('tutor_id'); ?></th>
                                <td id="tutor_id"></td>
                            </tr>
                            <tr>
                                <th><?= lang('tutor_name'); ?></th>
                                <td id="tutor_name"></td>
                            </tr>
                            <tr>
                                <th><?= lang('tutor_phone_number'); ?></th>
                                <td id="tutor_phone_number"></td>
                            </tr>
                            <tr>
                                <th><?= lang('subject_name'); ?></th>
                                <td id="booking_subject_name"></td>
                            </tr>
                            <tr>
                                <th><?= lang('date'); ?></th>
                                <td id="booking_date"></td>
                            </tr>
                            <tr>
                                <th><?= lang('time'); ?></th>
                                <td id="booking_time"></td>
                            </tr>
                            <tr>
                                <th><?= lang('venue'); ?></th>
                                <td id="booking_venue"></td>
                            </tr>
                            <tr>
                                <th><?= lang('class'); ?></th>
                                <td id="booking_class"></td>
                            </tr>
                            <tr>
                                <th><?= lang('description'); ?></th>
                                <td id="booking_description"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- response_details_modal -->
<div class="modal fade" id="response_details_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('response_details'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th><?= lang('reference'); ?></th>
                                <td id="response_booking_id"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_id'); ?></th>
                                <td id="student_id"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_name'); ?></th>
                                <td id="student_name"></td>
                            </tr>
                            <tr>
                                <th><?= lang('student_phone_number'); ?></th>
                                <td id="student_phone_number"></td>
                            </tr>
                            <tr>
                                <th><?= lang('subject_name'); ?></th>
                                <td id="response_subject_name"></td>
                            </tr>
                            <tr>
                                <th><?= lang('date'); ?></th>
                                <td id="response_date"></td>
                            </tr>
                            <tr>
                                <th><?= lang('time'); ?></th>
                                <td id="response_time"></td>
                            </tr>
                            <tr>
                                <th><?= lang('venue'); ?></th>
                                <td id="response_venue"></td>
                            </tr>
                            <tr>
                                <th><?= lang('class'); ?></th>
                                <td id="response_class"></td>
                            </tr>
                            <tr>
                                <th><?= lang('description'); ?></th>
                                <td id="response_description"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- change_password_modal -->
<div class="modal fade" id="change_password_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('change_password'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form role="form" method="post">
                        <?php
                            $error = [];
                            if(isset($_POST['change_password_btn'])){
                                $error = $User->change_password();

                                echo form_error('error', $error);
                            }
                        ?>
                        <div class="col-lg-12">
                            <div class="form-group <?= form_error('old_password', $error, TRUE); ?>">
                                <label for="old_password"><?= lang('old_password'); ?></label>
                                <input type="password" class="form-control" name="old_password">
                                <?= form_error('old_password', $error); ?>
                            </div>

                            <div class="form-group <?= form_error('new_password', $error, TRUE); ?>">
                                <label for="new_password"><?= lang('new_password'); ?></label>
                                <input type="password" class="form-control" name="new_password">
                                <?= form_error('new_password', $error); ?>
                            </div>

                            <div class="form-group <?= form_error('reenter_password', $error, TRUE); ?>">
                                <label><?= lang('reenter_password'); ?></label>
                                <input type="password" class="form-control" name="reenter_password">
                                <?= form_error('reenter_password', $error); ?>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-flat" name="change_password_btn"><?= lang('change_password'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- tnc_modal -->
<div class="modal fade" id="tnc_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?= lang('tnc_for_apply_as_tutor'); ?></h4>
            </div>
            <div class="modal-body">
                1. <br/>
                2.
            </div>
        </div>
    </div>
</div>