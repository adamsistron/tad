<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es"

      lang="es">

<head>
<meta charset="utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->

<title>SGPCP | Sistema Guardias PCP</title>
        <link rel="shortcut icon" href="<?php echo base_url('images/pdvsa.ico');?>" />

<!-- TemplateEndEditable --><!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->

<link href="<?php echo base_url('css/main-aplicacion.css');?>" rel="stylesheet" type="text/css" />
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>

<body>
    <!--<center>-->
    <div align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

            

	</table>

        <table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr align="center">

                <td align="left">

                        <!--<div class="Contenedor" id="Main-header">-->

					<a href=""><span class="Contenedor-con-Imagen"  id="Main-Logo"></span></a>

                                       

		   		<!--</div>-->

			</td>
                <td align="right"> <div class="Contenedor" id="Contenedor-Degradado">

						<div class="Contenedor-con-Imagen" id="Logo-Continuacion">

							<span class="Contenedor" id="Nombre-Aplicacion">Sistema para el registro de novedades de las Guardias PCP</span>

						</div>

						<div class="Contenedor-con-Imagen" id="Logo-Final"></div>

					</div></td>

		 </tr>
		<tr>

                    <td width="100%" height="678" valign="top" colspan="2">

				<table width="100%" height="640" border="0" align="center" cellpadding="0" cellspacing="0">

					<tr>

        		    	<td width="11" height="23" background="<?php echo base_url('/images/sombrapaginaD.png');?>"></td>

						<td colspan="4" valign="top" bgcolor="#E6E6E6">

							<div class="Contenedor-con-Bordes" id="Main-Identificador_usuario">

								<span class="Texto-Identificador" id="Main-Usuario"> Inicio de Sesión</span>

								<span class="Texto-Identificador" id="Main-Fecha">

									<script language="JavaScript" type="text/javascript">

										var now = new Date();

										var yr = now.getYear();

										if (navigator.appName=='Netscape'){yr = yr + 1900;}

										var mName = now.getMonth() + 1;

										var dName = now.getDay() + 1;

										var dayNr = ((now.getDate()<10) ? "0" : "")+ now.getDate();

										if(dName==1) Day = "Domingo";

										if(dName==2) Day = "Lunes";

										if(dName==3) Day = "Martes";

										if(dName==4) Day = "Mi&eacute;rcoles";

										if(dName==5) Day = "Jueves";

										if(dName==6) Day = "Viernes";

										if(dName==7) Day = "S&aacute;bado";

										if(mName==1) Month="Enero";

										if(mName==2) Month="Febrero";

										if(mName==3) Month="Marzo";

										if(mName==4) Month="Abril";

										if(mName==5) Month="Mayo";

										if(mName==6) Month="Junio";

										if(mName==7) Month="Julio";

										if(mName==8) Month="Agosto";

										if(mName==9) Month="Septiembre";

										if(mName==10) Month="Octubre";

										if(mName==11) Month="Noviembre";

										if(mName==12) Month="Diciembre";

										var todaysDate =(Day + " " + dayNr + " de " + Month + " de " + yr); 

										document.open();

										document.write(todaysDate);

									</script>

								</span>

							</div>

						</td>

						<td width="11" background="<?php echo base_url('/images/sombrapaginaI.png');?>"></td>

					</tr>

					<tr>

						<td height="61" rowspan="3" background="<?php echo base_url('/images/sombrapaginaD.png');?>"><img src="<?php echo base_url('/images/transp.gif');?>" width="10" height="1" /></td>

						<td height="20" colspan="3" valign="top" bgcolor="#666666">

							<div class="Contenedor" id="Main-breadcrumbs">

								<div id="Main-Traza">

								<div id="Main-Traza-aux"></div>

							</div>

							</div>

						</td>

						<td width="11" valign="top" bgcolor="#666666" ><div align="right"><img src="<?php echo base_url('/images/esquinader1.gif');?>" width="10" height="20" /></div></td>

						<td rowspan="3" background="<?php echo base_url('/images/sombrapaginaI.png');?>"><img src="<?php echo base_url('/images/transp.gif');?>" width="10" height="1" /></td>

					</tr>

				<tr>

                                    <td width="169" rowspan="2" valign="top">

						<div class="Contenedor-Editable-Fondo" id="Vista">

							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr>

									<td>

                                                                            <!-- TemplateBeginEditable name="menu" -->

                                                                            <?php
                                                                                //$this->load->view('menu.php');
                                                                            ?>

                                                                            <!-- TemplateEndEditable -->

									</td>

								</tr>

							</table>
                                                </div>
                                        </td>

						<td width="1" rowspan="2" bgcolor="#666666"><img src="<?php echo base_url('/images/transp.gif');?>" width="1" height="1" /></td>

						<td width="600" height="7"><img src="<?php echo base_url('/images/transp.gif');?>" width="1" height="1" /></td>

						<td width="11" valign="top" ><div align="right"><img src="<?php echo base_url('/images/esquinader2.gif');?>" width="10" height="7" />

						</div>

					</td>

				</tr>

				<tr>
					<td height="590" colspan="2" valign="top" style="background-image: url('<?php echo base_url('images/login.jpeg')?>')">

					<!-- TemplateBeginEditable name="contenido" -->
                                        
						<table width="50%" border="0" cellspacing="0" cellpadding="0">

							<tr>

								<td>
                                                                    
                                                                        <div style="margin: 1em; margin-top: 10em; width: 900px;">
                                                                            <center>

                   <?php
                   $this->load->view('login.php');
                   ?>                                                             
                                                                            </center>     
                                                                        </div>
                                                                    
                                                                    
                                                                    
                                                                </td>

							</tr>

						</table>
                                        
					<!-- TemplateEndEditable -->

					</td>
				</tr>

				</table>

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

					<tr>

						<td width="12" background="<?php echo base_url('/images/sombrapaginaD.png');?>"><div align="center"><img src="<?php echo base_url('/images/transp.gif');?>" width="1" height="1" /></div></td>

						<td width="782" bgcolor="#C90C10"><div align="center"><img src="<?php echo base_url('/images/transp.gif');?>" width="782" height="1" /></div></td>

						<td width="14" background="<?php echo base_url('/images/sombrapaginaI.png');?>"><div align="left"><img src="<?php echo base_url('/images/transp.gif');?>" width="10" height="1" /></div></td>

					</tr>

				</table>

			</td>

		</tr>

	</table>
</div>
                                            <!--</center>-->
</body>

</html>



