<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question Board Form</title>
</head>

<body>
    <script src="./js/board_input.js"></script>
    <h2>Question Board Form</h2>
    <table>
        <tr>
            <td><label for="name">Name:</label></td>
            <td><input type="text" id="name" name="name" required></td>
        </tr>
        <tr>
            <td><label for="password">Password (4-digit):</label></td>
            <td><input type="text" id="password" name="password" min="1000" max="9999" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" required></td>
        </tr>
        <tr>
            <td><label for="phone_number">Phone Number:</label></td>
            <td><input type="tel" id="phone_number" name="phone_number" required></td>
        </tr>
        <tr>
            <td><label for="title">Title:</label></td>
            <td><input type="text" id="title" name="title" required></td>
        </tr>
        <tr>
            <td><label for="content">Content:</label></td>
            <td><textarea id="content" name="content" rows="4" required></textarea></td>
        </tr>
        <tr>
            <td><label for="attachments">Attachments (comma-separated file names):</label></td>
            <td><input type="file" id="attachments" name="attachments"></td>
        </tr>
    </table>
    <button type="button" id="board_write_submit">Submit</button>
</body>

</html>