<?php global $_MyCookie; ?>
<?php global $_MyCookieUser; ?>
<div class="row">    
    <div class="col-lg-12 text-right">        
        <form id="FrmSearch" class="form-inline" onsubmit="banco.searchTransacoes(event)">            
            <div class="form-group">   
                <a href="#" class="btn btn-sm btn-warning" id="searchClean" style="display: none" onclick="banco.clear(event)"> <i class="fa fa-eraser"></i> Parar busca</a>
                <input type="date" name="data" id="textNome" class="form-control" value="" placeholder="pesquisa rápida...">                            
            </div>                        
            <input type="hidden" name="conta" value="<?php echo $data['conta']->getId() ?>">
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Procurar</button>
        </form>        
    </div>
</div>
<h2>Histórico de Transações</h2>
<div class="row">
    <div class="col-lg-12">        
        <form class="form-inline">
            <div class="form-group">
                <label>Servidor:</label>                            
                <?php echo $data['conta']->getServidor()->getNome() ?> &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>SIAPE:</label>                            
                <?php echo $data['conta']->getServidor()->getSIAPE() ?> &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Saldo atual:</label>                            
                <?php echo $data['conta']->getSaldo() ?>
            </div>
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
        <?php $_MyCookie->LoadView('banco', 'Transacoes.table', $data['transacoes']); ?>
        <div class="clear"></div>
    </div>
</div>

<nav id="admin-navbar" class="navbar navbar-default navbar-fixed-bottom" role="navigation">    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="align-center">

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