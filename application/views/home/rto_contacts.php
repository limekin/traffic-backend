<div id="page">
    <h3>List of rto contacts in the database : €</h3>
    <div class="contacts">
        <?php foreach($contacts as $contact): ?>
            <div class="contact">
                <?php echo $contact->name; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form class="violation-form" action="<?php echo site_url('home/new_rto');?>" method="post">
        <label>Name:</label>
        <input type="text" name="name" value="">
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="">
        <br>

        <label>Mobile:</label>
        <input type="text" name="mobile" value="">
        <br>

        <button type="submit" name="button">Add</button>
    </form>
</div>
