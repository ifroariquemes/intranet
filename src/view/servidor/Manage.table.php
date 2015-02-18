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
                        <th>Nome</th>  
                        <th>SIAPE</th>                                        
                        <th>Tipo</th>                                         
                        <th></th>
                    </tr>
                </thead>
                <tbody>                                    
                    <?php
                    foreach ($page as $servidor) :
                        $url = $_MyCookie->mountLink('administrator', 'servidor', 'edit', $servidor->getSiape());                        
                        ?>
                        <tr>          
                            <td>
                                <a href="<?php echo $url ?>"><?php echo $servidor->getNome(); ?></a>                                
                                <?php if(!$servidor->getStatus()) :?>
                                (DESATIVADO)
                                <?php endif; ?>
                            </td> 
                            <td><?php echo $servidor->getSiape() ?></td>
                            <td><?php echo $servidor->getTipo() ?></td>                            
                            <td class="hidden-sm hidden-xs text-right">                                                                
                                <a href="<?php echo $url ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>                                
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