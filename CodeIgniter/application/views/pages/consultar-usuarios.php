			<?php 
			
				if(isset($_SESSION['permissao']))
				{
					if($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 2){
					}
					else{
						header("location:index.php"); 
					}
				}
				else
				{
					header("location:index.php"); 
				}
				
				include ("conexao.php");
				include ("controllers.php");
				
				if(isset($_GET["d"]))
				{
					RemoveUsuario($conexao,$_GET["d"]);
				}
				
				if(isset($_POST["Alterar"]))
				{	
					AlteraUsuario($conexao,$_POST["id"],$_POST["nome"],$_POST["sobrenome"],$_POST["email"],
					$_POST["senha"],$_POST["telefone"],$_POST["celular"],$_POST["datanascimento"],
					$_POST["departamento"],$_POST["superiorresponsavel"]);
				}
				
			?>	   <li class="nav-item has-treeview">
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
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultar Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Consultar Usuários</li>
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
                <h3 class="card-title">Tabela de Usuários</h3>

                <div class="card-tools">
				<form role="form" method="post" action="<?php echo base_url(); ?>?p=usuarios&typ=1" enctype="multipart/form-data">
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
                    <th>Superior Responsável</th>
					<th>Departamento</th>
					<th>E-mail</th>
					<th>Nível de Acesso</th>
					<th></th>
					<th></th>
                  </tr>
                  <?php  
						$procurar = "";
						if(isset($_POST["search"])){
							$procurar = $_POST["search"];
						}
						$resultado = GetUsuarios($conexao,$procurar);
						while($usuarios = mysqli_fetch_array($resultado)){
						$user = mysqli_fetch_array(GetUsuariosIndex($conexao, $usuarios["id_superiorresponsavel"]));
						echo '<tr><td>'.$usuarios["nome"].'</td>'
						.'<td>'.$user["nome"].'</td>'
						.'<td>'.$usuarios["departamento"].'</td>'
						.'<td>'.$usuarios["email"].'</td>'
						.'<td>';
								if($usuarios["nivelacesso"] == 1){
									echo 'Administrador';
								 }else{
								 if($usuarios["nivelacesso"] == 1){
									echo 'Coordenador';
								 }else{
									echo 'Operador de Caixa';
								 }};
					    echo '</td>';	
						?>
					  <td>
						<a href="<?php echo base_url(); ?>?p=usuarios&typ=1&j=<?php echo $usuarios["cpf"] ?>" style="color:DodgerBlue">
							<i class="nav-icon fas fa-edit"></i>
						</a>
					</td>
                    <td>
						<a id="buttonClick" href="<?php echo base_url(); ?>?p=usuarios&typ=1&d=<?php echo $usuarios["cpf"] ?>" style="color:Tomato">
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
					  <h4 class="modal-title">Alterar Usuários</h4>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					<?php
						$resultado = GetUsuariosIndex($conexao,$_GET["j"]);
						$usuario =  mysqli_fetch_assoc($resultado);
					?>
					<form name="Formulario" id="Formulario" role="form" method="post" action="?p=usuarios&typ=1" enctype="multipart/form-data">
					<div class="card-body">
					  <div class="row mb-2">
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input hidden value="<?php echo $usuario["cpf"]; ?>" id="cpf" type="text" class="form-control" name="id" placeholder="Nome">
								<input value="<?php echo $usuario["nome"]; ?>" id="nome" type="text" class="form-control" name="nome" placeholder="Nome">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<input value="<?php echo $usuario["sobrenome"]; ?>" id="sobrenome" type="text" class="form-control" name="sobrenome" placeholder="Sobrenome">
							</div>
						</div>
					  </div> 
					  <div class="input-group mb-4">
					  <div class="input-group-prepend">
						<span class="input-group-text"><i class="fas fa-envelope"></i></span>
					  </div>
					  <input type="email" value="<?php echo $usuario["email"]; ?>" id="email" class="form-control" name="email" placeholder="Email">
					  </div>
					  
					   <div class="row mb-2">
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
							<input type="password" value="<?php echo $usuario["senha"]; ?>" id="senha" class="form-control" name="senha" placeholder="Senha">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
								</div>
								 <input type="password" value="<?php echo $usuario["senha"]; ?>" id="confsenha" class="form-control" placeholder="Confirmar Senha">
							</div>
						</div>
					  </div> 
					   <div class="row mb-2">
						  <div class="col-sm-6">
							<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-users"></i></span>
							</div>
								<select class="form-control" name="nivelacesso" id="nivelacesso">
									<option value ="0" selected="selected">Nível de Acesso</option>
									<?php 
										if($usuario["nivelacesso"] == 1){
										echo '<option selected value ="1">Administrador</option>';
										}else{
										echo '<option value ="1">Administrador</option>';
										}
										if($usuario["nivelacesso"] == 2){
										echo '<option selected value="2">Coordenador</option>';
										}else{
										echo '<option value ="2">Coordenador</option>';
										}
										if($usuario["nivelacesso"] == 13){
										echo '<option selected value="3">Operador de Caixa</option>';
										}else{
										echo '<option value ="2">Operador de Caixa</option>';
										}
									?>
								</select>
							</div>
						  </div>
						 <div class="col-sm-6">
						   <div class="input-group mb-4">
							  <div class="input-group">
								<div class="input-group-prepend">
								  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
								</div>
							  <input placeholder="Data de Nascimento" id="datanascimento" value="<?php echo $usuario["datanascimento"]; ?>" type="text" name="datanascimento" class="form-control" data-inputmask='"mask": " 99/99/9999"' data-mask>
							 </div>
					  <!-- /.input group -->
							</div>
						  </div>
					  </div>
						<div class="row mb-2">
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<input type="text" class="form-control" id="telefone" value="<?php echo $usuario["telefone"]; ?>" name="telefone" data-inputmask='"mask": "(99) 9999-9999"' data-mask placeholder="Telefone">
							</div>
						</div>
						<div class="col-sm-6">
						   <div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square"></i></span>
								</div>
								<input type="text" class="form-control" id="celular" value="<?php echo $usuario["celular"]; ?>" name="celular" data-inputmask='"mask": "(99) 9999-9999"' data-mask placeholder="Celular">
							</div>
						</div>
					   </div> 	
					 <div class="row mb-2">
						  <div class="col-sm-6">
							<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-users"></i></span>
							</div>
								<select class="form-control" name="departamento" id="departamento">
									<option value ="0" selected="selected">Departamento</option>
									<?php  
									$resultado = GetDepartamentos($conexao,"");
									while($departamentos = mysqli_fetch_array($resultado)){
									  if($usuario["departamento"] == $departamentos["nome"]){
											echo '<option selected value ="'.$departamentos['cpf'].'">'.$departamentos['nome'].'</option>';
										}else{
											echo '<option value ="'.$departamentos['cpf'].'">'.$departamentos['nome'].'</option>';
										}
									}
									?>
								</select>
							</div>
						  </div>
						 <div class="col-sm-6">
							<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
								<select class="form-control" name="superiorresponsavel" id="superiorresponsavel">
									<option value ="0" selected="selected">Superior Responsável</option>
									<?php  
									$resultado = GetUsuarios($conexao,"");
									while($usuarios = mysqli_fetch_array($resultado)){
										if($usuario["id_superiorresponsavel"] == $usuarios["cpf"]){
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
        var sobrenome = $("#sobrenome");
		var cpf = $("#cpf");
        var email = $("#email");
        var senha = $("#senha");
		var confsenha = $("#confsenha");
		var nivelacesso = $("#nivelacesso");
		var datanascimento = $("#datanascimento");
		var telefone = $("#telefone");
		var celular = $("#celular");
		var departamento = $("#departamento");
		var superiorresponsavel = $("#superiorresponsavel");
		var url_a  = "<?php print base_url(); ?>"+"assets/theme/myScripts/validarAlteraUsuarios.php";
		
		
        $.ajax({
            type: "POST",
            url: url_a,
            dataType: "json",
            data: {nome:nome.val(), sobrenome:sobrenome.val(), cpf:cpf.val(), email:email.val(), senha:senha.val(),
			confsenha: confsenha.val(),nivelacesso:nivelacesso.val(), datanascimento:datanascimento.val(),
			telefone:telefone.val(), celular:celular.val(),departamento:departamento.val(),
			superiorresponsavel:superiorresponsavel.val() },
            success : function(data){
					nome.removeClass();
					nome.addClass("form-control is-valid");
					sobrenome.removeClass();
					sobrenome.addClass("form-control is-valid");
					cpf.removeClass();
					cpf.addClass("form-control is-valid");
					email.removeClass();
					email.addClass("form-control is-valid");
					senha.removeClass();
					senha.addClass("form-control is-valid");
					confsenha.removeClass();
					confsenha.addClass("form-control is-valid");
					nivelacesso.removeClass();
					nivelacesso.addClass("form-control is-valid");
					datanascimento.removeClass();
					datanascimento.addClass("form-control is-valid");
					telefone.removeClass();
					telefone.addClass("form-control is-valid");
					celular.removeClass();
					celular.addClass("form-control is-valid");
					departamento.removeClass();
					departamento.addClass("form-control is-valid");
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
