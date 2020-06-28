<tbody>

<?php if (count($search)): ?>
<?php foreach ($search as $photo):?>
    <tr>

        <td>
            <a href ="photo?id=<?= $photo['_id'] ?>" ><img src="<?= 'upload/'. $photo['_id'].'_thumb'.'.'. $photo['ext'] ?>" onclick= alt="" class="miniphoto"/></a>

        </td>
        <td>
            <a><?= $photo['tytul'] ?>   </a>
        </td>
        <td>
            <a><?= $photo['autor'] ?>   </a>
        </td>
        <td>
            <a href="delete?id=<?= $photo['_id']?>"> usuń </a>
        </td>
    </tr>

    <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="3">Brak zdjęć</td>
        </tr>
    <?php endif ?>
</tbody>