<tr>
    <td style="width: 200px;">
        <img width="50" src="<?php echo $storage->url($movie->preview) ?>" alt="<?php echo $movie->name ?>">
    </td>
    <td style="width: 200px;"><?php echo $movie->name ?></td>
    <td><span class="badge bg-warning warn__badge">7.9</span></td>
    <td class="text-end" >
        <div class="d-flex gap-2 justify-content-end">
            <form action="/admin/movies/delete" method="post" >
                <input class="d-none" name="id" type="text" value="<?php echo $movie->id ?>">
                <button type="submit" class="btn btn-danger">Видалити</button>

            </form>

            <a href="/admin/movies/edit?id=<?php echo $movie->id ?>" >
                <button type="submit" class="btn btn-info">Редагувати</button>
            </a>
        </div>
    </td>
</tr>