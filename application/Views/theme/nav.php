<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#605c63a6">
  <a class="navbar-brand" href="#">Secure Area</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
    <?php
foreach ($menudata as $key => $value) {
    $link = ($value['link'] == '/') ? base_url() : ($value['link'])
    ?><li class="<?=$value['active']?>"><a href="<?=$value['link']?>"><?=$value['name']?></a></li>
<?php }?>
  </ul></div>
</nav>
