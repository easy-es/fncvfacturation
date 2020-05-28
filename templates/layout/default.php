<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css"> -->

    <?= $this->Html->css('bootstrap.min.css') ?>
    <!-- <?= $this->Html->css('cake.css') ?> -->

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script("jQuery-3.3.1/jquery-3.3.1.min.js") ?>
    <?= $this->Html->script("JQuery-Cookie/1.4/jquery.cookie.js") ?>
</head>
<body>
    <main class="main">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <?= $this->Html->link(__('FNCV FACTURATION'), ['controller' => 'Pages','action' => 'index'], ['class' => 'navbar-brand']) ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                
                <?php if ($username) :?>
                    <li class="nav-item">
                    <?= $this->Html->link(__('Factures'), ['controller'=>'Factures','action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Categories'), ['controller'=>'Categories','action' => 'index'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Importer fichier Facture'), ['controller'=>'Factures','action' => 'formimport'], ['class' => 'nav-link']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Deconnexion'), ['controller'=> 'Users','action' => 'logout'], ['class' => 'btn btn-primary']) ?> | 
                <?php else : ?>
                    <?= $this->Html->link(__('Se connecter'), ['controller'=> 'Users','action' => 'logout'], ['class' => 'btn btn-primary']) ?>
                    <?php endif ?>
                </li>
                </ul>
            </div>
            </nav>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
