<?php
global $_MyCookie;
$uid = uniqid();
?>
<div class="tab-content">  
    <?php foreach ($data as $index => $page): ?>
        <div class="tab-pane fade <?php if ($index === 0) : ?>in active<?php endif; ?>" id="pag_<?php echo $uid . $index ?>">                        
            <table class="table table-striped">
                <thead>
                    <tr>      
                        <th>Servidor</th>  
                        <th>SIAPE</th>                                        
                        <th>Saldo de Aulas</th>                                         
                        <th></th>
                    </tr>
                </thead>
                <tbody>                                    
                    <?php
                    foreach ($page as $conta) :
                        $urlDep = $_MyCookie->mountLink('administrator', 'banco', 'addDeposito', $conta->getId());
                        $urlRet = $_MyCookie->mountLink('administrator', 'banco', 'addRetirada', $conta->getId());
                        $urlTra = $_MyCookie->mountLink('administrator', 'banco', 'transacoes', $conta->getId());
                        ?>
                        <tr>          
                            <td><?php echo $conta->getServidor()->getNome(); ?></td> 
                            <td><?php echo $conta->getServidor()->getSiape() ?></td>
                            <td><?php echo $conta->getSaldo() ?></td>                            
                            <td class="hidden-sm hidden-xs text-right">                                                                
                                <a href="<?php echo $urlDep ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Depositar</a>                                
                                <a href="<?php echo $urlRet ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i> Retirar</a>
                                <a href="<?php echo $urlTra ?>" class="btn btn-default"><i class="fa fa-chain"></i> Transações</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>                                            
                </tbody>                            
            </table>
        </div>   
    <?php endforeach; ?>     
    <div class="text-center">
        <ul class="pagination">                        
            <?php foreach ($data as $index => $page) : ?>
                <li class="<?php if ($index === 0) : ?>active<?php endif; ?>">
                    <a href="#pag_<?php echo $uid . $index ?>" data-toggle="tab"><?php echo $index + 1 ?></a>
                </li>
            <?php endforeach; ?>                                                                    
        </ul>
    </div>
</div>