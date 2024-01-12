<form class="form_manage-users" method="post" name="crear_post">
    <h3>Post</h3>
    <div>
        <label for="post-select">Elige un tema</label>
        <select name="post-tipo" id="post-select">
            <option value="Anuncio">Anuncios</option>
            <option value="Evento">Eventos</option>
        </select>

    </div>
    <div class="form-group">
        <label for="titulo">Título</label>
        <input id="titulo" name="titulo">
    </div>
    <div class="form-group">
        <label for="contenido">Contenido</label>
        <textarea id="contenido" name="contenido" rows="4" cols="40"
                  placeholder="Escribe el post aquí"></textarea>
    </div>
    <div class="form_btn-container">
        <button type="submit" name="crear_post">Save</button>
    </div>
</form>