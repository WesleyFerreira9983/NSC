			<?php 
				include ("conexao.php");
				include ("controllers.php");
				
				if(isset($_SESSION['permissao']))
				{
					if($_SESSION['permissao'] == 1){
					}
					else{
						header("location:index.php"); 
					}
				}
				else
				{
					header("location:index.php"); 
				}
			?>	  
			<li class="nav-item has-treeview">
			<a href="<?php echo base_url(); ?>?p=inicio" class="nav-link">
				<i class="nav-icon fas fa-home"></i>
				<p>
					Início
				</p>
			</a>
			</li>
			<?php if(isset($_SESSION['permissao'])){ ?>
			<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
			<i class="nav-icon fas fa-edit"></i>
              <p>
                Cadastrar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
            <ul class="nav nav-treeview">
			<?php if( $_SESSION['permissao'] ==  1 || $_SESSION['permissao'] ==  2){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=usuarios&typ=0" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuários</p>
                </a>
              </li>
			  <?php } if( $_SESSION['permissao'] ==  1){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=departamentos&typ=0" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departamentos</p>
                </a>
              </li>
			  <?php } if( $_SESSION['permissao'] ==  1 || $_SESSION['permissao'] ==  3){ ?> 
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=produtos&typ=0" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produtos</p>
                </a>
              </li>
			  <?php } if( $_SESSION['permissao'] ==  1){ ?>
			   <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=categoriaprodutos&typ=0" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias do Produto</p>
                </a>
              </li>
			  <?php } ?>
            </ul>
          </li>
		  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
			<i class="nav-icon fas fa-list"></i>
              <p>
                Consultar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
			 <?php if( $_SESSION['permissao'] ==  1 || $_SESSION['permissao'] ==  2){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=usuarios&typ=1" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuários</p>
                </a>
              </li>
			   <?php } if( $_SESSION['permissao'] ==  1){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=departamentos&typ=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departamentos</p>
                </a>
              </li>
			   <?php } if( $_SESSION['permissao'] ==  1 || $_SESSION['permissao'] ==  3){ ?> 
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=produtos&typ=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Produtos</p>
                </a>
              </li>
			   <?php } if( $_SESSION['permissao'] ==  1){ ?>
			   <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=categoriaprodutos&typ=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias do Produto</p>
                </a>
              </li>
			  <?php } ?>
            </ul>
          </li>
<?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastrar Departamento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cadastrar Departamento</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Formulário de Registro</h3>
              </div>
			  <div class="row mb-3">
			  </div>
              <form name="Formulario" id="Formulario"  role="form" method="post" action="?p=inicio&typ=0" enctype="multipart/form-data">
                <div class="card-body">
				 <div class="row mb-2">
					  <div class="col-sm-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
						</div>
					  </div>
					 <div class="col-sm-6">
						<div class="input-group mb-1">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-users"></i></span>
						</div>
						    <select class="form-control" id="superiorresponsavel" name="superiorresponsavel">
								<option selected="selected" value="0" >Superior Responsável</option>
								<?php  
								$resultado = GetUsuarios($conexao,"");
								while($usuarios = mysqli_fetch_array($resultado)){
								?>
									<option value ="<?php echo $usuarios['cpf'] ?>"><?php echo $usuarios['nome'] ?></option>
								<?php } ?>
						    </select>
						</div>
					  </div>
				  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" id="cadastrar" name="cadastrarDepartamento" class="btn btn-primary">Cadastrar</button>				  
                  <a href="<?php echo base_url(); ?>?p=inicio&typ=0" name="cancelar" class="btn btn-default float-right">Cancelar</a>
             </div>
              </form>
            </div>
    </section>
    <!-- /.content -->
  </div>
  
  <script>
		
	   var isValidate = false;
		
		$( "#Formulario" ).submit(function( event ) {
			if(isValidate == false){
				VerificaDados();
			}
			return isValidate;
		});
		
	   function VerificaDados() {
        var nome = $("#nome");
		var superiorresponsavel = $("#superiorresponsavel");
		
		var url_a  = "<?php print base_url(); ?>"+"assets/theme/myScripts/validarDepartamento.php";
		
		
        $.ajax({
            type: "POST",
            url: url_a,
            dataType: "json",
            data: {nome:nome.val(), superiorresponsavel:superiorresponsavel.val()},
            success : function(data){
				nome.removeClass();
				nome.addClass("form-control is-valid");
				superiorresponsavel.removeClass();
				superiorresponsavel.addClass("form-control is-valid");
				toastr.error(data.error);
				
                if (data.code == "200"){
					var str = data.msg;
					var res = str.split(" ");
					isValidate = true;
					$("#cadastrar").click();
					for(var i = 0; i < res.length; i++)
					{
						$("#"+res[i]+"").removeClass();
						$("#"+res[i]+"").addClass("form-control is-valid");
					}
                } else {
					
					var str = data.msg;
					var res = str.split(" ");
					isValidate = false;
					for(var i = 0; i < res.length; i++)
					{ 
						$("#"+res[i]+"").removeClass();
						$("#"+res[i]+"").addClass("form-control is-invalid");
					}
                }
            }
        });
	   }
  </script>