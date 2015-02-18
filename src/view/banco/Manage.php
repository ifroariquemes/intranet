<?php global $_MyCookie; ?>
<?php global $_MyCookieUser; ?>
<div class="row">    
    <div class="col-lg-12 text-right">        
        <form id="FrmSearch" class="form-inline" onsubmit="banco.search(event)">            
            <div class="form-group">   
                <a href="#" class="btn btn-sm btn-warning" id="searchClean" style="display: none" onclick="banco.clear(event)"> <i class="fa fa-eraser"></i> <?php _e('Stop searching', 'banco') ?></a>
                <input type="text" name="nome" id="textNome" class="form-control" value="" placeholder="pesquisa rápida...">                            
            </div>                        
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Procurar</button>
        </form>        
    </div>
</div>
<div id="lstSearch" class="row" style="display: none">
    <div class="col-lg-12">        
        <div class="row">
            <div class="col-lg-4">
                <h4>Resultados de busca para: <b id="searchTerm"></b></h4>
            </div>
            <div class="col-lg-2 text-right">

            </div>
        </div>
        <div id="lstSearchData"></div>
    </div>
</div>
<div id="lstData" class="row">
    <div class="col-lg-12">        
        <?php $_MyCookie->LoadView('banco', 'Manage.table', $data); ?>
        <div class="clear"></div>
    </div>
</div>

<nav id="admin-navbar" class="navbar navbar-default navbar-fixed-bottom" role="navigation">    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="align-center">
        <a href="<?php echo $_MyCookie->mountLink('administrator', 'banco', 'add') ?>" class="navbar-link">
            <i class="fa fa-plus-circle fa-4x"></i>
        </a>
    </div><!-- /.navbar-collapse -->
</nav>

<script type="text/javascript">
    require(['jquery'], function ($) {
        $(function () {
            $('#textName').focus();
            $('.pagination li').click(function () {
                location.href = '#page-title';
            });
        });
    });
</script>