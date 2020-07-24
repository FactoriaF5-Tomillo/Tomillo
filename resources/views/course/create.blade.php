<div class="container">
    <div class="row justify-content-center">
        <div class="form-group">
            <form action="{{Route('course.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" name="title"/>
                    <label>Descripcion</label>
                    <input type="text" name="description"/>
                    <label>Days</label>
                    <input type="text" name="days"/>
                </div>

                    <input type="submit" class="btn btn-secundary" value="crear">
            </form>

        </div>
    </div>
</div>


