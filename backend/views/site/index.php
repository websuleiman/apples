<?php

/* @var $this yii\web\View */

$this->title = 'Apples application';
?>
<div class="site-index">


    <div class="jumbotron">

        <h1>Apples!</h1>

        <p><a class="btn btn-success" href="<?= \yii\helpers\Url::to(['site/create']) ?>">Generate apples</a></p>

        <table class="table table-striped table-responsive">
            <thead>
            <tr>
                <th class="text-center">Size</th>
                <th class="text-center">Color</th>
                <th class="text-center">Drop</th>
                <th class="text-center">Eat</th>
            </tr>
            </thead>
            <tbody>
            <?php if($apples): ?>
            <?php foreach ($apples as $apple): ?>
            <tr>
                <td><?= $apple->size; ?> %</td>
                <td><?= $apple->color; ?></td>
                <td><a href="<?= \yii\helpers\Url::to(['site/drop', 'id' => $apple->id]) ?>">Drop</a></td>
                <td>
                        <input type="number" onchange="getData();" id="eat<?=$apple->id;?>" class="eat<?=$apple->id;?>" name="eat<?=$apple->id;?>" required>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="lead">Яблок нет</p>
            <?php endif; ?>
            </tbody>
        </table>

    </div>

    <script>
        function getData() {
            <?php foreach ($apples as $apple): ?>
            if(document.getElementById('eat<?=$apple->id; ?>').value != '') {
                let jsVar = document.getElementById('eat<?=$apple->id; ?>').value;
              let link2 = "http://localhost<?=\yii\helpers\Url::to(['site/eat', 'id' => $apple->id]) ?>";

                              let fullLink = link2 + "&eat="+encodeURIComponent(jsVar);

                window.location = fullLink;

                            }

                            <?php endforeach; ?>
        }
    </script>

</div>
