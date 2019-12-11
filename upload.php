<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Upload Picture</title>
    </head>
    <body>
        <form class="" action="includes/upload.php" method="post" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title">
            <label>File Upload</label>
            <input type="File" name="file">
            <button type="submit" name="submit">UPLOAD</button>
        </form>
    </body>
</html>
