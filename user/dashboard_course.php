<button class="btn btn-link" data-toggle="modal" data-target="#training_course_modal">
    <h4 class="panel-title"><?= @$training_course_info['Training_Course_Name']; ?></h4>
</button>

<div class="modal fade" id="training_course_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?= $training_course_info['Training_Course_Name']; ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Description</th>
                                <td><?= $training_course_info['Training_Course_Description']; ?></td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td><?= $training_course_info['Training_Course_Start_Date']; ?></td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td><?= $training_course_info['Training_Course_End_Date']; ?></td>
                            </tr>
                            <tr>
                                <th>Start Time</th>
                                <td><?= $training_course_info['Training_Course_Start_Time']; ?></td>
                            </tr>
                            <tr>
                                <th>End Time</th>
                                <td><?= $training_course_info['Training_Course_End_Time']; ?></td>
                            </tr>
                            <tr>
                                <th>Venue</th>
                                <td><?= $training_course_info['Venue_Name']; ?></td>
                            </tr>
                            <tr>
                                <th>Room</th>
                                <td><?= $training_course_info['Room_Name']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>