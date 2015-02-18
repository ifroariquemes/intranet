<?php
$conta = $data['conta'];
$transacao = $data['transacao'];
?>    
<header class="row">     
    <div class="col-lg-12">
        <h2><?php echo $data['action'] ?> em conta</h2>        
    </div>
</header>    
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form name="FrmEdit" id="FrmEdit" role="form" onsubmit="banco.submitDeposito(event);">
                    <fieldset>
                        <div class="form-group">
                            <label>Servidor:</label>                            
                            <?php echo $conta->getServidor()->getNome() ?>
                        </div>             
                        <div class="form-group">
                            <label>Saldo atual:</label>                            
                            <?php echo $conta->getSaldo() ?>
                        </div>             
                        <div class="form-group">
                            <label>Tipo de transação:</label>                            
                            DEPÓSITO
                        </div>             
                        <div class="form-group">
                            <label for="numberAulas">Depositar (aulas):</label>                            
                            <input type="number" min="0" required="required" name="aulas" id="numberAulas" class="form-control" value="<?php echo $transacao->getAulas() ?>">                            
                        </div> 
                        <div class="form-group">
                            <label for="textArObservacao">Observações:</label>                            
                            <textarea id="textArObservacao" class="form-control"><?php echo $transacao->getObservacao() ?></textarea>
                        </div> 
                    </fieldset>
                    <input type="hidden" name="transacao" value="<?php echo $transacao->getId() ?>">            
                    <input type="hidden" name="conta" value="<?php echo $conta->getId() ?>">
                    <div class="text-right">            
                        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Salvar</button>                        
                    </div>
                </form>                                
            </div>
        </div>
        <?php if ($transacao->getId()) : ?>
            <div class="text-right">                    
                <a href="#" onclick="banco.deleteTransacao(event)" class="text-danger">Deletar transação</a>                                
            </div>
        <?php endif; ?>
    </div>    
</div>
<script type="text/javascript">
    require(['jquery'], function ($) {
        $(function () {
            $('#numberAulas').focus();
        });
    });
</script>