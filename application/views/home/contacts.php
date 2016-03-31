<div id="page-wrapper">
    <div class="container-fluid">
        <h3>List of saved RTO contacts</h3>
        <table class="table table-striped">
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Mobile
                </th>
                <th>
                    Actions
                </th>
            </tr>
            <?php foreach($contacts as $contact): ?>
                <tr>
                    <td>
                        <?php echo $contact->name; ?>
                    </td>
                    <td>
                        <?php echo $contact->email; ?>
                    </td>
                    <td>
                        <?php echo $contact->mobile; ?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('home/remove_contact/'.$contact->id);?>" class='btn btn-default'>
                            Remove
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
