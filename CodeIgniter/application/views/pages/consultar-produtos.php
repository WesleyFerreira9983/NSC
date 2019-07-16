			<?php 
				if(isset($_SESSION['permissao']))
				{
					if($_SESSION['permissao'] == 1 || $_SESSION['permissao'] == 3){
					}
					else{
						header("location:index.php"); ; 
					}
				}
				else
				{
					header("location:index.php"); 
				}	
				
				include ("conexao.php");
				include ("controllers.php");
				
				if(isset($_GET["d"])){
					RemoveProdutos($conexao,$_GET["d"]);
				}
				
				if(isset($_POST["Alterar"]))
				{	
					AlteraProdutos($conexao,$_POST["id"],$_POST["nome"],$_POST["descricao"],$_POST["quantidade"],
					$_POST["preco"],$_POST["categoriaproduto"]);
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
                <a href="<?php echo base_url(); ?>?p=usuarios&typ=1" class="nav-link">
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
                <a href="<?php echo base_url(); ?>?p=produtos&typ=1" class="nav-link active">
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
            <h1>Consultar Produtos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Consultar Produtos</li>
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
                <h3 class="card-title">Tabela de Produtos</h3>

                <div class="card-tools">
                 <form role="form" method="post" action="<?php echo base_url(); ?>?p=produtos&typ=1" enctype="multipart/form-data">
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
                    <th>Descrição</th>
					<th>Quantidade</th>
					<th>Preço</th>
					<th>Categoria do produto</th>
					<th></th>
					<th></th>
                  </tr>
						<?php  
						$procurar = "";
						if(isset($_POST["search"])){
							$procurar = $_POST["search"];
						}
						$resultado = GetProdutos($conexao,$procurar);
						while($produtos = mysqli_fetch_array($resultado)){
						$categoria = mysqli_fetch_array(GetProdutoCategoriasIndex($conexao, $produtos["id_categoria"]));
						echo '<tr><td>'.$produtos["nome"].'</td>'
						.'<td>'.$produtos["descricao"].'</td>'
						.'<td>'.$produtos["quantidade"].'</td>'
						.'<td>'.$produtos["preco"].'</td>'
						.'<td>'.$categoria["nome"].'</td>';
						?>
					  <td>
						<a href="<?php echo base_url(); ?>?p=produtos&typ=1&j=<?php echo $produtos["id_produto"] ?>" style="color:DodgerBlue">
							<i class="nav-icon fas fa-edit"></i>
						</a>
					</td>
                    <td>
						<a href="<?php echo base_url(); ?>?p=produtos&typ=1&d=<?php echo $produtos["id_produto"] ?>" style="color:Tomato">
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
		</div>
    </section>
	<div class="modal fade" id="modal-default">
				<div class="modal-dialog">
				  <div class="modal-content">
					<div class="modal-header">
					  <h4 class="modal-title">Alterar Produtos</h4>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<div class="modal-body">
					<?php
						$resultado = GetProdutosIndex($conexao,$_GET["j"]);
						$produtos =  mysqli_fetch_assoc($resultado);
					?>
					<form name="Formulario" id="Formulario" role="form" method="post" action="?p=produtos&typ=1" enctype="multipart/form-data">
					<div class="card-body">
					  <div class="input-group mb-4">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input hidden id="id" type="text" class="form-control" value="<?php echo $produtos["id_produto"]; ?>" name="id">
						<input type="text" id="nome" class="form-control" value="<?php echo $produtos["nome"]; ?>" name="nome" placeholder="Nome">
					  </div>
					  <div class="input-group mb-4">
					  <textarea class="form-control" rows="3" id="descricao" name="descricao" placeholder="Descrição..."><?php echo $produtos["descricao"]; ?></textarea>  
					  </div>
					   <div class="row mb-2">
						<div class="col-sm-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
								</div>
								<input type="text" id="quantidade" class="form-control" value="<?php echo $produtos["quantidade"]; ?>" name="quantidade" placeholder="Quantidade">
							</div>
						</div>
						<div class="col-sm-6">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
							</div>
							<input type="text" class="form-control" id="preco" value="<?php echo $produtos["preco"]; ?>" name="preco" placeholder="Preço">
						</div>
						</div>
						</div> 
						<div class="row mb-2">
						  <div class="col-sm-6">
							<div class="input-group mb-1">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fas fa-box-open"></i></span>
							</div>
								<select class="form-control" id="categoriaproduto" name="categoriaproduto" value="<?php echo $produtos["categoriaproduto"]; ?>">
									<option selected="selected" value="0">Categoria do Produto</option>
									<?php  
									$resultado = GetProdutoCategorias($conexao,"");
									while($categoriasProduto = mysqli_fetch_array($resultado)){
										if($produtos["id_categoria"] == $categoriasProduto["id_categoria"]){
											echo '<option selected value ="'.$categoriasProduto['id_categoria'].'">'.$categoriasProduto['nome'].'</option>';
										}else{
											echo '<option value ="'.$categoriasProduto['id_categoria'].'">'.$categoriasProduto['nome'].'</option>';
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
		var id = $("#id");
        var nome = $("#nome");
        var descricao = $("#descricao");
		var quantidade = $("#quantidade");
        var preco = $("#preco");
        var categoriaproduto = $("#categoriaproduto");
		
		var url_a  = "<?php print base_url(); ?>"+"assets/theme/myScripts/validarAlteraProdutos.php";
		
		
        $.ajax({
            type: "POST",
            url: url_a,
            dataType: "json",
            data: {id:id.val(), nome:nome.val(), descricao:descricao.val(), quantidade:quantidade.val(), preco:preco.val(),
			categoriaproduto:categoriaproduto.val()},
            success : function(data){
					nome.removeClass();
					nome.addClass("form-control is-valid");
					descricao.removeClass();
					descricao.addClass("form-control is-valid");
					quantidade.removeClass();
					quantidade.addClass("form-control is-valid");
					preco.removeClass();
					preco.addClass("form-control is-valid");
					categoriaproduto.removeClass();
					categoriaproduto.addClass("form-control is-valid");
					 
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