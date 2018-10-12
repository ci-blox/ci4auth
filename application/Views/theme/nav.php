<div class="container">
<div class="navbar navbar-default navbar-fixed-top" id="mainnav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CodeIgniter Demo</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
<?php
foreach ($menudata as $key => $value) {
    $link = ($value['link']=='/') ? base_url() : ($value['link']) 
?><li class="<?=$value['active']?>"><a href="<?=$value['link']?>"><?=$value['name']?></a></li>
<?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>
</div>