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
                        <th>#</th>  
                        <th>Data/Hora</th>                                        
                        <th>Tipo</th>                                         
                        <th>Aulas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>                                    
                    <?php
                    foreach ($page as $transacao) :
                        if ($transacao->getTipo() == \model\banco\Transacao::TIPO_DEPOSITO) {
                            $url = $_MyCookie->mountLink('administrator', 'banco', 'editDeposito', $transacao->getId());
                        } else {
                            $url = $_MyCookie->mountLink('administrator', 'banco', 'editRetirada', $transacao->getId());
                        }
                        $urlImp =  $_MyCookie->mountLink('administrator', 'banco', 'declaracao', $transacao->getId());
                        ?>
                        <tr>          
                            <td><?php echo $transacao->getId(); ?></td> 
                            <td><?php echo $transacao->getDataHora() ?></td>
                            <td><?php echo $transacao->getTipo() ?></td>
                            <td><?php echo $transacao->getAulas() ?></td>                                                        
                            <td class="text-right">                                                                
                                <a href="<?php echo $url ?>" class="btn btn-default hidden-print"><i class="fa fa-pencil"></i></a>                                                                
                                <a href="<?php echo $urlImp ?>" target="_blank" class="btn btn-default hidden-print hidden-sm hidden-xs hidden-md"><i class="fa fa-print"></i> Imprimir declaração</a>                                                                
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