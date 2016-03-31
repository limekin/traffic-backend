<!-- This page shows a list of all the users in the application. -->
<!--
<div id="page">
    <h2>Application users</h2>
    <table class='users-list'>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Violations Reported
                </th>
                <th>
                    Email ID
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php foreach($users as $user): ?>
                <tr class='user-in-list'>
                    <td>
                        <?php echo $user->name; ?>
                    </td>
                    <td>
                        <?php echo $user->violations_reported; ?>
                    </td>
                    <td>
                        test@gmail.com
                    </td>
                    <td>
                        Actions here
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>
-->

<div id="page-wrapper">
    <div class="container-fluid">
        <h2>Application users</h2>
        <br>
        <table class='users-list table table-striped table-bordered'>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Violations Reported
                    </th>
                    <th>
                        Email ID
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr class='user-in-list'>
                        <td>
                            <?php echo $user->name; ?>
                        </td>
                        <td>
                            <?php echo $user->violations_reported; ?>
                        </td>
                        <td>
                            test@gmail.com
                        </td>
                        <td>
                            <a href='#' onclick="remove_user(<?php echo $user->id;?>)" class='btn btn-danger btn-sm'>
                                Ban
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
        </table>
    </div>
</div>

<!-- The script that handles the removal of the user. -->
<script src="<?php echo base_url("js/ban_user.js");?>">
</script>
