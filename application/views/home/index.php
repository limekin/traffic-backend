<!--
<div id='page'>
    <h2>Administration Panel</h2>
    <ul class='panel-actions'>
        <li>
            <a href="<?php echo site_url('home/users');?>">
                Users
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('home/violations');?>">
                Violations
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('home/rto_contacts');?>">
                RTO Contacts
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('home/statistics');?>">
                Violation Statistics
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('home/violation_types');?>">
                Violation Types
            </a>
        </li>

    </ul>
</div>
-->

        <!--
            Populate the violation type stat, so that it can be used later
            for building the douhnut chart.
        -->
        <script>
            window.type_stats = <?php echo json_encode($type_stat); ?>;
        </script>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
							Dashboard
                            <small>Administration Panel</small>
                        </h1>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
					-->
                    </div>
                </div>
                <!-- /.row -->

				<!-- Shows the violations and the user count. -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
											<?php echo $violations_count; ?>
										</div>
                                        <div>New Violations</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('home/violations'); ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View All</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
											<?php echo $user_count; ?>
										</div>
                                        <div>New Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('home/users');?>">
                                <div class="panel-footer">
                                    <span class="pull-left">View All</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
				</div>

                <!-- Violation type statistics. -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>Violation Type statistics</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <br>
                        <br>
                        <canvas id="myChart" width="300" height="300"></canvas>
                        <div id="chart_info">
                        </div>

                    </div>
                </div>
                <!-- close Violation type statistics. -->

				<div class="row">
					<div class="col-md-12">
						<h3>Recent Violations</h3>
					</div>
				</div>
			    <?php foreach($recent_violations as $recent_violation): ?>
                <div class="row">
					<div class="col-md-12">
						<div class="panel panel-default recent_violation">
							<div class="panel-heading location">
								<?php echo $recent_violation->location; ?>
							</div>
							<div class="panel-body">
								<div class="violation_type">
									<?php echo $recent_violation->violation_type; ?>
								</div>
                                <div class="description">
                                    <?php echo $recent_violation->description; ?>
                                </div>
                                <br>
                                <a href='#' class="btn btn-sm btn-primary">
                                    Track
                                </a>
                                <a href='#' class="btn btn-sm btn-danger">
                                    Discard
                                </a>
                                <!--
								<div class="preview">
					                <div class="image">
					                    <img src="<?php echo base_url($recent_violation->image_path);?>"/>
					                </div>
								</div>
                            -->
							</div>
						</div>
					</div>
                </div> <!-- Row close. -->
				<?php endforeach; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <!-- Chart.js for cool charts !!! :D -->
        <script src="<?php echo base_url('js/chart.min.js'); ?>">
        </script>
        <!-- For loading the setting up the pie chart. -->
        <script src="<?php echo base_url('js/chart_module.js');?>">
        </script>
