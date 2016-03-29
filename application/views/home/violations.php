<!--
<div id="page">
    <h2>Showing all the reported violations</h2>
    <div class="violations">
        <?php foreach($violations as $violation): ?>
            <div class="violation">
                <div class='type'>
                    <?php echo $violation->violation_type; ?>
                </div>
                <div class="meta">
                    <span class="location">
                        <?php echo $violation->location; ?>
                    </span>.
                    <span class="date">
                        <?php echo $violation->reported_date; ?>
                    </span>
                </div>
                <div class="number-plate">
                    Registration number :
                    <?php echo $violation->vehicle_plate_no; ?>
                </div>
                <div class="image">
                    <img src="<?php echo base_url($violation->image_path);?>"/>
                </div>
                <div class="description">
                    <?php echo $violation->description; ?>
                </div>
                <div class="violation-actions">
                    <?php
                        $discard_url = site_url('/violations/discard?id='.$violation->id);
                        $track_url = site_url('/violations/track?id='.$violation->id);
                        $partially_track_url =
                            site_url('/violations/partially_track?id='.$violation->id);
                    ?>
                    <a href="<?php echo $track_url;?>">
                        Track
                    </a>
                    |
                    <a href="<?php echo $partially_track_url;?>">
                        Track Partially
                    </a>
                    |
                    <a href="<?php echo $discard_url;?>">
                        Discard
                    </a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
-->

<div id="page-wrapper">
    <div class="container-fluid">
        <h3>Showing all the violations</h3>
    <div class="violations">
        <?php foreach($violations as $violation): ?>
            <div class='violation panel panel-default'>
            <div class="panel panel-heading">
                <div class='type'>
                    <?php echo $violation->violation_type; ?>
                </div>
            </div>
            <div class="panel-body">
                <div class="meta">
                    <span class="location">
                        <?php echo $violation->location; ?>
                    </span>
                    <span class="date">
                        <?php echo $violation->reported_date; ?>
                    </span>
                </div>
                <div class="number-plate">
                    Registration number :
                    <?php echo $violation->vehicle_plate_no; ?>
                </div>
                <div class="image">
                    <img src="<?php echo base_url($violation->image_path);?>"/>
                </div>
                <div class="description">
                    <?php echo $violation->description; ?>
                </div>
                <div class="violation-actions">
                    <?php
                        $discard_url = site_url('/violations/discard?id='.$violation->id);
                        $track_url = site_url('/violations/track?id='.$violation->id);
                        $partially_track_url =
                            site_url('/violations/partially_track?id='.$violation->id);
                    ?>
                    <a href="<?php echo $track_url;?>">
                        Track
                    </a>
                    |
                    <a href="<?php echo $partially_track_url;?>">
                        Track Partially
                    </a>
                    |
                    <a href="<?php echo $discard_url;?>">
                        Discard
                    </a>

                </div>
            </div>
            </div>
        <?php endforeach; ?>
    </div>

    </div>
</div>
