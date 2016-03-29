<div id="page">
    <?php if(count($violation_types) == 0): ?>
        <h4>
            There aren't any violation types created yet.
            Please create one using the below form.
        </h4>
    <?php else: ?>
        <h3>Showing all the violation types in the</h3>
        <div class="violation_types">
            <?php foreach($violation_types as $violation_type): ?>
                <div class="violation_type">
                    <div class="name">
                        <?php echo $violation_type->name; ?>
                    </div>
                    <div class="description">
                        <?php echo $violation_type->description; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <h3>Add a new vilation type :</h3>
    <form class="violation-form" method="POST">

        <label>Name</label>
        <input type="text" name="name" placeholder="Name">
        <br>

        <label>Level</label>
        <input type="text" name="level" placeholder="Level">
        <br>

        <label>Description</label>
        <textarea rows="10" name="description" placeholder="Description">

        </textarea>
        <br>


        <button type="submit" name="button">Add</button>
    </form>
</div>
