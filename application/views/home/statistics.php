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
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Statistics (showing form most reported violations)</h3>
                <br>
                <br>
                <div class="violation-stats">
                    <?php foreach($stats as $stat): ?>
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
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>
