// This script handles the code to remove a user.

function remove_user(user_id) {
    var result = confirm("Are you sure that you want to ban the user ?");

    if(result)
        window.location.href = "/home/remove_user/"  + user_id;
}
