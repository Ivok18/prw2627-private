<!DOCTYPE html>
<html>
    <head>
        <title>TODO's Messages</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">TODO's Messages</div>
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div class="main">
            <form id="message_form" action="messages.php?member=XXX" method="post">
                <h4 id="message_form_title">Type here to leave a message:</h4>
                <textarea id="body" name="body" rows="3"></textarea>
                <label>
                    <input id="private" name="private" type="checkbox"> Private message
                </label>
                <input type="submit" value="Post">
            </form>
            <p>These are TODO's messages:</p>
            <table class="message_list">
                <tr>
                    <th>Date/Time</th>
                    <th>Author</th>
                    <th>Message</th>
                    <th>Private?</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>2025-07-09 10:11:33</td>
                    <td>ben</td>
                    <td>Hey, welcome to MSN!</td>
                    <td><input type="checkbox" disabled></td>
                    <td>delete</td>
                </tr>
                <tr>
                    <td>2025-07-09 18:42:00</td>
                    <td>admin</td>
                    <td>Don't forget to complete your profile.</td>
                    <td><input type="checkbox" disabled checked></td>
                    <td>delete</td>
                </tr>
            </table>
        </div>
    </body>
</html>
