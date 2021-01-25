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

            <?php
        //    var_dump($_GET);
            ?>
                            // document.getElementById("link").href = "/?jsVar="+encodeURIComponent(jsVar);
                            <?php endforeach; ?>
        }
    </script>

<!--    <div class="body-content">-->
<!---->
<!--        <div class="row">-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->

</div>
