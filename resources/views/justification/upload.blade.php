<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h2>Upload de Archivos en Laravel</h2>
        <form action="{{Route('justification.uploadFile')}}" method="post" enctype="multipart/form-data"> <!-- enctype para subir el logo -->
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea type="text" name="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group" >
                            Adjunta documento
                            <input type="file" name="file">
                        </div>

                        <div>
                            <input type="submit" value="Subir" >
                        </div>
                    </div>
                </form>
    </body>
</html>