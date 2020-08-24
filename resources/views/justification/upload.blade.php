<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h2>Upload de Archivos en Laravel</h2>
        <form method="post" id="frm" url="upload" files="true" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="File"><b>Archivo: </b></label>
            <input type="file" name="File" require>
            <input type="text" name="description" require>
            <input type="submit" value="Enviar" >
        </form>
    </body>
</html>