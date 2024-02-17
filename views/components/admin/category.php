<?php
/**
 * @var \App\Models\Category $category
 */
?>

<tr>
    <td style="width: 200px;"><?php echo $category->name ?></td>
    <td class="text-end" >
       <div class="d-flex gap-2 justify-content-end">
           <form action="/admin/categories/delete" method="post" >
               <input class="d-none" name="id" type="text" value="<?php echo $category->id ?>">
               <button type="submit" class="btn btn-danger">Видалити</button>

           </form>

           <a href="/admin/categories/edit?id=<?php echo $category->id ?>" >
               <button type="submit" class="btn btn-info">Редагувати</button>
           </a>
       </div>
    </td>
</tr>
