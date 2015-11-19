
      <nav class="navbar navbar-default">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">-</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('')?>">
                <img alt="TAD" src="<?php echo base_url('images/pdvsa.png');?>">
            </a>
          </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
<!--        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
        <?php if (in_array("1", $rol)) {?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SCLi<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            
            <li id="scli1"><a href="<?php echo site_url('consulta_despachos/general')?>">Vista General de Despachos</a></li>
            <li id="scli2"><a href="<?php echo site_url('scli/scli_1')?>">Monitor de Despachos</a></li>
            <li id="scli3"><a href="<?php echo site_url('consulta_despachos')?>">Consulta de Despachos</a></li>
            <li id="scli3"><a href="<?php echo site_url('consulta_despachos')?>">SIE-MENA</a></li>
            
          </ul>
        </li>
        <?php }?>
        <?php if (in_array("2", $rol)) {?>
        <li id="sisccombf"><a href="<?php echo site_url('sisccombf/eess')?>">SISCCOMBF</a></li>
        <?php }?>
        <?php if (in_array("3", $rol)) {?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SIEV<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="casos"><a href="<?php echo site_url('casos/casos_1')?>">Investigaciones (Casos)</a></li>
            <li class="divider"></li>
            <li id="verificaciones"><a href="<?php echo site_url('verificaciones/verificaciones_1')?>">Verificaciones (P. Júridicas)</a></li>
            <li id="casos"><a href="<?php echo site_url('verificaciones/verificaciones_4')?>">Cambios de Clasificación</a></li>
            <li id="casos"><a href="<?php echo site_url('noapto/noaptos')?>">No Aptos</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if (in_array("4", $rol)) {?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SSPO<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="pv"><a href="<?php echo site_url('casos/casos_1')?>">Prevención (PV)</a></li>
            <li id="pi"><a href="<?php echo site_url('verificaciones/verificaciones_1')?>">Protección Industrial (PI)</a></li>
            <li id="sti"><a href="<?php echo site_url('verificaciones/verificaciones_4')?>">Seguridad en Tecnologías de Información (STI)</a></li>
          </ul>
        </li>
        <?php }?>
        <?php if (in_array("5", $rol)) {?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SERPCP<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li id="evento1"><a href="<?php echo site_url('serpcp/eventos_1')?>">Eventos por N/F/R</a></li>
            <li id="evento3"><a href="<?php echo site_url('serpcp/eventos_3')?>">Eventos no deseados</a></li>
          </ul>
        </li>
        <?php }?>
      </ul>

        <ul class="nav navbar-nav navbar-right ">
            <li>
                
                <button onclick="logout()" type="button" class="btn btn-danger navbar-btn">
                    
                    <img style="width: 25px; height: 25px" src="<?php echo $img;?>" class="profile-image img-circle">
                    Salir(<?php echo $this->session->userdata('indicador_usuario');?>)
                </button>
            </li>
      </ul>
    </div><!-- /.navbar-collapse -->
           </nav>