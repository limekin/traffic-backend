<!--
<div id="page">
    <h2>Overall statistics report of all the violations</h2>
    <div class="violation-stats">
        <?php foreach($stats as $stat): ?>
            <div class="violation-stat">
                <p class="location">
                    <?php echo $stat->location; ?>
                </p>
                <div class="values">
                    <p class='violation-count'>
                        <?php echo $stat->violation_count; ?>
                    </p>
                    violations reported.
                    <p class="most-type-section">
                        Most reported violation:
                        <span class="most-type">
                            <?php echo $stat->max_type; ?>
                        </span>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
-->

<!-- For adding type stats for the statisticss. -->
<script>
    window.stats = [];
    <?php foreach($stats as $stat): ?>
        window.stats.push( <?php echo json_encode($stat->type_stats); ?> );
    <?php endforeach; ?>
</script>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Statistics (showing form most reported violations)</h3>
                <br>
                <br>
                <div class="violation-stats">
                    <?php foreach($stats as $index => $stat): ?>
                        <div class="panel panel-primary violation-stat">
                            <p class="panel-heading location">
                                <?php echo $stat->location; ?>
                            </p>
                            <div class="panel-body">
                                <div class="values">
                                    <p class='violation-count'>
                                        <?php echo $stat->violation_count; ?>
                                    </p>
                                    violations reported.
                                    <p class="most-type-section">
                                        Most reported violation:
                                        <span class="most-type">
                                            <?php echo $stat->max_type; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="chart">
                                <p><strong>
                                    Percent statistics of violation types for this
                                    location
                                </strong></p>
                                <br>
                                <canvas id="<?php echo $index;?>_canvas" width="150" height="150"></canvas>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- For charts.js. -->
<script src="<?php echo base_url('js/chart.min.js');?>">
</script>
<!-- Chat module. -->
<script src="<?php echo base_url('js/chart_statistics.js');?>">
</script>

<!-- For chat_scripts. -->
