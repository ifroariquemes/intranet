<?php
$servidor = $data['servidor'];
?>    
<header class="row">     
    <div class="col-lg-12">
        <h2><?php echo $data['action'] ?> servidor
            <?php if (!$servidor->getStatus()) : ?>
                (DESATIVADO)
            <?php endif; ?>
        </h2>        
    </div>
</header>    
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form name="FrmEdit" id="FrmEdit" role="form" onsubmit="servidor.submit(event);">
                    <fieldset>
                        <div class="form-group">
                            <label for="textSIAPE">SIAPE:</label>                            
                            <input type="text" required="required" name="siape" id="textSIAPE" class="form-control" value="<?php echo $servidor->getSIAPE() ?>" <?php
                            if (!empty($servidor->getSIAPE())) {
                                echo 'readonly="readonly"';
                            }
                            ?>>                            
                        </div>             
                        <div class="form-group">
                            <label for="textNome">Nome:</label>                            
                            <input type="text" required="required" name="nome" id="textNome" class="form-control" value="<?php echo $servidor->getNome() ?>">                            
                        </div>             
                        <div class="form-group">
                            <label for="selectTipo">Tipo:</label>                            
                            <select name="tipo" class="form-control">
                                <option value="Professor">Professor</option>
                                <option value="TAE" <?php
                                if ($servidor->getTipo() == 'TAE') {
                                    echo 'selected="selected"';
                                }
                                ?>>TAE</option>
                            </select>                            
                        </div>                                     
                    </fieldset>
                    <input type="hidden" name="siape_check" value="<?php echo $servidor->getSiape() ?>">            
                    <div class="text-right">            
                        <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> Salvar</button>                        
                    </div>
                </form>                                
            </div>
        </div>
        <?php if ($servidor->getSiape()) : ?>
            <div class="text-right">            
                <?php if ($servidor->getStatus()) : ?>
                    <a href="#" onclick="servidor.deactive(event)" class="text-danger">Desativar servidor</a>                
                <?php else: ?>
                    <a href="#" onclick="servidor.active(event)" class="text-info">Reativar servidor</a>                
                <?php endif; ?>   
            </div>
        <?php endif; ?>
    </div>    
</div>
<script type="text/javascript">
    require(['jquery'], function ($) {
        $(function () {
            $('#textName').focus();
        });
    });
</script>