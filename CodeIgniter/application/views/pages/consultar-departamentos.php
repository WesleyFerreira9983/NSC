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
				
				if(isset($_GET["d"]))
				{
					RemoveDepartamento($conexao,$_GET["d"]);
				}
				
				if(isset($_POST["Alterar"]))
				{	
					AlteraDepartamento($conexao,$_POST["id"], $_POST["nome"], $_POST["funcionarioresponsavel"]);
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
			<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
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
                <a href="<?php echo base_url(); ?>?p=departamentos&typ=0" class="nav-link">
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
		  <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
			<i class="nav-icon fas fa-list"></i>
              <p>
                Consultar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
             <ul class="nav nav-treeview">
			 <?php if( $_SESSION['permissao'] ==  1 || $_SESSION['permissao'] ==  2){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=usuarios&typ=1" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuários</p>
                </a>
              </li>
			   <?php } if( $_SESSION['permissao'] ==  1){ ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>?p=departamentos&typ=1" class="nav-link active">
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
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultar Departamentos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Consultar Departamentos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
	  <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabela de Departamentos</h3>

                <div class="card-tools">
				<form role="form" method="post" action="<?php echo base_url(); ?>?p=departamentos&typ=1" enctype="multipart/form-data">
                  <div class="input-group input-group-sm" style="width: 150px;">				  
                    <input type="text" name="search" class="form-control float-right" placeholder="Procurar">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
				  </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-striped">
                   <tr>
                    <th>Nome</th>
                    <th>Fucionário Responsável</th>
					<th></th>
					<th></th>
                  </tr>
                   <?php
						$procurar = "";
						if(isset($_POST["search"])){
							$procurar = $_POST["search"];
						}
						$resultado = GetDepartamentos($conexao,$procurar);
						while($departamento= mysqli_fetch_array($resultado)){
						$user = mysqli_fetch_array(GetUsuariosIndex($conexao, $departamento["id_funcionarioresponsavel"]));
						echo '<tr><td>'.$departamento["nome"].'</td>'
						.'<td>'.$user["nome"].'</td>';
						?>
					  <td>
						<a href="<?php echo base_url(); ?>?p=departamentos&typ=1&j=<?php echo $departamento["nome"] ?>" style="color:DodgerBlue">
							<i class="nav-icon fas fa-edit"></i>
						</a>
					</td>
                    <td>
						<a href="<?php echo base_url(); ?>?p=departamentos&typ=1&d=<?php echo $departamento["nome"] ?>" style="color:Tomato">
							<i class="nav-icon fas fa-trash"></i>
						</a>
					</td>
                  </tr>		
						<?php } ?>					  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
		  
		</div>
    </section>
	<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h4 class="modal-title">Alterar Departamento</h4>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					<?php
						$resultado = GetDepartamentosIndex($conexao,$_GET["j"]);
						$departmento_res =  mysqli_fetch_assoc($resultado);
					?>
					<form name="Formulario" id="Formulario" role="form" method="post" action="?p=departamentos&typ=1" enctype="multipart/form-data">
					<div class="card-body">
					 <div class="row mb-2">
						  <div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input name="id" id="id" hidden type="text" class="form-control" value="<?php echo $departmento_res["nome"]; ?>" placeholder="Nome">
								<input type="text" id="nome" class="form-control" value="<?php echo $departmento_res["nome"]; ?>" name="nome" placeholder="Nome">
							</div>
						  </div>
						 <div class="col-sm-6">
							<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-users"></i></span>
							</div>
								<select class="form-control" id="superiorresponsavel" name="funcionarioresponsavel">
									<option selected="selected" value="0" >Superior Responsável</option>
									<?php  
									$resultado = GetUsuarios($conexao,"");
									while($usuarios = mysqli_fetch_array($resultado)){
										if($departmento_res["id_funcionarioresponsavel"] == $usuarios["cpf"]){
											echo '<option selected value ="'.$usuarios['cpf'].'">'.$usuarios['nome'].'</option>';
										}else{
											echo '<option value ="'.$usuarios['cpf'].'">'.$usuarios['nome'].'</option>';
										}
									}
									?>
								</select>
							</div>
						  </div>
					  </div>
					</div>
					</div>
					<div class="modal-footer justify-content-between"> 
    				  <button type="submit" id="alterar" name="Alterar" class="btn btn-primary">Alterar</button>				  
					  <button type="submit" class="btn btn-default float-right" data-dismiss="modal">Cancelar</button>
					</div>
					</form>
				  </div>
				  <!-- /.modal-content -->
				</div>
        <!-- /.modal-dialog -->
	</div>
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
		var id = $("#id");
		var superiorresponsavel = $("#superiorresponsavel");
		
		var url_a  = "<?php print base_url(); ?>"+"assets/theme/myScripts/validarAlteraDepartamento.php";
		
		
        $.ajax({
            type: "POST",
            url: url_a,
            dataType: "json",
            data: {nome:nome.val(), superiorresponsavel:superiorresponsavel.val(), id:id.val()},
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
					$("#alterar").click();
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