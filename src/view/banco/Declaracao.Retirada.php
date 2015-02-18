<?php global $_MyCookie ?>
<style>*{font-family: serif !important}</style>
<div class="container" style="margin: 50px">
    <div class="row">
        <div class="col-xs-7">
            <p><img src="<?php echo $_MyCookie->getSite() ?>src/assets/images/brasao.jpg" width="60"></p>
            <p style="font: bold 10pt Arial !important">MINISTÉRIO DA EDUCAÇÃO<br>
                <span style="font: bold 8pt Arial !important">SECRETARIA DE EDUCAÇÃO PROFESSIONAL E TECNOLÓGICA</span></p>        
        </div>
        <div class="col-xs-5 text-right">
            <img src="<?php echo $_MyCookie->getSite() ?>src/assets/images/ifro_logo.jpg" width="200">
        </div>
    </div>
    <hr>
    <br>
    <br>
    <h3 class="text-center">DECLARAÇÃO</h3>
    <br>
    <br>
    <p class="text-justify" style="text-indent: 100px">Declaro para os devidos fins que eu, <b><?php echo $data->getConta()->getServidor()->getNome() ?></b>, 
        SIAPE <?php echo $data->getConta()->getServidor()->getSIAPE() ?>, farei uso imediato de <b><?php echo $data->getAulas() ?></b> aulas de meu banco de aulas na data de <?php echo substr($data->getDatahora(), 0, 10) ?> 
        reconhecendo que serão substraídas as aulas da conta neste Instituto Federal de Educação, Ciência e Tecnologia de Rondônia 
        - Campus Ariquemes.</p> 
    <p class="text-right">Por ser expressão da verdade, firmo o presente para efeitos legais.</p>
    <br>
    <br>
    <p class="text-right">Ariquemes, <?php echo \lib\util\Date::Dia() ?> de <?php echo \lib\util\Date::MesNome(date('m')) ?> de <?php echo \lib\util\Date::Ano() ?>.</p>
    <br>
    <br>
    <br>
    <p class="text-center">
        <?php echo $data->getConta()->getServidor()->getNome() ?><br>
        <?php echo $data->getConta()->getServidor()->getTipo() ?><br>
        IFRO - CAMPUS ARIQUEMES
    </p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
<hr>
<p class="text-center" style="font-size: 7pt">Rod. RO 257, Km 13, sentido Machadinho do Oeste - RO - Zona Rural - CEP.: 76.870-970, Ariquemes-RO/ Fone/Fax (69) 3535-2063 - E-mail: campusariquemes@ifro.edu.br</p>
<script>
    window.print();
    window.close();
</script>