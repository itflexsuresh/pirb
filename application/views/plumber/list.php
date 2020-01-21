<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="table-responsive">
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Date of application received</th>
                            <th>Name & Surname</th>
                            <th>Progress Days</th>
                            <th>ID Attached</th>
                            <th>Qualification Verified</th>
                            <th>Proof Of Experience</th>
                            <th>Decleration signed</th>
                            <th>Photo Correct</th>
                            <th>Induction Done</th>
                            <th>Payment Received</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($res as $key=>$val){  
                            extract($val);
                            $date_of_app = date('d-m-Y',strtotime($CreateDate));
                            $full_name = $fname.' '.$lname;
                            echo "<tr><td>$date_of_app</td>";
                            echo "<td>$full_name</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td><a href='update/$UserID' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-pencil text-inverse m-r-10'></i></a></td>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>